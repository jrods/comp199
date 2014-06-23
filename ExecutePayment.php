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
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css"/>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>


    <?php
    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');
    include_once 'scripts/php/db_connect.php';
    include_once 'scripts/php/functions.php';

    ?>

    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script>
    <script type="text/JavaScript" src="js/forms.js"></script>
    <script>var _gaq=[['_setAccount','UA-20257902-1'],['_trackPageview']];(function(d,t){ var g=d.createElement(t),s=d.getElementsByTagName(t)[0]; g.async=1;g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
    <script type="text/javascript" src="audiojs/audio.min.js"></script>

</head>

<header class="header fixed bar" role="banner">
    <nav>
        <ul class="bar" id="list">
            <li id="navContent">
                <div class="item">
                    <div class="logoBlock"><span class="temp" ><a id="whiteText" href="index.php">Tune Source</a></span></div>
                </div>
            </li>
        </ul>
    </nav>
</header>
<body>
<div id="contentBody">
<div id="gallery">
    <div id="cart"></div>
<script>
    $.ajax({
        type: 'GET',
        url: 'viewCart.php',
        async: true,
        cache: false,
        success: function(response) {
            $('#cart').html(response);
        }
    }).done(function() {
        $('#cart').css('display','block');
        $('#formCheckout').css('display','none');

    });
</script>


<?php
@session_start();

echo "Download your album here:";
echo "<br>";
if(isset($_SESSION['paymentId'])){
?>
<form action="http://23.226.228.26/userupload/download.php" method="post">
<?php

  $albumCounter = 0;

foreach($_SESSION['allAlbums'] as $album){
    echo '<button type="submit" value="' . $album . '" name="album">' . $album . '</button>';
    echo '<br>';
}


} else {
  echo "No albums purchased";
}
?>
</form>
</div>
</div>
</body>

<footer class="footer fixed bar">
    <div>
        <span id="whiteText">Copyright &copy; 2014</span><br />
        <span id="whiteText">Authors: Sam Beveridge, Calvin Lam, Jared Smith</span>
    </div>
</footer>
</html>
