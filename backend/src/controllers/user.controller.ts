import { User } from "@app/schema/User";
import {
  Request,
  ResponseObject,
  ResponseToolkit,
  ResponseValue,
} from "@hapi/hapi";
import { genSalt, hash } from "bcryptjs";
import Joi from "joi";
import md5 from "md5";
import { getConnection } from "typeorm";

export namespace UserController {
  /**
   *
   * @param {Request} req
   * @param {ResponseToolkit} h
   * @returns {Promise<ResponseValue>}
   */
  export async function get(
    req: Request,
    h: ResponseToolkit
  ): Promise<ResponseValue> {
    // Get database connection
    const repository = getConnection().getRepository(User);
    // Collect the user information from credentials
    const credentials = req.auth.credentials;
    // Get the user
    const user = await repository.findOne({
      where: {
        ...credentials.user,
      },
    });
    // If user not found return error
    if (!user) {
      return h
        .response({
          status: "failed",
          message: "User not found",
        })
        .code(401);
    }
    // Return the specific information
    return h.response({
      username: user.username,
      email: user.email,
      photo: user.picture_url,
    });
  }
  /**
   *
   * @param {Request} req
   * @param {ResponseToolkit} h
   * @returns {Promise<ResponseValue>}
   */
  export async function put(
    req: Request,
    h: ResponseToolkit
  ): Promise<ResponseValue> {
    // get database repository
    const repository = getConnection().getRepository(User);
    // Validate the data
    const requestSchema = Joi.object({
      username: Joi.string().alphanum().min(4).max(20),
      password: Joi.string().min(8),
      email: Joi.string().email(),
    });
    const { error, value } = requestSchema.validate(req.payload);
    if (error) {
      return h
        .response({
          status: "failed",
          message: error.message,
        })
        .code(406);
    }
    // Save the username
    const authUsername: string = <string>req.auth.credentials.username;
    const userData: CustomObject = {};
    // Pass the data to it
    // Pass the password
    if (value.password) {
      // Hash the password
      const salt = await genSalt(10);
      userData["password"] = await hash(value.password, salt);
    }
    // Pass the username
    if (value.username) userData["username"] = value.username;
    // Pass the email
    if (value.email) {
      userData["email"] = value.email;
      userData["picture_url"] = `https://www.gravatar.com/avatar/${md5(
        value.email
      )}`;
    }
    // Update the user
    const user = await repository
      .update(
        { username: authUsername },
        {
          ...userData,
        }
      )
      .catch((error) => {
        // if update faild return the error
        return h
          .response({
            status: "failed",
            message: "something goes wrong",
          })
          .code(504);
      });
    return h
      .response({
        status: "ok",
        message: "User updated successfully",
      })
      .code(200);
  }
  export async function del(
    req: Request,
    h: ResponseToolkit
  ): Promise<ResponseValue> {
    // Get user credentials
    const credentials = req.auth.credentials;
    // Get User repository
    const repository = getConnection().getRepository(User);
    const deleteResult = await repository.delete({
      ...credentials.user,
    });
    return {
      status: "ok",
      message: "User deleted successfully",
    };
  }
}
