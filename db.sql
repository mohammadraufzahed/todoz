CREATE TABLE `users`{
    `id` INT NOT NULL PRIMARY KEY UNIQUE AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `isAdmin` ENUM('Y', 'N') DEFAULT 'N',
    `isAccountEnable` ENUM('Y', 'N') DEFAULT 'Y'
    };
CREATE TABLE `settings`{
    `siteName` VARCHAR NOT NULL,
    `siteDescription` VARCHAR NOT NULL
    };
CREATE TABLE `todos`{
    `id` INT UNIQUE PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `todo` VARCHAR NOT NULL,
    `isDone` ENUM('Y', 'N') DEFAULT 'N'
    };