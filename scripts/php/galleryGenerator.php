<!DOCTYPE html>
<html lang="en">

<head>
    <title>gallery gen test</title>
    <link href="../../css/cartButton.css" rel="stylesheet" type="text/css" />
    <link href="../../css/galleryGenerator.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
</head>

<body>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: jared
 * Date: 5/2/2014
 * Time: 11:02 PM
 */

include('htmlGenerator.php');

$server = 'localhost';
$username = 'c199grp07';
$password = 'c199grp07';
$schema = 'c199grp07';

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
    $playButton = spanBlock("playButton", imgBlock("playButton", "../../res/image/play.png"));
    $albumArt = spanBlock("albumArt", imgBlock("art", "../../res/image/test.jpg") . $playButton);
    $albumArtButton = anchorBlock("/temp/link", $albumArt . $playButton);

    $albumTitle = divIdClass("albumTitle", "albumText", $row['album_title']);
    $artistName = divIdClass("artistName", "albumText", $row['artist_name']);
    $tags = divIdClass("tags", "albumText", "genre");

    $albumBlock = divId("albumObject", $albumArtButton . $albumTitle . $artistName . $tags);

    $shoppingButton = '<button type="button" value="%s" class="addToCartButton">+ $%s</button>';
    $albumPrice = number_format((float)($row['album_price']) / 100, 2, '.', '');
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

</body>
</html>