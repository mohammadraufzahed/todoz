import { init, start } from "./server";

require("dotenv").config();

init().then(async (): Promise<void> => await start());
