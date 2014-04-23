use `c199grp07`;

# User example
#delete from `testing`.`user` where `first_name`='Jared';

INSERT INTO `c199grp07`.`user` (
	`first_name`, `last_name`, 
	`birth_date`, 
	`not_a_password`, `email_address`, 
	`city`, `country`) 
VALUES (
	'Jared', 'Smith', 
	'1991-06-30', 'willhashandsaltlater', 
	'jaredsmith@persona.ca', 
	'victoria', 'canada');


# Artist example
#delete from `testing`.`artist` where `artist_name`='in my jaaaaaag';

insert into`c199grp07`. `artist` (
	`artist_name`, `root_dir`)
values (
	'in my jaaaaaag', 'artistName');
 
# Album example
#delete from `testing`.`album` where `album_title` = '... on that bombshell';

insert into `c199grp07` . `album` (
	`artist_id`,
	`album_title`, `album_price`,
	`tags`, `date_of_release`,
	`dir_location`,
	`description`)
values (
	'1',
	'... on that bombshell', '900000',
	'power', '2014-06-10',
	'artistName/albumName',
	'Usually involves irony, maybe write the description out to a fill and refer from that');


# Song example
#delete from `testing`.`song` where `song_title`='Good Night';

insert into `c199grp07` . `song` (
	`album_id`, `song_number`,
	`song_title`,  `song_price`,
	`file_name`)
values (
	'1', '1',
	'good night', '100',
	'good_night.mp3');


# Receipt example
insert into `c199grp07` . `receipt` (
	`user_id`, `total_amount`,
	`items`)
values (
	'1', '900000',
	'1');

select * from receipt;