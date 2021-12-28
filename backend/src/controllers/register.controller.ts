import { Request, ResponseToolkit, Server } from "@hapi/hapi";
import { getConnection } from "typeorm";
import Joi from "joi";
import { User } from "@app/schema/User";
import { nanoid } from "nanoid";
import md5 from "md5";
import bcrypt from "bcryptjs";

export namespace RegisterController {
  export async function post(req: Request, h: ResponseToolkit) {
    if (!req.auth.isAuthenticated) {
      return h
        .response({
          status: "error",
          message: "user already authenticated",
        })
        .code(403);
    }
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
}
