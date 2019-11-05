-- 1. Create a view football_schedule that displays full schedule in chronological order. 
-- Show day, date, home team, away team, and venue.
CREATE OR REPLACE VIEW football_schedule AS
SELECT days.day, date, home.team AS home, away.team AS away, venues.venue 
FROM schedule
JOIN teams AS home
	ON schedule.home_team_id = home.id
JOIN teams AS away
	ON schedule.away_team_id = away.id
JOIN days
	ON schedule.day_id = days.id
JOIN venues 
	ON schedule.venue_id = venues.id
ORDER BY date;

-- 2. Add two games below. Note: Folsom Field is a new venue.
INSERT INTO venues (venue) VALUES ('Folsom Field');

INSERT INTO schedule (id, date, day_id, venue_id, away_team_id, home_team_id)
VALUES (20, '2017-11-18', 7, 10, 4, 10);

INSERT INTO schedule (id, date, day_id, venue_id, away_team_id, home_team_id)
VALUES (21, '2017-11-18', 7, 8, 6, 9);

-- 3. Make the following changes to 2017-11-18 game between Colorado Buffaloes and UCLA Bruins:
-- New Date: 		2017-11-11
-- New Away Team: 	USC Trojans
UPDATE schedule
SET date = '2017-11-11', away_team_id = 1
WHERE date = '2017-11-18' AND away_team_id = 4 AND home_team_id = 10;

-- 4. Delete 2017-11-18 game between Oregon State Beavers and Arizona State Sun Devils from the database.
DELETE FROM schedule
WHERE date = '2017-11-18' AND away_team_id = 6 AND home_team_id = 9;

-- 5. Display all venues and number of times each venue is used in game_count column. Use an aggregate function.    
SELECT venues.id, venues.venue, COUNT(venues.id) AS game_count
FROM venues
JOIN schedule
	ON schedule.venue_id = venues.id
GROUP BY schedule.venue_id;




