-- 1. Create a view dramas that displays all drama DVDs with release date not set to NULL. 
-- Show DVD ID, DVD title, release date, award, format, genre, label, rating, and sound.
CREATE OR REPLACE VIEW dramas AS
SELECT dvd_title_id, title, release_date, award, formats.format, genres.genre, labels.label, ratings.rating, sounds.sound
FROM dvd_titles
JOIN formats
	ON dvd_titles.format_id = formats.format_id
JOIN genres
	ON dvd_titles.genre_id = genres.genre_id
JOIN labels
	ON dvd_titles.label_id = labels.label_id
JOIN ratings
	ON dvd_titles.rating_id = ratings.rating_id
JOIN sounds
	ON dvd_titles.sound_id = sounds.sound_id
WHERE release_date IS NOT NULL AND genres.genre = 'Drama'
ORDER BY dvd_title_id;

-- 2. Add the movie below:
INSERT INTO dvd_titles (title, release_date, award, label_id, sound_id, genre_id, rating_id, format_id)
VALUES ('The God Father', '1972-03-24', '45th Academy Award for Best Picture', 92, 4, 9, 7, 2);

-- 3. Make the following changes to the DVD titled Zero Effect:
-- New Label: 	Columbia TriStar
-- New Genre: 	Comedy
-- New Format:	Fullscreen
UPDATE dvd_titles
SET label_id = 24, genre_id = 7, format_id = 4
WHERE dvd_title_id = 5131;

-- 4. Delete Major League 3: Back To The Minors from the database.
DELETE FROM dvd_titles
WHERE dvd_title_id = 5932;

-- 5. Display number of characters for the longest and shortest title in the database. 
-- Name columns longest_title and shortest_title respectively. Use aggregate functions.
SELECT MAX(LENGTH(title)) AS longest_title, MIN(LENGTH(title)) AS shortest_title
FROM dvd_titles;

-- 6. Display all genres and number of DVDs belonging to each genre as dvd_count column. 
-- Show genre ID, genre name, and DVD count. Use an aggregate function.
SELECT genres.genre_id, genres.genre, COUNT(genres.genre_id) AS dvd_count
FROM genres
JOIN dvd_titles
	ON dvd_titles.genre_id = genres.genre_id
GROUP BY dvd_titles.genre_id;