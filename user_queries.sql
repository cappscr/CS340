-- Return basic information about the person
SELECT firstName, lastName, birthMonth, birthDay, birthYear FROM people WHERE p.firstName = [user_input] AND p.lastName = [user_input];


-- Return a list of all games (and corresponding roles) that a person has worked on
-- also returns the companies that person worked for (if applicable)
SELECT p.firstName, p.lastName, vg.title, j.name AS "Job", d.name AS "Company" FROM people p INNER JOIN
people_jobs pj ON pj.person_id = p.person_id INNER JOIN
developer d ON d.developer_id = pj.develop_id INNER JOIN 
job j ON j.job_id = pj.job_id INNER JOIN
video_game vg ON vg.game_id = pj.game_id WHERE p.firstName = [user_input] AND p.lastName = [user_input];


-- Return a number of total games that a person has worked on
SELECT COUNT(*) AS "Total Games Created" FROM people_jobs WHERE person_id = (SELECT person_id FROM people WHERE firstName = [user_input] AND lastName = [user_input]);


-- Return the basic information about the platform without manufacturer
SELECT name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, hardDrive, RAM FROM platform WHERE name = [user_input];


-- Return the basic information about the platform with manufacturer
SELECT name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, hardDrive, RAM FROM platform WHERE name = [user_input] AND manufacturer = [user_input];


-- Return basic information about a character
SELECT name FROM character WHERE name = [user_input];


-- Return a list of all games a character has appeared in 
SELECT vg.title, vg.releaseYear AS "Year" FROM game_character c INNER JOIN
game_char gc ON gc.char_id = c.char_id INNER JOIN
video_game vg ON vg.game_id = gc.game_id WHERE c.name = [user_input]
ORDER BY vg.releaseYear ASC;


-- Return a list of all games for a given platform without manufacturer 
SELECT vg.title, vg.releaseYear AS "Year" FROM platform p INNER JOIN
games_platforms gp ON gp.platform_id = p.platform_id INNER JOIN
video_game vg ON vg.game_id = gp.game_id WHERE p.name = [user_input]
ORDER BY vg.releaseYear ASC;


-- Return a number of total games that a character has appeared in
SELECT COUNT(*) AS "Total Appearances" FROM game_char WHERE char_id = (SELECT char_id FROM game_character WHERE name = [user_input]);


-- Return a list of all games for a given platform without manufacturer 
SELECT vg.title FROM platform p INNER JOIN
games_platforms gp ON gp.platform_id = p.platform_id INNER JOIN
video_game vg ON vg.game_id = gp.game_id WHERE p.name = [user_input] AND p.manufacturer = [user_input];


-- Return a number of total games that a platform has
SELECT COUNT(*) AS "Number of Total Games" FROM games_platforms WHERE platform_id = (SELECT platform_id FROM platform WHERE name = [user_input]);


-- Insert into people
INSERT INTO people (firstName, lastName, birthMonth, birthDay, birthYear) VALUES 
(?, ?, ?, ?, ?);


-- Insert into game_character
INSERT INTO game_character (name) VALUES (?);


-- Insert into platform
INSERT INTO platform (name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, hardDrive, RAM) VALUES
(?, ?, ?, ?, ?, ?, ?, ?, ?);


-- Insert into job
INSERT INTO job (name) VALUES (?);


-- Update a row in people
UPDATE people SET firstName = [], lastName = [], birthMonth = [], birthDay = [], birthYear = []
WHERE id=(SELECT id FROM people WHERE firstName = [] AND lastName = []);


-- Update a row in game_character
UPDATE game_character SET name = [] WHERE id=(SELECT id FROM game_character WHERE name = []);


-- Update a row in platform
UPDATE platform SET name = [], manufacturer = [], cost = [], releaseMonth = [], releaseDay = [], releaseYear = [],
graphics = [], hardDrive = [], RAM = [] WHERE id=(SELECT id FROM platform WHERE name = [] AND manufacturer = []);


-- Update a row in job
UPDATE job SET name = [] WHERE id=(SELECT id FROM job WHERE name = []);


-- Delete a row in people
DELETE FROM people WHERE id=[];


-- Delete a row in game_character
DELETE FROM game_character WHERE id=[];


-- Delete a row in plaform
DELETE FROM plaform WHERE id=[];


-- Delete a row in job
DELETE FROM job WHERE id=[];