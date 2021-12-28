import { Server } from "@hapi/hapi";

/**
 * @name router
 * @description This plugin will register the routes in the server.
 * @type {object}
 */
const router: object = {
  name: "router",
  version: "1.0.0",
  once: true,
  register: async (server: Server, options: object): Promise<void> => {
    // Register the routes
    await server.register([
      {
        plugin: require("@app/router/routes/register.route"),
      },
    ]);
  },
};

exports.plugin = router;
