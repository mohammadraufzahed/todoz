import { Todos } from "@app/schema/Todos";
import { User } from "@app/schema/User";
import { Request, ResponseToolkit, ResponseValue } from "@hapi/hapi";
import Joi from "joi";
import { nanoid } from "nanoid";
import { getConnection } from "typeorm";

export namespace TodoController {
  export async function post(
    req: Request,
    h: ResponseToolkit
  ): Promise<ResponseValue> {
    // Get database connection
    const todoRepository = getConnection().getRepository(Todos);
    const userRepository = getConnection().getRepository(User);
    // Data schema
    const dataSchema = Joi.object({
      title: Joi.string().min(4).max(120).required(),
      description: Joi.string().min(5),
    });
    // Validate the user
    const { error, value } = dataSchema.validate(req.payload);
    if (error) {
      return h
        .response({
          status: "failed",
          message: error.message,
        })
        .code(406);
    }
    // Get user
    const user = await userRepository.findOne({
      where: {
        ...req.auth.credentials.user,
      },
    });
    // Create the todo entity
    const todo = todoRepository.create({
      id: nanoid(),
      title: value.title,
      description: value.description,
      user: user,
    });
    // Save the entity
    await todo.save().catch((error) => {
      return h
        .response({
          status: "failed",
          message: "something goes wrong",
        })
        .code(504);
    });
    // return status
    return h
      .response({
        status: "ok",
        message: "todo created successfully",
      })
      .code(200);
  }
}
