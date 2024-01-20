-- -----------------------------------------------------
-- chessmate
-- -----------------------------------------------------
DROP 	DATABASE IF EXISTS 	`chessmate`;
CREATE 	DATABASE 			`chessmate`;
USE 						`chessmate`;

-- -----------------------------------------------------
-- Table `chessmate`.`images`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`images` (
  	`id`	 		INT				AUTO_INCREMENT,
  	`url`			VARCHAR(150) 	NOT NULL,
  	PRIMARY KEY (`id`)
);

-- -----------------------------------------------------
-- Table `chessmate`.`users`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`users` (
  	`username` 		VARCHAR(150) 	NOT NULL,
  	`mail` 			VARCHAR(200)	UNIQUE,
  	`password` 		VARCHAR(512) 	NOT NULL,
  	`bio`	 		VARCHAR(512) 	DEFAULT "",
  	`image` 		INT			 	DEFAULT NULL,
  	`name` 			VARCHAR(45) 	NOT NULL,
  	`surname` 		VARCHAR(45) 	NOT NULL,
  	`birthday` 		DATE		 	NOT NULL,
  	`followers`		INT				NOT NULL DEFAULT 0,
  	`follow`		INT				NOT NULL DEFAULT 0,
  	PRIMARY KEY (`username`),
	FOREIGN KEY (`image`) REFERENCES `images`(`id`)
		ON UPDATE CASCADE
		ON DELETE SET NULL
);

-- -----------------------------------------------------
-- Table `chessmate`.`follows`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`follows` (
  	`follower`	 	VARCHAR(150)	NOT NULL,
  	`followed`		VARCHAR(150) 	NOT NULL,
  	PRIMARY KEY (`follower`, `followed`),
  	FOREIGN KEY (`follower`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`followed`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`posts`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`posts` (
  	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`author` 			VARCHAR(150) 	NOT NULL,
  	`publication_date` 	DATE		 	NOT NULL,
	`publication_time`	TIME			NOT NULL,
  	`title`			 	VARCHAR(512) 	NOT NULL,
	`game`				VARCHAR(1024) 	NOT NULL,
  	`vote`			 	INT			 	DEFAULT 0,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`votes`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`votes` (
  	`post`	 	INT	NOT NULL,
  	`voter`		VARCHAR(150) 	NOT NULL,
  	PRIMARY KEY (`post`, `voter`),
  	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`voter`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`comments`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`comments` (
	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`post`	 			INT				NOT NULL,
  	`author`		 	VARCHAR(150) 	NOT NULL,
  	`publication_date` 	DATE		 	NOT NULL,
	`publication_time`	TIME			NOT NULL,
	`text`				VARCHAR(1024)	NOT NULL,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);


-- -----------------------------------------------------
-- Table `chessmate`.`notifications`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`notifications` (
	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`user`	 			VARCHAR(150) 	NOT NULL,
  	`author`		 	VARCHAR(150) 	NOT NULL,
  	`date` 				DATE		 	NOT NULL,
	`time`				TIME			NOT NULL,
	`post`				INT 			DEFAULT NULL,
	`comment`			INT 			DEFAULT NULL,
	`viewed`			INT				DEFAULT 0,
  	PRIMARY KEY (`id`),
	FOREIGN KEY (`user`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
  	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`comment`) REFERENCES `comments`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);
