import { User } from "@app/schema/User";
import { Request, ResponseToolkit, ResponseValue } from "@hapi/hapi";
import { genSalt, hash } from "bcryptjs";
import Joi from "joi";
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
    // Collect the user information from credentials
    const user = req.auth.credentials;
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
      password: Joi.string().min(8).required(),
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
    // Hash the password
    const salt = await genSalt(10);
    const passwordHash = await hash(value.password, salt);
    // Update the user
    const user = await repository
      .update(
        { username: authUsername },
        {
          password: passwordHash,
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
        message: "password changed successfully",
      })
      .code(200);
  }
}
