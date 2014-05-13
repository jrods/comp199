<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tune Source</title>
    <meta charset = "utf-8" />
		
    <link href="css/index-style.css" rel="stylesheet" type="text/css" />
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">

    <!-- Gallery Generator -->
    <link href="css/cartButton.css" rel="stylesheet" type="text/css" />
    <link href="css/galleryGenerator.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>

</head>

<header class="mainheader">

    <a id="banner" href="index.php"><img src='res/image/Logo.png'></a>

    <nav>
        <ul>
            <li class="active"><a id="navbar" href="index.php">MainPage</a></li>
        </ul>
    </nav>

</header>

<body>
    <div class="contentBody">

        <div id="gallery" class="contentBody">
        <?php
        include('scripts/php/htmlGenerator.php');
        include('scripts/php/shoppingCart.php');

        $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';

        $testCart = new Cart($server,$username,$password,$schema);
        $_POST = $testCart;

        $login = @new mysqli($server, $username, $password, $schema);

        if($login->connect_error) {
        die("Connect Error: ". $login->connect_error);
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
        $message  = 'Invalid query: ' . $testQuery->errno . "<br />";
        $message .= 'Whole query: ' . $userQuery;
        die($message);
        }

        $galleryListItem = '';

        while($row = $userResults->fetch_assoc()) {
        $playButton = spanBlock("playButton", imgBlock("playButton", "res/image/play.png"));

        $albumArt = spanBlock("albumArt", imgBlock("art", "res/image/test.jpg") . $playButton);
        $albumArtButton = anchorBlock("/temp/link", $albumArt . $playButton);

        $albumTitle = divIdClass("albumTitle", "albumText", $row['album_title']);
        $artistName = divIdClass("artistName", "albumText", $row['artist_name']);
        $tags = divIdClass("tags", "albumText", "genre");

        $albumBlock = divId("albumObject", $albumArtButton . $albumTitle . $artistName . $tags);
        $albumPrice = number_format((float)($row['album_price']) / 100, 2, '.', '');
        $currentAlbum = $row['album_title'];
        $addThisItem = "action=addAnItem($currentAlbum);";

        $shoppingButton = '<button type="button" value="%s" class="addToCartButton" >+ $%s</button>';

        $shoppingButton = sprintf($shoppingButton, $row['album_title'], $albumPrice);
        $shoppingBlock = divIdClass("addToCartSpace", "albumItem", $shoppingButton);

        $albumObject = $albumBlock . $shoppingBlock;
        $galleryListItem .= listItem($albumObject);
        }

        $galleryList = unOrderList($galleryListItem);
        $galleryContent = divIdClass("galleryContent", "galleryContent", $galleryList);
        $galleryWrapper = divId("galleryWrapper", $galleryContent);

        echo $galleryWrapper;
        ?>
        </div>

        <aside class="top-sidebar">

            <div id='basic-modal'>
                <input type='button' name='basic' value='Login' class='basic'/>
            </div>

            <!-- modal content -->
            <div id="basic-modal-content">
                <form action="scripts/php/process_login.php" method="post" name="login_form">Email<br>
                    <input type="text" name="email" /><br><br>Password<br>
                    <input type="password" name="password" id="password"/>  <br><br>
                    <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
                </form>
                <p>If you don't have a login, please <a href="register.php">register</a></p>
                <p>If you are done, please <a href="scripts/php/logout.php">log out</a>.</p>
                <p>If you are logged in, you can view this <a href="protected_page.php">page</a></p>
                <p>You are currently logged out.</p>
            </div>

            <div style='display:none'>
                <img src='img/basic/x.png' alt='' />
            </div>

        </aside>

    </div>

<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>

</body>

<footer class="mainfooter">
    <p>Copyright &copy; 2014 <a href="copyright footer" title="tunesourceWebsite">tunesource.com</a></p>
</footer>
</html>