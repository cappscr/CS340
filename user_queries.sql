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