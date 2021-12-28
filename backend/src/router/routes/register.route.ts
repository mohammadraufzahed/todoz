import { Server, ServerOptions } from "@hapi/hapi";
import { RegisterController } from "@app/controllers/register.controller";

/**
 * @name registerRouter
 * @description register router
 * @type {object}
 */
const registerRoute: object = {
  name: "register route",
  version: "1.0.0",
  once: true,
  register: async (server: Server, options: ServerOptions): Promise<void> => {
    server.route({
      path: "/register",
      method: "POST",
      handler: RegisterController.post,
      options: {
        auth: {
          strategy: "login",
          mode: "optional",
        },
      },
    });
  },
};

exports.plugin = registerRoute;
