import { User } from "@app/schema/User";
import { Request, ResponseToolkit, Server, ServerOptions } from "@hapi/hapi";
import { compare } from "bcryptjs";
import Joi from "joi";
import moment from "moment";
import { getConnection } from "typeorm";

exports.plugin = {
  name: "Login strategy",
  version: "1.0.0",
  register: async (server: Server, options: ServerOptions): Promise<void> => {
    server.auth.strategy("api", "jwt", {
      key: process.env.LOGIN_KEY,
      validate: async (
        decoded: any,
        request: Request,
        h: ResponseToolkit
      ): Promise<object | void> => {
        // get database connection
        const repository = getConnection().getRepository(User);
        // Generate the date
        const date = moment(new Date());
        // Validate the request from the decoded data
        const requestSchema = Joi.object({
          username: Joi.string().alphanum().min(4).max(20).required(),
          email: Joi.string().email().required(),
          ip: Joi.string().required(),
          expire: Joi.string().required(),
          iat: Joi.number(),
        });
        // Validate the decoded data
        const { error, value } = requestSchema.validate(decoded);
        if (error) {
          return {
            isValid: false,
          };
        }
        // Check user exists or not
        const { username, email } = value;
        const userStatus = await repository
          .findAndCount({
            where: {
              username,
              email,
            },
          })
          .then((data) => data[1]);
        if (!userStatus)
          return {
            isValid: false,
          };
        // Check the request IP
        if (request.info.remoteAddress != value.ip) {
          return {
            isValid: false,
          };
        }
        // Check the expire date of token
        if (date.isSameOrBefore(new Date(value.expire).getTime())) {
          return {
            isValid: false,
          };
        }
        // if everything was ok accept the auth.
        return {
          isValid: true,
          credentials: value,
        };
      },
    });
  },
};
