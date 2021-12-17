import { homeHandler } from "@app/controllers/home.controller";
import { Server, Request } from "@hapi/hapi";
/**
 * @name homeRoute
 * @description Sample route plugin
 * @type {object}
 */
const homeRoute: object = {
  name: "homeRoute",
  description: "Sample route plugin",
  version: "1.0.0",
  once: true,
  register: async (server: Server, options: object): Promise<void> => {
    server.route({
      method: "GET",
      path: "/",
      handler: homeHandler,
    });
  },
};

exports.plugin = homeRoute;
