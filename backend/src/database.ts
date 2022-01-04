import { createConnection } from "typeorm";
import { User } from "@app/schema/User";
import { Todos } from "@app/schema/Todos";

/**
 * @name createDatabaseConnection
 * @description Create the connection with database
 * @function
 * @async
 * @example
 * await createDatabaseConnection();
 * @returns <Promise<void>>
 */
export const createDatabaseConnection = async (): Promise<void> => {
  // Create the database connection
  await createConnection({
    type: "postgres",
    url: process.env.DATABASE_URL,
    synchronize: true,
    logging: false,
    entities: [User, Todos],
    extra: {
      ssl: process.env.DEVELOPMENT ? false : true,
    },
  });
};
