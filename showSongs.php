<html>
<head>
    <script>var _gaq=[['_setAccount','UA-20257902-1'],['_trackPageview']];(function(d,t){ var g=d.createElement(t),s=d.getElementsByTagName(t)[0]; g.async=1;g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
    <script src="./audiojs/audio.min.js"></script>

    <script>
      $(function() { 
        // Setup the player to autoplay the next track

        var a = audiojs.createAll({
          trackEnded: function() {
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
        $('ol li').click(function(e) {
          e.preventDefault();
          //"<?php $_SESSION['songPlaying'] = 0; ?>";
          $(this).addClass('playing').siblings().removeClass('playing');
          audio.load($('a', this).attr('data-src'));
          audio.play();
        });
        // Keyboard shortcuts
        $(document).keydown(function(e) {
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
          } else if (unicode == 32) {
            audio.playPause();
          }
        })
      });
    </script>
</head>

<body>

<?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';
        $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';

        $userCart = new Cart($server, $username, $password, $schema);
        $_POST = $userCart;

        $login = @new mysqli($server, $username, $password, $schema);

        if ($login->connect_error) {
            die("Connect Error: " . $login->connect_error);
        }

        $testSongQuery = $login;

        $baseSongQuery =
            "select so.song_title, so.song_price, so.file_name, al.album_id
            from song so, album al
            where so.album_id = al.album_id;
            ";

        $userSongQuery = sprintf($baseSongQuery);
        $songResults = $testSongQuery->query($userSongQuery);

        if (!$songResults) {
            $message = 'Invalid query: ' . $testSongQuery->errno . "<br />";
            $message .= 'Whole query: ' . $userSongQuery;
            die($message);
        }

        $song = array();
        $songNumber = 0;
        while ($row = $songResults->fetch_assoc()) {

        $song[$songNumber] = $row['song_title'];
        $songFile = $row['file_name'];
        echo "<ol><li><a href='#' data-src='songs/$songFile'>$song[$songNumber]</a></ul></ol>";
        echo "<br>";
        }

   ?>

    </body>
</html>