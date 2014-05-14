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
    
    		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script>
			var modal = (function(){
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
						top:top + $(window).scrollTop(), 
						left:left + $(window).scrollLeft()
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

				$(document).ready(function(){
					$('body').append($overlay, $modal);
				});

				$close.click(function(e){
					e.preventDefault();
					method.close();
				});

				return method;
			}());

			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){

 			  $('a#login').click(function(e){

                            $.get('ajax.php', function(data){
					modal.open({content: data});
                                        e.preventDefault();
				});
			  });
                     });

</script>

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
            <a id="login" href="#">Login</a>

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