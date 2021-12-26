import { Entity, BaseEntity, Column, PrimaryColumn, ManyToOne } from "typeorm";
import { User } from "@app/schema/User";

/**
 * @name Todos
 * @class
 * @classdesc Todos Entity
 */
@Entity("todos")
export class Todos extends BaseEntity {
  @PrimaryColumn({ type: "uuid", unique: true })
  id: string;

  @Column({ type: "text" })
  title: string;

  @Column({ type: "text", nullable: true, default: "" })
  description: string;

  @Column({ type: "bool", nullable: true, default: false })
  status: boolean;
  @ManyToOne(() => User, (user) => user.id)
  user: User;
}
