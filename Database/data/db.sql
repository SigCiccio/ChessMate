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
  	`mail` 			VARCHAR(200)	UNIQUE,
  	`username` 		VARCHAR(150) 	NOT NULL,
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
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`posts`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`posts` (
  	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`author` 			VARCHAR(150) 	UNIQUE,
  	`publication_date` 	DATE		 	NOT NULL,
	`time`				TIME			NOT NULL,
  	`title`			 	VARCHAR(512) 	NOT NULL,
  	`vote`			 	INT			 	DEFAULT NULL,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`comments`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`comments` (
	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`author`		 	VARCHAR(150) 	NOT NULL,
  	`post`	 			INT				NOT NULL,
  	`publication_date` 	DATE		 	NOT NULL,
	`pubblication_time`	TIME			NOT NULL,
  	`vote`			 	INT			 	DEFAULT NULL,
	`post_type`			VARCHAR(1)		NOT NULL,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`comments`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`games` (
	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`post`	 			INT				NOT NULL,
  	`move`			 	VARCHAR(1024) 	NOT NULL,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
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

