import { Entity, BaseEntity, PrimaryColumn, Column, OneToMany } from "typeorm";
import { Todos } from "./Todos";

/**
 * @name User
 * @class
 * @classdesc User Entity
 */
@Entity()
export class User extends BaseEntity {
  @PrimaryColumn({ type: "varchar" })
  id: string;

  @Column({ type: "varchar", unique: true })
  username: string;

  @Column({ type: "varchar" })
  password: string;

  @Column({ type: "varchar", unique: true })
  email: string;

  @Column({ type: "varchar" })
  picture_url: string;

  @OneToMany(() => Todos, (todo) => todo.user)
  todos: Todos[];
}
