import { Request, ResponseToolkit } from "@hapi/hapi";

export async function homeHandler(req: Request, res: ResponseToolkit) {
  if (req.query.name) {
    return `Hi ${req.query.name}`;
  }
  return "Hi";
}
