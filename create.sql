SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS people_jobs;
DROP TABLE IF EXISTS game_char;
DROP TABLE IF EXISTS games_platforms;
DROP TABLE IF EXISTS game_character;
DROP TABLE IF EXISTS platform;
DROP TABLE IF EXISTS job;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS game_genres;
DROP TABLE IF EXISTS video_game;
DROP TABLE IF EXISTS game_series;
DROP TABLE IF EXISTS genre;
DROP TABLE IF EXISTS developer;
SET FOREIGN_KEY_CHECKS=1;

-- Creates a table named developer with the following properties
-- id: an auto incrementing integer which is the primary key
-- name: name of the developer, cannot be null
-- city: city that the developer is located in
CREATE TABLE developer(
	developer_id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	city varchar(255),
	PRIMARY KEY(developer_id),
	UNIQUE (name)
) ENGINE = InnoDB;

-- Creates a table named genre with the following properties
-- id - an auto incrementing integer which is the primary key
-- name - name of the genre, cannot be null
CREATE TABLE genre(
	genre_id INT NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY(genre_id),
	UNIQUE(name)
) ENGINE = InnoDB;

-- Creates a table named game_series with the following properties
-- id - an auto incrementing integer which is the primary key
-- title - tile of the series, cannot be null
CREATE TABLE game_series(
	series_id INT NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	PRIMARY KEY(series_id),
	UNIQUE(title)
) ENGINE = InnoDB;


CREATE TABLE video_game(
	game_id INT NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	releaseMonth int,
	releaseDay int,
	releaseYear int,
	gameSeries int,
	developer int,
	PRIMARY KEY(game_id),
<<<<<<< HEAD
	FOREIGN KEY(gameSeries) REFERENCES game_series (series_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(developer) REFERENCES developer (developer_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
=======
	FOREIGN KEY(gameSeries) REFERENCES game_series (series_id) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(developer) REFERENCES developer (developer_id) ON DELETE CASCADE ON UPDATE CASCADE,
>>>>>>> chris-branch
	UNIQUE KEY(title, releaseMonth, releaseDay, releaseYear)
) ENGINE = InnoDB;


CREATE TABLE game_genres(
	game_id INT NOT NULL,
	genre_id INT NOT NULL,
	PRIMARY KEY(game_id, genre_id),
<<<<<<< HEAD
	FOREIGN KEY(game_id) REFERENCES video_game (game_id)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(genre_id) REFERENCES genre (genre_id)
	ON DELETE CASCADE ON UPDATE CASCADE
=======
	FOREIGN KEY(game_id) REFERENCES video_game (game_id) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY(genre_id) REFERENCES genre (genre_id) ON UPDATE CASCADE ON DELETE CASCADE
>>>>>>> chris-branch
) ENGINE = InnoDB;

-- people
CREATE TABLE people (
person_id INT NOT NULL AUTO_INCREMENT,
firstName VARCHAR(255) NOT NULL,
lastName VARCHAR(255) NOT NULL,
birthMonth INT,
birthDay INT,
birthYear INT,
PRIMARY KEY (person_id),
UNIQUE KEY (firstName, lastName, birthMonth, birthDay, birthYear)
) Engine=InnoDB;

-- job
CREATE TABLE job (
job_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255),
PRIMARY KEY (job_id),
UNIQUE KEY (name)
) Engine=InnoDB;

-- platform
CREATE TABLE platform (
platform_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
manufacturer VARCHAR(255) NOT NULL,
cost DECIMAL(5,2),
releaseMonth INT,
releaseDay INT,
releaseYear INT,
graphics VARCHAR(255),
hardDrive VARCHAR(45),
RAM VARCHAR(45),
PRIMARY KEY (platform_id),
UNIQUE KEY (name, manufacturer)
) Engine=InnoDB;

-- character
CREATE TABLE game_character (
char_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
PRIMARY KEY (char_id),
UNIQUE KEY (name)
) Engine =InnoDB;

-- games_platforms
CREATE TABLE games_platforms (
game_id INT,
platform_id INT,
PRIMARY KEY (game_id, platform_id),
<<<<<<< HEAD
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY (platform_id) REFERENCES platform (platform_id)
ON DELETE CASCADE ON UPDATE CASCADE
=======
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (platform_id) REFERENCES platform (platform_id) ON UPDATE CASCADE ON DELETE CASCADE
>>>>>>> chris-branch
) Engine=InnoDB;

-- game_char
CREATE TABLE game_char (
game_id INT,
char_id INT,
PRIMARY KEY (game_id, char_id),
<<<<<<< HEAD
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY (char_id) REFERENCES game_character (char_id)
ON DELETE CASCADE ON UPDATE CASCADE
=======
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (char_id) REFERENCES game_character (char_id) ON UPDATE CASCADE ON DELETE CASCADE
>>>>>>> chris-branch
) Engine=InnoDB;

-- people_jobs
CREATE TABLE people_jobs (
person_id INT,
job_id INT,
game_id INT, 
develop_id INT,
PRIMARY KEY (person_id, game_id, job_id),
<<<<<<< HEAD
CONSTRAINT FOREIGN KEY (person_id) REFERENCES people (person_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY (job_id) REFERENCES job (job_id)
ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT FOREIGN KEY (develop_id) REFERENCES developer (developer_id)
ON DELETE CASCADE ON UPDATE CASCADE
=======
CONSTRAINT FOREIGN KEY (person_id) REFERENCES people (person_id) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (job_id) REFERENCES job (job_id) ON UPDATE CASCADE ON DELETE CASCADE,
CONSTRAINT FOREIGN KEY (develop_id) REFERENCES developer (developer_id) ON UPDATE CASCADE ON DELETE CASCADE
>>>>>>> chris-branch
) Engine=InnoDB;
