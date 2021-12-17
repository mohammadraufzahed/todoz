import { Request, ResponseToolkit } from "@hapi/hapi";

export async function homeHandler(req: Request, res: ResponseToolkit) {
  console.dir(req.query);
  if (req.query.name) {
    return `Hi ${req.query.name}`;
  }
  return "Hi";
}
