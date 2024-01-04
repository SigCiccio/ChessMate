-- -----------------------------------------------------
-- chessmate
-- -----------------------------------------------------
DROP 	DATABASE IF EXISTS 	`chessmate`;
CREATE 	DATABASE 			`chessmate`;
USE 						`chessmate`;

-- -----------------------------------------------------
-- Table `chessmate`.`users`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`users` (
  	`mail` 			VARCHAR(200)	UNIQUE,
  	`username` 		VARCHAR(150) 	NOT NULL,
  	`password` 		VARCHAR(512) 	NOT NULL,
  	`name` 			VARCHAR(45) 	NOT NULL,
  	`surname` 		VARCHAR(45) 	NOT NULL,
  	`birtday` 		DATE		 	NOT NULL,
  	`nazionality`	VARCHAR(150)	DEFAULT NULL,
  	`elo`			INT				DEFAULT NULL,
  	`followers`		INT				NOT NULL DEFAULT 0,
  	`follow`		INT				NOT NULL DEFAULT 0,
  	/* `image`		INT				NULL, */
  	`active`		TINYINT 		NULL DEFAULT 0,
  	PRIMARY KEY (`username`)
);

-- -----------------------------------------------------
-- Table `chessmate`.`posts`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`posts` (
  	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`author` 			VARCHAR(150) 	UNIQUE,
  	`publication_date` 	DATE		 	NOT NULL,
  	`title`			 	VARCHAR(512) 	NOT NULL,
  	`text`			 	VARCHAR(512) 	NOT NULL,
  	`vote`			 	INT			 	DEFAULT NULL,
  	/* `image`		INT				NULL, */
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table `chessmate`.`discussions`
-- -----------------------------------------------------
CREATE TABLE `chessmate`.`discussions` (
	`id`	 			INT				NOT NULL AUTO_INCREMENT,
  	`post`	 			INT				NOT NULL,
  	`replay_to`			INT				DEFAULT NULL,
  	`author`		 	VARCHAR(150) 	NOT NULL,
  	`publication_date` 	DATE		 	NOT NULL,
  	`text`			 	VARCHAR(512) 	NOT NULL,
  	`vote`			 	INT			 	DEFAULT NULL,
  	PRIMARY KEY (`id`),
  	FOREIGN KEY (`post`) REFERENCES `posts`(`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`author`) REFERENCES `users`(`username`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	FOREIGN KEY (`replay_to`) REFERENCES `discussions`(`id`)
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