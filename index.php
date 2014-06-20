<!DOCTYPE html>
<html lang="en">
<head>
    <!--
    Comp 199 Project, Digital Music Store
    Created by: Sam Beveridge, Calvin Lam, Jared Smith
    -->
    <title>Tune Source</title>
    <meta charset="utf-8"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">

    <link href="css/index-style.css" rel="stylesheet" type="text/css"/>


    <!-- Gallery Generator -->
    <link href="css/buttons.css" rel="stylesheet" type="text/css"/>
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/index.css" media="screen">

    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once('scripts/php/db_connect.php');
    include_once('script/php/psl-config.php');
    include_once('scripts/php/functions.php');
    sec_session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <script src="./audiojs/audio.min.js"></script>
    <script type="text/javascript" src="custom.js"></script>

    <script>
        var _gaq = [
            ['_setAccount', 'UA-20257902-1'],
            ['_trackPageview']
        ];

        (function (d, t) {
            var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
            g.async = 1;
            g.src = '//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'))

    </script>
</head>

<header class="header fixed bar" role="banner">
    <nav>
        <ul class="bar" id="list">
            <li id="navContent">
                <div class="item">
                    <div class="logoBlock"><span class="temp"><a id="whiteText" href="index.php">Tune Source</a></span>
                    </div>
                </div>

                <div class="item">
                    <div class="searchBlock">

                        <input type="text" id="searchBar" placeholder="Search for something" autocomplete="off">

                        <div id="searchButton">
                            <button value="searchButton"><img id="searchImage" src="res/image/search.png"></img>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="item">
                    <div class="cartBlock"><button value="false" onclick="cartDisplay(this)" id="removeItem" class="cartBox loginButton whiteText" style="font-size: 18px;">Cart</button></div>
                </div>

                <div class="item">
                    <div class="loginBlock">
                        <?php

                        if (login_check($mysqli) == true) {
                            echo '<a class="logout" id="whiteText" href="scripts/php/logout.php">&nbsp;Logout</a>';
                            echo sprintf("<div id=\"whiteText\" class=\"user username\">Hello %s <a href=\"uploadSongs.php\" class=\"whiteText showLine\" style=\"margin-left:10px;\">Upload</a></div>", $_SESSION['username']);
                        } else {
                            printf('<a class="register" id="whiteText" href="#">Register</a>
                                    <form action="scripts/php/process_login.php" method="post" name="login_form">
                                    <input class="textBox" type="text" id="username" name="username" placeholder="username"/>
                                    <input class="textBox" type="password" id="password" name="password" placeholder="password"/>
                                    <input type="button" value="Login" id="whiteText" class="loginButton" onclick="formhash(this.form, this.form.password);" />
                                    </form>');
                        }
                        ?>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</header>

<body>
<div class="contentBody">

    <div id="cart" class="cartContainer"></div>

    <div id="searchGallery">
        <?php
        require_once('search.php');
        ?>
    </div>

    <div id="gallery">
        <?php

        if (login_check($mysqli) == true) {
            $logged = 'in';
        } else {
            $logged = 'out';
        }

        $login = @new mysqli(HOST, USER, PASSWORD, DATABASE);

        if ($login->connect_error) {
            die("Connect Error: " . $login->connect_error);
        }

        $testQuery = $login;

        $baseQuery =
            "select ar.artist_name, al.album_title, al.album_price, al.album_id, al.tags
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

        while ($row = $userResults->fetch_assoc()) {
            $_SESSION['albumPicked'][$row['album_id']] = $row['album_id'];
            // Album block creation
            $playButton = spanBlock("playButton", imgBlock("playButton", "res/image/play.png"));
            $albumArt = spanBlock("albumArt", imgBlock("art", "res/image/test.jpg") . $playButton);
            $albumArtButton = albumBlock("album", $row['album_id'], $albumArt . $playButton);

            // Album Info and Link Block
            $albumTitleLink = anchorBlock("/tmp/link", $row['album_title']);
            $albumTitle = divIdClass("albumTitle", "albumText", $albumTitleLink);

            $artistNameLink = anchorBlock("/tmp/link", $row['artist_name']);
            $artistName = divIdClass("artistName", "albumText", $artistNameLink);

            $genreLink = anchorBlock("/tmp/link", $row['tags']);
            $genre = divIdClass("genre", "albumText", $genreLink);

            $albumBlock = divId("albumObject", $albumArtButton . $albumTitle . $artistName . $genre);

            $albumPrice = number_format((float)($row['album_price']) / 100, 2, '.', '');

            // Album Object Button
            $shoppingButton = "<button id=\"addToCart\" type=\"button\" value=\"%s\" class=\"addToCartButton\" name=\"addToCartButton" . $itemCounter . "\">+ $%s</button>";
            $shoppingButton = sprintf($shoppingButton, $row['album_title'], $albumPrice);

            // Allows album object to be submitted to sessions
            $newThing[$itemCounter] = "addToCartButton" . $itemCounter;
            $itemCounter++;

            $formBlock = sprintf("<form name=\"input\" method=\"method\">%s</form>", $shoppingButton);
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

            <div class="playerContainer">

            </div>

        </aside>
    </div>
</div>

<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
<script type="text/javascript" src="custom.js"></script>


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
        method.close = function () {
            $modal.hide();
            $overlay.hide();
            $content.empty();
            $(window).unbind('resize.modal');
        };

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
        $('a.register').click(function (e) {
            $.get('register.php', function (data) {
                modal.open({content: data});
                e.preventDefault();
            });
        });
    });
</script>

<script type="text/javascript" src="js/cartController.js"></script>
<script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>

</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br/>
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>