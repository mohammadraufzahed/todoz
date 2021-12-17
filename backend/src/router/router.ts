import { Server } from "@hapi/hapi";

/**
 * @name router
 * @description This plugin will register the routes in the server.
 * @type {object}
 */
const router = {
  name: "router",
  version: "1.0.0",
  once: true,
  register: async (server: Server, options: object): Promise<void> => {
    // Register the sample router
    await server.register({
      plugin: require("@app/router/routes/home.route"),
    });
  },
};

exports.plugin = router;
