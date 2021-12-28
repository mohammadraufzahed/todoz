import { User } from "@app/schema/User";
import { Request, ResponseToolkit, Server, ServerOptions } from "@hapi/hapi";
import { compare } from "bcryptjs";
import Joi from "joi";
import { getConnection } from "typeorm";

exports.plugin = {
  name: "Login strategy",
  version: "1.0.0",
  register: async (server: Server, options: ServerOptions): Promise<void> => {
    server.auth.strategy("login", "jwt", {
      key: process.env.LOGIN_KEY,
      validate: async (decoded: any, request: Request, h: ResponseToolkit) => {
        // Get the connection and data repository
        const connection = getConnection();
        const repository = connection.getRepository(User);
        // Validate the request payload
        const requestSchema = Joi.object({
          username: Joi.string().alphanum().min(4).max(20).required(),
          password: Joi.string().min(8).required(),
        });
        // Validate decode
        const { error, value } = requestSchema.validate(decoded);
        if (error) {
          return {
            isValid: false,
          };
        }
        // Find the user
        const user = await repository.findOne({
          where: {
            username: value.username,
          },
        });
        // If user was not exists
        if (!user) {
          return {
            isvalid: false,
          };
        }
        // Comapre the passwords
        if (!(await compare(value.password, user.password))) {
          return {
            isValid: false,
          };
        }
        // return the value
        return {
          isValid: true,
          credentials: user,
        };
      },
    });
  },
};
