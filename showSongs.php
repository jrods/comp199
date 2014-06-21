<html>
<head>
    <link rel="stylesheet" href="css/music-player.css" media="screen">

    <script src="./audiojs/audio.min.js"></script>

    <script>
        $(function () {
            // Setup the player to autoplay the next track

            var a = audiojs.createAll({
                trackEnded: function () {
                    var next = $('ol li.playing').next();
                    if (!next.length) next = $('ol li').first();
                    next.addClass('playing').siblings().removeClass('playing');
                    audio.load($('a', next).attr('data-src'));
                    audio.play();
                }
            });

            // Load in the first track
            var audio = a[0];
            first = $('ol a').attr('data-src');
            $('ol li').first().addClass('playing');
            audio.load(first);

            // Load in a track on click
            $('ol li').click(function (e) {
                e.preventDefault();

                $(this).addClass('playing').siblings().removeClass('playing');
                audio.load($('a', this).attr('data-src'));
                audio.play();

                var nowPlaying = document.getElementById('nowPlaying');
                $(nowPlaying).html('<span style="font-size:16px;float:left;margin-top:5px;margin-right:4px;" class="spacing">Now Playing:</span> ' +
                    '<h3>' + this.firstChild.innerHTML + '</h3>')

            });
            // Keyboard shortcuts
            $(document).keydown(function (e) {
                var unicode = e.charCode ? e.charCode : e.keyCode;
                // right arrow
                if (unicode == 39) {
                    var next = $('li.playing').next();
                    if (!next.length) next = $('ol li').first();
                    next.click();
                    // back arrow
                } else if (unicode == 37) {
                    var prev = $('li.playing').prev();
                    if (!prev.length) prev = $('ol li').last();
                    prev.click();
                    // spacebar
                }
            })
        });
    </script>
</head>

<body>
<div class="player">
    <div class="playerArt">
        <?php
        if ($_GET['name'] == 7){
        ?>
        <img src="http://23.226.228.26/userupload/res/image/<?php echo $_GET['name']; ?>.gif" id="playerArt">
        <?php
        } else {
        ?>
        <img src="http://23.226.228.26/userupload/res/image/<?php echo $_GET['name']; ?>.jpg" id="playerArt">
    </div>
    <?php } ?>

    <audio preload></audio>
    <?php

    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';
    session_start();

    if(!isset($_GET['name'])) {
        echo 'Problem, name wasn\'t posted';
        die;
    }

    $db = new mysqli(HOST, USER, PASSWORD, DATABASE);

    if($db->connect_error) {
        die("Connect Error: " . $db->connect_error);
    }

    $albumId = $_GET['name'];

    $artistAlbumQuery = sprintf(
        'select al.album_title, al.album_price, ar.artist_name, al.description, al.tags
         from artist as ar
           inner join album as al
             on ar.artist_id = al.artist_id
           where al.album_id = %s LIMIT 1', $albumId);

    $query = $db->query($artistAlbumQuery);

    if(!$query) {
        $message = 'Invalid query: ' . $db->errno . "<br />";
        $message .= 'Whole query: ' . $artistAlbumQuery;
        die($message);
    }

    if($row = $query->fetch_assoc()) {
        $album = new Album($row['album_title'], $row['album_price'], $row['artist_name']);
        $album->setDescription($row['description']);
        $album->setGenre($row['tags']);
    }

    $songQuery = sprintf(
        'select so.song_title, so.song_number, so.file_name
         from song as so
           inner join album as al
             on al.album_id = so.album_id
         where al.album_id = %s
           order by so.song_number asc', $albumId);

    $query = $db->query($songQuery);

    if(!$query) {
        $message = 'Invalid query: ' . $db->errno . "<br />";
        $message .= 'Whole query: ' . $songQuery;
        die($message);
    }

    while($row = $query->fetch_assoc()) {
        $album->addSong(new Song($row['song_title'], $row['song_number'], $row['file_name']));
    }

    echo '<div id="albumInfo">';
    echo '<div id="nowPlaying" style="display:inline-block;"></div>';
    echo sprintf('<div id="album"><h3 class="spacing"><a class="showLine" href="gonna be javascript call eventually">%s<a></a></h3></div>', $album->getTitle());
    echo sprintf('<div id="artist"><span>by </span><h4><a class="showLine" href="gonna be javascript call eventually">%s</a></h4></div>', $album->getArtist());

    echo '<div id="songList"><span class="spacing">Song List:</span>';
    $orderList = '<ol class="spacing">%s</ol>';
    $listItem = '<li>%s</li>';
    $allItems = '';

    foreach($album->getSongList() as $song) {
        $albumNameFile = str_replace(' ', '', $album->getTitle());
        $link = sprintf('<a id="song" class="showLine" href="#" data-src="http://23.226.228.26/userupload/%s/%s">%s</a>', $albumNameFile, $song->getFileName(), ucwords($song->getTitle()));
        $allItems .= sprintf($listItem, $link);
    }

    echo sprintf($orderList, $allItems);
    echo '</div>';

    $genre = sprintf('<span style="font-size:13px;color:#444;margin-left: 10px;" class="spacing">Genre: <a class="showLine" href="gonna be javascript eventually">%s</a></span>', $album->getGenre());
    echo divId('genrePlayer', $genre);
    echo divIdClass('', 'info', 'Info:');
    echo divId('description', $album->getDescription());
    echo divId('releaseDate', $album->getDateOfRelease());

    echo '</div>';
    ?>

</div>
</body>
</html>