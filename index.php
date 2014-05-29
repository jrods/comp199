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

    <?php
    session_start();
    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }

    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

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
            $('submit').click(function (e) {
                $.get('ajax.php', function (data) {
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
                    <div class="logoBlock"><span class="temp" id="whiteText">Tune Source</span></div>
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
                        <input type="text" id="userInput" name="username" placeholder="username"/>
                        <input type="password" id="passInput" name="password" placeholder="password"/>
                        <input type="submit" value="Login" />
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

        include('scripts/php/htmlGenerator.php');
        include('scripts/php/shoppingCart.php');

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
            "select ar.artist_name, al.album_title, al.album_price
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

        // Album block creation
            $playButton = spanBlock("playButton", imgBlock("playButton", "res/image/play.png"));
            $albumArt = spanBlock("albumArt", imgBlock("art", "res/image/test.jpg") . $playButton);
            $albumArtButton = anchorBlock("/temp/link", $albumArt . $playButton);

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

            <div class="playerArt"></div>
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