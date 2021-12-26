import { init, start } from "./server";

init().then(async (): Promise<void> => await start());
