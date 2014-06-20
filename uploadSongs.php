<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tune Source</title>
    <meta charset="utf-8"/>

    <link href="css/index-style.css" rel="stylesheet" type="text/css"/>
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">

    <!-- Gallery Generator -->
    <link href="css/buttons.css" rel="stylesheet" type="text/css"/>

    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';
    sec_session_start();


    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }
    
    ?>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
        var modal = (function () {
            var
                method = {},
                $overlay,
                $modal,
                $content,
                $close;

            // Center the modal in the viewport
            method.center = function () {
                var top, left;

                top = Math.max($(window).height() - $modal.outerHeight(), 0) / 2;
                left = Math.max($(window).width() - $modal.outerWidth(), 0) / 2;

                $modal.css({
                    top: top + $(window).scrollTop(),
                    left: left + $(window).scrollLeft()
                });
            };

            // Open the modal
            method.open = function (settings) {
                $content.empty().append(settings.content);

                $modal.css({
                    width: settings.width || 'auto',
                    height: settings.height || 'auto'
                });

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

            $('a#login').click(function (e) {

                $.get('ajax.php', function (data) {
                    modal.open({content: data});
                    e.preventDefault();
                });
            });
        });

    </script>
    <script>
        function formhash(form, fname, lname, country, province, address, postal, phone, credit, expiry) {
            if (fname.value == '' || lname.value == '' || country.value == '' || province.value == '' || address.value == ''
                || postal.value == '' || phone.value == '' || credit.value == '' || expiry.value == '') {
                alert("Not all fields have been filled");
                return false;
            }
            form.submit()
            return true;
        }
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
                    <div class="cartBlock"><a href="#cartMukery" id="whiteText" class="cartBox">Cart</a></div>
                </div>

                <div class="item">
                    <div class="loginBlock">
                        <?php

                        if (login_check($mysqli) == true) {
                            echo "<a id=\"whiteText\" class=\"user logout\">Logout</a>";
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

<?php require_once('testUpload.php'); ?>

</div>

</div>

<script>
    // Create the tooltips only when document ready
    $(document).ready(function(){
            $('.cartBox').qtip({
                show: 'click',
                hide: 'click',
                content: { url: 'viewCart.php' },
                position: { adjust: { y: 12 }, my:'top center', at:'bottom center'}
            });
    });

</script>

<script type="text/javascript" src="js/imagesloaded.pkg.min.js"></script>

</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br/>
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>