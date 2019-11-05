-- Display albums that have the word "on" somewhere in the album title.
-- Sort results in alphabetical order by album title.
SELECT * FROM albums
WHERE title LIKE '%on%'
ORDER BY title;

-- without artis_id
SELECT title, artists.name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
WHERE title LIKE '%on%'
ORDER BY title;

-- Display tracks that have 'AAC audio file' format
SELECT tracks.name,  composer, media_types.name, unit_price
FROM tracks
JOIN media_types
	ON tracks.media_type_id = media_types.media_type_id
WHERE media_types.name = 'AAC audio file'
ORDER BY tracks.name;

-- Display R&B/Soul and Jazz tracks that have a composer
-- Sort results in reverse-alphabetical order by track name
SELECT tracks.track_id, tracks.name, composer, milliseconds, genres.name
FROM tracks
JOIN genres
	ON tracks.genre_id = genres.genre_id
WHERE ( genres.name = 'R&B/Soul' OR genres.name = 'Jazz' ) AND composer IS NOT NULL
ORDER BY tracks.name DESC;