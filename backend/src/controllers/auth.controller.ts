import { Request, ResponseToolkit, Server } from "@hapi/hapi";
import { getConnection } from "typeorm";
import Joi from "joi";
import { User } from "@app/schema/User";
import { nanoid } from "nanoid";
import md5 from "md5";
import bcrypt, { compare } from "bcryptjs";
import { sign as JWTSign } from "jsonwebtoken";

/**
 * @name AuthController
 * @description This namespace contains the controllers for auth route
 * @namespace
 */
export namespace AuthController {
  /**
   * @name post
   * @description handler for post requests and it will register the user to the database
   * @function
   * @async
   * @param {Request} req
   * @param {ResponseToolkit} h
   * @returns {Promise<object>}
   */
  export async function post(
    req: Request,
    h: ResponseToolkit
  ): Promise<object> {
    // Get the database connection
    const connection = getConnection();
    const repository = connection.getRepository(User);
    // Request body schema
    const requestSchema = Joi.object({
      username: Joi.string().alphanum().min(4).max(20).required(),
      password: Joi.string().min(8).required(),
      email: Joi.string().email().required(),
    });
    // Validate the request
    const { error, value } = requestSchema.validate(req.payload);
    // if has error return the error
    if (error) {
      return h
        .response({
          status: "error",
          message: error.message,
        })
        .code(406);
    }
    // Check the username or email exists
    const users = await repository
      .findAndCount({
        where: [{ username: value.username }, { email: value.email }],
      })
      .then((users) => users[1]);
    // Check the length
    if (users) {
      // Return the error
      return h
        .response({
          status: "error",
          message: "there are users with the same username or email",
        })
        .code(500);
    }
    // Hash the password
    const salt = await bcrypt.genSalt(10);
    const passwordHash = await bcrypt.hash(value.password, salt);
    try {
      // Create the user
      const user = repository.create({
        id: nanoid(),
        username: value.username,
        password: passwordHash,
        email: value.email,
        picture_url: `https://www.gravatar.com/avatar/${md5(value.email)}`,
      });
      // Save the users
      await user.save();
    } catch (error) {
      return h
        .response({
          status: "error",
          message: "Something goes wrong",
        })
        .code(504);
    }

    return {
      status: "ok",
      message: "the user account created successfully",
    };
  }

  /**
   * @name get
   * @description This function will handle the get request, and will authenticate the users
   * @function
   * @async
   * @param {Request} req
   * @param {ResponseToolkit} h
   * @returns {Promise<object>}
   */
  export async function get(req: Request, h: ResponseToolkit): Promise<object> {
    // Get the connection and data repository
    const connection = getConnection();
    const repository = connection.getRepository(User);
    // Validate the request payload
    const requestSchema = Joi.object({
      username: Joi.string().alphanum().min(4).max(20).required(),
      password: Joi.string().min(8).required(),
    });
    // Validate decode
    const { error, value } = requestSchema.validate(req.query);
    if (error) {
      return h
        .response({
          status: "faild",
          message: "Params are not valid",
        })
        .code(401);
    }
    // Find the user
    const user = await repository.findOne({
      where: {
        username: value.username,
      },
    });
    // If user was not exists
    if (!user) {
      return h
        .response({
          status: "faild",
          message: "The User not found",
        })
        .code(401);
    }
    // Comapre the passwords
    if (!(await compare(value.password, user.password))) {
      return h
        .response({
          status: "faild",
          message: "The password is not correct",
        })
        .code(401);
    }
    // return the value
    return h
      .response({
        status: "ok",
        message: "user logged in successfully",
        token: JWTSign(
          {
            username: user.username,
            email: user.email,
            ip: req.info.remoteAddress,
            expire: (new Date().getTime() + 1).toString(),
          },
          process.env.LOGIN_KEY
        ),
      })
      .code(200);
  }
}
