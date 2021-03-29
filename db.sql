CREATE TABLE `users`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(20) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `isAdmin` ENUM('Y', 'N') DEFAULT 'N',
    `isAccountEnable` ENUM('Y', 'N') DEFAULT 'Y'
);
CREATE TABLE `settings`(
    `siteName` VARCHAR(50) NOT NULL,
    `siteDescription` TEXT NOT NULL
);
CREATE TABLE `todos`(
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `userId` INT NOT NULL,
    `todo` TEXT NOT NULL,
    `isDone` ENUM('Y', 'N') DEFAULT 'N'
);
commit;