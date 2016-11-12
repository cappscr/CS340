-- game_platforms
-- (game_id, platform_id)
INSERT INTO games_platforms VALUES
-- Skyrim
(1,8), (1,7), (1,6), (1,5), (1,10),
-- Oblivion
(2,5), (2,6),
-- Fallout 4
(3,8), (3,7), (3,10),
-- Pokemon Go
(4,11), (4,9),
-- No Man Sky
(5,10), (5,7),
-- Diablo II
(7,10);


-- game_char
-- (game_id), (char_id)
INSERT INTO game_char VALUES
-- Pokemon Go
(4,1), (6,1);


-- people_jobs
-- (person_id, job_id, game_id, develop_id)
INSERT INTO people_jobs VALUES
(1, 1, 4, 2), (16, 3, 4, 2), (2, 2, 1, 1), (2, 2, 2, 1), 
(3, 1, 1, 1), (4, 3, 1, 1), (3, 1, 2, 1), (4, 3, 2, 1),
(11, 2, 5, 3), (9, 2, 5, 3), (10, 2, 5, 3), (12, 2, 5, 3), (8, 2, 5, 3),
(2, 2, 3, 1), (7, 3, 3, 1), (6, 1, 3, 1), (14, 3, 5, 3), (15, 3, 5, 3),
(13, 1, 5, 3), (5, 2, 2, 1);