import Hapi from "@hapi/hapi";
import { Server } from "@hapi/hapi";
import { createDatabaseConnection } from "database";

export let server: Server;

/**
 * @name init
 * @description Initilize the api server
 * @function
 * @async
 * @example
 * init();
 * @returns {Promise<Server>}
 */
export const init = async (): Promise<Server> => {
  // Initilize the server
  server = Hapi.server({
    host: "localhost",
    port: process.env.PORT || 8080,
  });
  // Create the database connection
  await createDatabaseConnection();
  // Register the auth strategies
  await server.register(require("@app/auth/strategies"));
  // Register the router
  await server.register({
    plugin: require("@app/router/router"),
  });
  // Return the server
  return server;
};

/**
 * @name start
 * @description Start the server after initialization
 * @function
 * @async
 * @example
 * init().then(() => start());
 * @returns {void}
 */
export const start = async (): Promise<void> => {
  // Log the server
  console.log(
    `API is running at http://${server.settings.host}:${server.settings.port}`
  );
  // Start the server
  await server.start();
};

process.on("unhandledRejection", (err) => {
  console.error("unhandledRejection");
  console.error(err);
  process.exit(1);
});
