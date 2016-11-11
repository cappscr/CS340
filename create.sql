--Creates a table named video_game with the following properties
--id - an auto incrementing integer which is the primary key
--title - name of the videogame, cannot be null
--releaseMonth - month of the year the game came out as an integer
--releaseDay - day of the month the game came out as an integer
--releaseYear- year the game came out as an integer
--gameSeries - id of the game series that the game belongs to
--developer - id of the developer of the game
--title, releaseMonth, releaseDay, releaseYear combo must be unique
--incase same name is used twice (e.g. Doom)
CREATE TABLE video_game{
	game_id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	releaseMonth int,
	releaseDay int,
	releaseYear int,
	gameSeries int,
	developer int,
	PRIMARY KEY(game_id),
	FOREIGN KEY(gameSeries) REFERENCES game_series (series_id),
	FOREIGN KEY(developer) REFERENCES developer (developer_id),
	UNIQUE KEY(title, releaseMonth, releaseDay, releaseYear)
} ENGINE = InnoDB;

--Creates a table named developer with the following properties
--id - an auto incrementing integer which is the primary key
--name - name of the developer, cannot be null
--city - city that the developer is located in
CREATE TABLE developer{
	developer_id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	city varchar(255),
	PRIMARY KEY(developer_id),
	UNIQUE (name)
} ENGINE = InnoDB;

--Creates a table named genre with the following properties
--id - an auto incrementing integer which is the primary key
--name - name of the genre, cannot be null
CREATE TABLE genre{
	genre_id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY(genre_id),
	UNIQUE(name)
} ENGINE = InnoDB;

--Creates a table named game_series with the following properties
--id - an auto incrementing integer which is the primary key
--title - tile of the series, cannot be null
CREATE TABLE game_series{
	series_id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	PRIMARY KEY(series_id),
	UNIQUE(title)
} ENGINE = InnoDB;

--Creates a table named game_genres with the following properties
--game_id - id of game being referenced
--genre_id - id of genre being referenced
CREATE TABLE `game_genres{
	game_id int(11) NOT NULL,
	genre_id int(11) NOT NULL,
	PRIMARY KEY(game_id, genre_id),
	FOREIGN KEY(game_id) REFERENCES video_game (game_id),
	FOREIGN KEY(genre_id) REFERENCES genre (genre_id)
} ENGINE = InnoDB;

--This will create a table displaying how many games each developer
--in the developer table have made
SELECT d.name, COUNT(vg.game_id) AS 'NumberOfGames' FROM developer d INNER JOIN
video_game vg ON vg.developer = d.developer_id
GROUP BY d.name;

--This will create a table displaying the games of each genre
SELECT g.name, vg.title FROM genre g INNER JOIN
game_genre gg ON g.genre_id = gg.genre_id INNER JOIN
video_game vg ON gg.game_id = vg.game_id
GROUP BY g.name;

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
CREATE TABLE character (
char_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(255) NOT NULL,
PRIMARY KEY (char_id),
UNIQUE KEY (name)
) Engine =InnoDB

-- games_platforms
CREATE TABLE games_platforms (
game_id INT,
platform_id INT,
PRIMARY KEY (game_id, platform_id),
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id),
CONSTRAINT FOREIGN KEY (platform_id) REFERENCES platform (platform_id)
) Engine=InnoDB;

-- game_char
CREATE TABLE game_char (
game_id INT,
char_id INT,
PRIMARY KEY (game_id, char_id),
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id),
CONSTRAINT FOREIGN KEY (char_id) REFERENCES character (char_id)
) Engine=InnoDB;

-- people_jobs
CREATE TABLE people_jobs (
person_id INT,
job_id INT,
game_id INT, 
develop_id INT,
PRIMARY KEY (person_id, game_id, job_id),
CONSTRAINT FOREIGN KEY (person_id) REFERENCES people (person_id),
CONSTRAINT FOREIGN KEY (game_id) REFERENCES video_game (game_id),
CONSTRAINT FOREIGN KEY (job_id) REFERENCES job (job_id),
CONSTRAINT FOREIGN KEY (develop_id) REFERENCES developer (develop_id)
) Engine=InnoDB;
