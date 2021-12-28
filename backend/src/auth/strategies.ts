import { Request, ResponseToolkit, Server, ServerOptions } from "@hapi/hapi";

// Auth Strategies register
exports.plugin = {
  name: "Strategy Register",
  version: "1.0.0",
  once: true,
  register: async (server: Server, options: ServerOptions) => {
    await server.register([
      {
        plugin: require("./strategies/login"),
      },
    ]);
  },
};
