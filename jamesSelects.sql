-- This will create a table that shows how many games of each genre there are
SELECT g.name, COUNT(vg.title) AS "Number of Games" FROM genre g INNER JOIN
game_genres gg ON g.genre_id = gg.genre_id INNER JOIN
video_game vg ON gg.game_id = vg.game_id
GROUP BY g.name;

-- This will create a table displaying how many games each developer
-- in the developer table have made
SELECT d.name, COUNT(vg.game_id) AS "NumberOfGames" FROM developer d INNER JOIN
video_game vg ON vg.developer = d.developer_id
GROUP BY d.name;

-- This will create a table displaying the games of each genre
SELECT g.name, vg.title FROM genre g INNER JOIN
game_genres gg ON g.genre_id = gg.genre_id INNER JOIN
video_game vg ON gg.game_id = vg.game_id;

-- This will create a table displaying information about each game
SELECT vg.title, vg.releaseMonth, vg.releaseDay, vg.releaseYear, g.name AS  "Genre", d.name AS  "Developer", gs.title AS  "Series"
FROM video_game vg
LEFT JOIN game_genres gg ON gg.game_id = vg.game_id
LEFT JOIN genre g ON g.genre_id = gg.genre_id
LEFT JOIN developer d ON vg.developer = d.developer_id
LEFT JOIN game_series gs ON vg.gameSeries = gs.series_id
GROUP BY vg.title ASC ;

-- Display games released after 2001
SELECT title, releaseYear FROM video_game vg
WHERE releaseYear > 2001;

-- Display developers with more than one game
SELECT d.name, COUNT(vg.game_id) AS "Number of Games" FROM developer d INNER JOIN
video_game vg ON vg.developer = d.developer_id
GROUP BY d.name
HAVING COUNT(vg.game_id) > 1;

-- Display genres with more than 1 game
SELECT g.name, COUNT(vg.title) AS "Number of Games" FROM genre g INNER JOIN
game_genres gg ON g.genre_id = gg.genre_id INNER JOIN
video_game vg ON gg.game_id = vg.game_id
GROUP BY g.name
HAVING COUNT(vg.title) > 1;

-- Shows all information about games that characters are in
SELECT * FROM game_character c
INNER JOIN game_char gc ON c.char_id = gc.char_id
INNER JOIN video_game vg ON vg.game_id = gc.game_id
GROUP BY name ASC

-- Displays people with what developer they work for and what
-- game they worked onm and what job they did
SELECT CONCAT(p.firstName, " ", p.lastName), vg.title, d.name, j.name FROM people p
INNER JOIN people_jobs pj ON p.person_id = pj.person_id
INNER JOIN job j ON j.job_id = pj.job_id
INNER JOIN developer d ON d.developer_id = pj.develop_id
INNER JOIN video_game vg ON vg.game_id = pj.game_id
GROUP BY p.lastName

-- Show how many games each person has worked on
SELECT CONCAT(p.firstName, " ", p.lastName), COUNT(vg.title) AS "Number of Games" FROM people p
INNER JOIN people_jobs pj ON p.person_id = pj.person_id
INNER JOIN video_game vg ON vg.game_id = pj.game_id
GROUP BY p.lastName