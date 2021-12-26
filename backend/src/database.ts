import { createConnection } from "typeorm";
import { User } from "@app/schema/User";
import { Todos } from "@app/schema/Todos";

require("dotenv").config();

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
    host: process.env.DATABASE_HOST,
    port: 5432,
    database: process.env.DATABASE_NAME,
    username: process.env.DATABASE_USER,
    password: process.env.DATABASE_PASSWORD,
    synchronize: true,
    entities: [User, Todos],
  });
};
