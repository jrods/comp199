<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Comp 199 Project, Digital Music Store
    Created by: Sam Beveridge, Calvin Lam, Jared Smith
    -->

    <title>Tune Source</title>
    <meta charset="utf-8"/>

    <link href="css/index-style.css" rel="stylesheet" type="text/css"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">

    <!-- Gallery Generator -->
    <link href="css/buttons.css" rel="stylesheet" type="text/css"/>
    <link href="js/jquery.qtip.css" rel="stylesheet" type="text/css"/>
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="./includes/index.css" media="screen">

    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';
    session_start();
    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }

    $_SESSION['songPlaying'] = "No song playing.";
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
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

    <script>
        var modal = (function () {
            var method = {}, $overlay, $modal, $content, $close;

            // Center the modal in the viewport
            method.center = function () {
                var top, left;

                top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
                left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

                $modal.css({ top: top + $(window).scrollTop(), left: left + $(window).scrollLeft()});
            };

            // Open the modal
            method.open = function (settings) {
                $content.empty().append(settings.content);

                $modal.css({ width: settings.width || 'auto', height: settings.height || 'auto'});

                method.center();
                $(window).bind('resize.modal', method.center);
                $modal.show();
                $overlay.show();
            };

            // Close the modal
            method.close = function () { $modal.hide(); $overlay.hide(); $content.empty(); $(window).unbind('resize.modal'); };

            // Generate the HTML and add it to the document
            $overlay = $('<div id="overlay"></div>');
            $modal = $('<div id="modal"></div>');
            $content = $('<div id="content"></div>');
            $close = $('<a id="close" href="#"></a>');

            $modal.hide();
            $overlay.hide();
            $modal.append($content, $close);

            $(document).ready(function () {
                $('body').append($overlay, $modal);
            });

            $close.click(function (e) {
                e.preventDefault();
                method.close();
            });

            return method;
        }());

        // Wait until the DOM has loaded before querying the document
        $(document).ready(function () {
            $('a#register').click(function (e) {
                $.get('register1.php', function (data) {
                    modal.open({content: data});
                    e.preventDefault();
                });
            });
        });
    </script>

</head>

<header class="header fixed bar" role="banner">
    <nav>
        <ul class="bar" id="list">
            <li id="navContent">
                <div class="item">
                    <div class="logoBlock"><span class="temp" ><a id="whiteText" href="index.php">Tune Source</a></span></div>
                </div>

                <div class="item">
                    <div class="searchBlock">
                        <input type="search" placeholder="search" id="searchBar" />
                        <div id="searchButton">
                            <button value="searchButton"><img id="searchImage" src="res/image/search.png"></img></button>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="cartBlock"><a href="#cartMukery" id="whiteText" class="cartBox" title="<?php require_once "viewCart.php"; ?>">Cart</a></div>
                </div>

                <div class="item">
                    <div class="loginBlock">
                        <form action="scripts/php/process_login.php" method="post" name="login_form">
                        <input type="text" id="username" name="username" placeholder="username"/>
                        <input type="password" id="password" name="password" placeholder="password"/>
                        <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
                        </form>
                        <a id="register" href="#">Register</a>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

<body>
<div class="contentBody">

    <div id="gallery">
        <?php

        if (login_check($mysqli) == true) {
           $logged = 'in';
        } else {
           $logged = 'out';
        }

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

        $testQuery = $login;

        $baseQuery =
            "select ar.artist_name, al.album_title, al.album_price, al.album_id
            from artist ar, album al
            where ar.artist_id = al.artist_id;
            ";

        $userQuery = sprintf($baseQuery);
        $userResults = $testQuery->query($userQuery);

        if (!$userResults) {
            $message = 'Invalid query: ' . $testQuery->errno . "<br />";
            $message .= 'Whole query: ' . $userQuery;
            die($message);
        }
        


        $galleryListItem = '';
        $itemCounter = 0;
        $newThing[] = "";
        $songsArray = array("http://kolber.github.io/audiojs/demos/mp3/01-dead-wrong-intro.mp3",
                       "http://kolber.github.io/audiojs/demos/mp3/02-juicy-r.mp3",
                       "http://kolber.github.io/audiojs/demos/mp3/03-its-all-about-the-crystalizabeths.mp3",
                       "http://kolber.github.io/audiojs/demos/mp3/04-islands-is-the-limit.mp3",
                       "http://kolber.github.io/audiojs/demos/mp3/05-one-more-chance-for-a-heart-to-skip-a-beat.mp3",
                       "http://kolber.github.io/audiojs/demos/mp3/06-suicidal-fantasy.mp3");

        while ($row = $userResults->fetch_assoc()) {

        // Album block creation
            $playButton = spanBlock("playButton", imgBlock("playButton", "res/image/play.png"));
            $albumArt = spanBlock("albumArt", imgBlock("art", "res/image/test.jpg") . $playButton);
            $albumArtButton = albumBlock($row['album_id'], $albumArt . $playButton);
        // Album Info and Link Block
            $albumTitleLink = anchorBlock("/tmp/link", $row['album_title']);
            $albumTitle = divIdClass("albumTitle", "albumText", $albumTitleLink);

            $artistNameLink = anchorBlock("/tmp/link", $row['artist_name']);
            $artistName = divIdClass("artistName", "albumText", $artistNameLink);

            $genreLink = anchorBlock("/tmp/link", "genre");
            $genre = divIdClass("genre", "albumText", $genreLink);

            $albumBlock = divId("albumObject", $albumArtButton . $albumTitle . $artistName . $genre);

            $albumPrice = number_format((float)($row['album_price']) / 100, 2, '.', '');

        // Album Object Button
            $shoppingButton = "<button type=\"button\" value=\"%s\" class=\"addToCartButton\" name=\"addToCartButton" . $itemCounter . "\">+ $%s</button>";
            $shoppingButton = sprintf($shoppingButton, $row['album_title'], $albumPrice);

            // Allows album object to be submitted to sessions
            $newThing[$itemCounter] = "addToCartButton" . $itemCounter;
            $itemCounter++;

            $formBlock = sprintf("<form name=\"input\" method=\"method\">%s</form>", $shoppingButton );
            $shoppingBlock = divIdClass("addToCartSpace", "albumItem", $formBlock);

        // Where it all comes together
            $albumObject = $albumBlock . $shoppingBlock;
            $galleryListItem .= listItem($albumObject);

        }

        $galleryList = unOrderList($galleryListItem);
        $galleryContent = divIdClass("galleryContent", "galleryContent", $galleryList);
        $galleryWrapper = divId("galleryWrapper", $galleryContent);

        echo $galleryWrapper;

        $itemCounter--;
        ?>
    </div>

    <div class="rightSidebar fixed">
        <aside class="musicPlayer">

            <div class="playerArt"><?php if(isset($_SESSION['allAlbums'][0])){ echo $_SESSION['allAlbums'][0]; } ?><audio preload></audio></div>
        </aside>
    </div>
</div>

<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>


<script>

        $('button[type=button]').click(function (e) {
        var name = $(this).attr("name");
        var albumName = $('button[name=' + name + ']').val();
        $.post('addToCart.php', {name: albumName}, function (data) {
            $('.cartBox').qtip({
                show: true,
                hide: 'click',
                content: { text: data },
                position: {adjust: { y: 13 }, my:'top center', at:'bottom right', target:'.cartBox'}
          });
        });
    });

    $('a').click(function (e) {
        //var name = $(this).attr("name");
        //var albumName = $('button[name=' + name + ']').val();
        $.post('showSongs.php', function (data) {
            $('.1').qtip({
                show: true,
                hide: 'click',
                content: { text: data },
          });
        });
    });
    // Create the tooltips only when document ready
    $(document).ready(function(){
        // Show tooltip on all <a/> elements with title attributes, but only when
        // clicked. Clicking again will hide it.
        var a = "<?php echo $_SESSION['change']?>";

        if (a < 1){
            $('.cartBox').qtip({
                show: 'click',
                hide: 'click',
                content: { url: 'viewCart.php' },
                position: { adjust: { y: 13 }, my:'top center', at:'bottom center' }
            });
        } else {
            $('.cartBox').qtip({
                show: true,
                hide: 'click',
                content: { url: 'viewCart.php' },
                position: { adjust: { y: 13 }, my:'top center', at:'bottom center' }
            });
        }
        "<?php $_SESSION['change'] = 0?>"
    });

</script>

<script type="text/javascript" src="js/jquery.qtip.min.js"></script>
<script type="text/javascript" src="js/jquery.qtip.js"></script>
<script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>
</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br />
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>