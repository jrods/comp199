use `c199grp07`;

select u.first_name, u.last_name, ar.artist_name, al.album_title, s.song_number, s.song_title
from user u, artist ar, song s, album al
where u.artist_id = ar.artist_id
and ar.artist_id = al.artist_id
and al.album_id = s.album_id;

/*
select u.first_name, u.last_name, ar.artist_name
from user u, artist ar
where u.artist_id = ar.artist_id;*/