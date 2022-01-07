import { TodoController } from "@app/controllers/todo.controller";
import { Server, ServerOptions } from "@hapi/hapi";

exports.plugin = {
  name: "Todo route",
  version: "1.0.0",
  register: async (server: Server, options: ServerOptions): Promise<void> => {
    server.route({
      method: "POST",
      path: "/todos",
      handler: TodoController.post,
      options: {
        auth: {
          strategy: "api",
          mode: "required",
        },
      },
    });
  },
};
