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

    <style>
  form { display: block; margin: 20px auto; background: #fff; border-radius: 10px; padding: 15px }

 </style> 


    <link href="css/index-style.css" rel="stylesheet" type="text/css"/>

    <!-- Gallery Generator -->
    <link href="css/buttons.css" rel="stylesheet" type="text/css"/>
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" href="css/music-player.css" media="screen">
    


    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once('scripts/php/db_connect.php');
    include_once('scripts/php/psl-config.php');
    include_once('scripts/php/functions.php');
    sec_session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js">
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
<?php require_once('testUpload.php'); ?>

</div>

</div>

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

<script type="text/javascript" src="js/indexController.js"></script>
<script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>

</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br/>
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>