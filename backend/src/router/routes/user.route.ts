import { UserController } from "@app/controllers/user.controller";
import { Server, ServerOptions } from "@hapi/hapi";

exports.plugin = {
  name: "User routes",
  version: "1.0.0",
  register: async (server: Server, options: ServerOptions): Promise<void> => {
    server.route({
      method: "GET",
      path: "/user",
      handler: UserController.get,
      options: {
        auth: {
          strategy: "login",
          mode: "required",
        },
      },
    });
  },
};
