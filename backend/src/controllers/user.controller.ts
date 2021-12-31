import { Request, ResponseToolkit } from "@hapi/hapi";

export namespace UserController {
  export async function get(req: Request, h: ResponseToolkit) {
    // Collect the user information from credentials
    const user = req.auth.credentials;
    // Return the specific information
    return h.response({
      username: user.username,
      email: user.email,
      photo: user.picture_url,
    });
  }
  export async function put(req: Request, h: ResponseToolkit) {}
}
