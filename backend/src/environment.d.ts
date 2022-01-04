declare global {
  namespace NodeJS {
    interface ProcessEnv {
      PORT: string | number;
      DATABASE_URL: string;
      LOGIN_KEY: string;
      DEVELOPMENT: boolean;
    }
  }
}

// If this file has no import/export statements (i.e. is a script)
// convert it into a module by adding an empty export statement.
export {};
