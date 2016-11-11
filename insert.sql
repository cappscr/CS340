--Insert data into video_game
INSERT INTO video_game VALUES
('The Elder Scrolls V: Skyrim', 11, 11, 2011, (SELECT series_id FROM game_series WHERE name = 'The Elder Scrolls'), (SELECT developer_id FROM developer WHERE name = 'Bethesda Game Studio')),
('The Elder Scrolls IV: Oblivion', 3, 20, 2006, (SELECT series_id FROM game_series WHERE name = 'The Elder Scrolls'), (SELECT developer_id FROM developer WHERE name = 'Bethesda Game Studio')),
('Fallout 4', 11, 10, 2015, (SELECT series_id FROM game_series WHERE name = 'Fallout'), (SELECT developer_id FROM developer WHERE name = 'Bethesda Game Studio')),
('Pokemon Go', 7, 6, 2016, (SELECT series_id FROM game_series WHERE name = 'Pokemon'), (SELECT developer_id FROM developer WHERE name = 'Niantic Labs')),
('No Man Sky', 8, 9, 2016, NULL, (SELECT developer_id FROM developer WHERE name = 'Hello Games')),
('Pokemon Snap' 3, 21, 1999, (SELECT series_id FROM game_series WHERE name = 'Pokemon'), (SELECT developer_id FROM developer WHERE name = 'HAL Laboratory, Inc.'),
('Diablo II', 6, 29, 2000, (SELECT series_id FROM game_series WHERE name = 'Diablo'), (SELECT developer_id FROM developer WHERE name = 'Blizzard');

--Insert data into developer
INSERT INTO developer VALUES
('Bethesda Game Studio', 'Rockville'),
('Niantic Labs', 'San Francisco'), 
('Hello Games', 'Guildford')
('Blizzard', 'Irvine'),
('Turn 10 Studios', 'Redmond'),
('Infinity Ward', 'Encino'),
('Treyarch', 'Santa Monica'),
('Sledgehammer Games', 'Foster City'),
('Game Freak, Inc.', 'Tokyo'),
('HAL Laboratory, Inc.', 'Tokyo');

--Insert data into genre
INSERT INTO genre VALUES
('Role-Playing Game'),
('Simulation'),
('Action-Adventure'),
('First-Person Shooter'),
('Racing'),
('Real-Time Strategy'),
('Massively Multiplayer Online Role-Playing Game'),
('Sports');

--Insert data into game_series
INSERT INTO game_series VALUES
('The Elder Scrolls'),
('Fallout'),
('Pokemon'),
('Call Of Duty'),
('Madden'),
('Forza Motorsport'),
('Doom'),
('Diablo'),
('StarCraft');

--Insert data into game_genres
INSERT INTO game_genres VALUES
((SELECT game_id FROM video_game WHERE name = 'The Elder Scrolls V: Skyrim'), (SELECT genre_id FROM genre WHERE name = 'Role-Playing Game')),
((SELECT game_id FROM video_game WHERE name = 'The Elder Scrolls IV: Oblivion'), (SELECT genre_id FROM genre WHERE name = 'Role-Playing Game')),
((SELECT game_id FROM video_game WHERE name = 'Fallout 4'), (SELECT genre_id FROM genre WHERE name = 'Role-Playing Game')),
((SELECT game_id FROM video_game WHERE name = 'Pokemon Go'), (SELECT genre_id FROM genre WHERE name = 'Simulation')),
((SELECT game_id FROM video_game WHERE name = 'No Man Sky'), (SELECT genre_id FROM genre WHERE name = 'Action-Adventure')),
((SELECT game_id FROM video_game WHERE name = 'Pokemon Snap'), (SELECT genre_id FROM genre WHERE name = 'Simulation')),
((SELECT game_id FROM video_game WHERE name = 'Diablo II'), (SELECT genre_id FROM genre WHERE name = 'Role-Playing Game'));

-- Platform Inserts including Gameboy Color, Playstation - Playstation 4, Xbox - Xbox One
INSERT INTO platform (name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, RAM) VALUES 
("Gameboy Color", "Nintendo", "069.99", 11, 18, 1998, "32 kB");

INSERT INTO platform (name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, RAM) VALUES
("Playstation", "Sony", "300.00", 9, 9, 1995, "GPU and Geometry Transformation Engine (GTE)", "2 MB"),
("Xbox", "Microsoft", "", "400.00", 11, 15, 2001, "Nvidia NV2A", "64 MB"), 
("Playstation 2", "Sony", "299.00", 10, 26, 2000, "GS Core: Parallel Rendering Processor with embeddedd DRAM", "32 MB"),
("Xbox 360", "Microsoft", "", 11, 22, 2005, "ATI Xenos", "512 MB");

INSERT INTO platform (name, manufacturer, cost, releaseMonth, releaseDay, releaseYear, graphics, hardDrive, RAM) VALUES
("Playstation 3", "Sony", "499.99", 11, 17, 2006, "Nvidia RSX", "20 GB", "256 MB"),
("Playstation 4", "Sony", "399.99", 11, 15, 2013, "AMD GPGPU", "500 GB", "8 GB"),
("Xbox One", "Microsoft", "", 11, 22, 2013, "AMD Radeon GCN", "500 GB", "8 GB");

INSERT INTO platform (name, manufacturer) VALUES 
("Android", "Google"),
("Windows 7 PC", "Microsoft"),
("iOS", "Apple");

-- Character inserts 
INSERT INTO character (name) VALUES ("Pikachu"), ("Master Chief"), ("Lara Croft"), ("Sonic"), ("Super Mario"), ("Spyro");


-- job inserts including composer, lead programmer, and artist
INSERT INTO job (name) VALUES ("composer"), ("lead programmer"), ("artist");


-- people inserts with birthday 
INSERT INTO people (firstName, lastName, birthMonth, birthDay, birthYear) VALUES
("Junichi", "Masuda", 1, 12, 1968);


-- people inserts without birthdays
INSERT INTO people (firstName, lastName) VALUES 
("Guy", "Carver"), ("Jeremy", "Soule"), ("Matthew Carofano"), ("Craig", "Walton"), ("Inon Zur"),
("Istvan", "Pely"), ("Harry", "Denholm"), ("Ryan", "Doyle"), ("Innes", "McKendrick"), ("Sean", "Murray"),
("David", "Ream"), ("Paul", "Weir"), ("Grant", "Duncan"), ("Jacob", "Golding");

INSERT INTO people (firstName, lastName, birthYear) VALUES 
("Dennis", "Hwang", 1978);
