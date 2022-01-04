import { Server, ServerOptions } from "@hapi/hapi";
import { AuthController } from "@app/controllers/auth.controller";

/**
 * @name authRoute
 * @description register router
 * @type {object}
 */
const authRoute: object = {
  name: "register route",
  version: "1.0.0",
  once: true,

  register: async (server: Server, options: ServerOptions): Promise<void> => {
    // Register route
    server.route({
      path: "/auth",
      method: "POST",
      handler: AuthController.post,
    });
    // Authenticate route
    server.route({
      path: "/auth",
      method: "GET",
      handler: AuthController.get,
    });
  },
};

exports.plugin = authRoute;
