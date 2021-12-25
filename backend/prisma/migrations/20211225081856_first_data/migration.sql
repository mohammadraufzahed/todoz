/*
  Warnings:

  - A unique constraint covering the columns `[Username]` on the table `User` will be added. If there are existing duplicate values, this will fail.
  - Added the required column `Email` to the `User` table without a default value. This is not possible if the table is not empty.
  - Added the required column `Password` to the `User` table without a default value. This is not possible if the table is not empty.
  - Added the required column `Username` to the `User` table without a default value. This is not possible if the table is not empty.

*/
-- AlterTable
ALTER TABLE "User" ADD COLUMN     "Email" TEXT NOT NULL,
ADD COLUMN     "Password" TEXT NOT NULL,
ADD COLUMN     "Username" TEXT NOT NULL;

-- CreateTable
CREATE TABLE "Todos" (
    "Id" TEXT NOT NULL,
    "Title" TEXT NOT NULL,
    "Description" TEXT,
    "Status" BOOLEAN NOT NULL DEFAULT true,
    "userID" TEXT,

    CONSTRAINT "Todos_pkey" PRIMARY KEY ("Id")
);

-- CreateIndex
CREATE UNIQUE INDEX "User_Username_key" ON "User"("Username");

-- AddForeignKey
ALTER TABLE "Todos" ADD CONSTRAINT "Todos_userID_fkey" FOREIGN KEY ("userID") REFERENCES "User"("ID") ON DELETE SET NULL ON UPDATE CASCADE;
