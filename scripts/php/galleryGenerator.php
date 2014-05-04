<!DOCTYPE html>
<html lang="en">

<head>
    <title>gallery gen test</title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <style type="text/css">
        * {
            font-family: "Source Sans Pro";
        }

        a {
            text-decoration: none;
            color: #000;
        }

        .galleryWrapper {
            width: 45em;
            height: 30em;
            margin-left: auto;
            margin-right: auto;
        }

        .galleryContent {
            width: 45em;
            height: 30em;
            display: inline-block;
        }

        .itemList {
            list-style-type: none;
            vertical-align: top;
            display: inline-block;
            padding-left: 0em;
        }

        li.item {
            overflow: hidden;
            display: inline-block;
            margin: 0px 22px 0em 0px;
        }

        #albumObject {
            position: relative;
            display: inline-block;
            width: 8.6em;
            height: 12.5em;
            border: 1px solid #ccc;
        }

        .albumText {
            padding-left: 0.25em;
        }

        #albumTitle {
            font-size: 0.9em;
        }

        #artistName {
            font-size: 0.8em;
        }

        #tags {
            font-size: 0.7em;
            color: #aaa;
        }

        #art {
            width: 8.6em;
            height: 8.6em;
            top: 1em;
        }

        .playButton img {
            position: absolute;
            top: 42px;
            left: 38px;
        }

        button.addToCartButton{
            font-size: 14px;
            color: #ffffff;
            padding: 3px 10px;
            margin: 3px 19px 2px;
            background: -moz-linear-gradient(
                top,
                #00db00 0%,
                #1f9900);
            background: -webkit-gradient(
                linear, left top, left bottom,
                from(#00db00),
                to(#1f9900));
            -moz-border-radius: 9px;
            -webkit-border-radius: 9px;
            border-radius: 9px;
            border: 0px solid #194d14;
            -moz-box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            -webkit-box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            box-shadow:
            0px 1px 3px rgba(255,255,255,0),
            inset 0px 0px 1px rgba(255,255,255,0.6);
            text-shadow:
            1px 1px 1px rgba(000,000,000,0.7),
            2px 2px 6px rgba(000,000,000,0.4);
        }


    </style>
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
"select ar.artist_name, al.album_title
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

while($row = $userResults->fetch_assoc()) {
    $artistNameDiv = divIdClass("albumTitle", "albumText", $row['album_title']);
    $albumTitleDiv = divIdClass("artistName", "albumText", $row['artist_name']);
    $tags = divIdClass("tags", "albumText", "temp");

    $playButton = spanBlock("playButton", imgBlock("playButton", "/res/image/play.png"));
    $albumArt = spanBlock("albumArt", imgBlock("art", "/res/image/test.jpg") . $playButton);
    $mainBlock = anchorBlock("albumObject", "/temp/link", $albumArt  . $artistNameDiv . $albumTitleDiv . $tags);

    $shoppingButton = '<button type="button" name="" value="" class="addToCartButton">+ add to cart</button>';
    $shoppingBlock = divIdClass("addToCartSpace", "albumItem", $shoppingButton);

    $albumObject = $mainBlock . $shoppingBlock;
    $galleryListItem = $galleryListItem . listItem($albumObject);
}

$galleryList = unOrderList($galleryListItem);
$galleryContent = divIdClass("galleryContent", "galleryContent", $galleryList);
$galleryWrapper = divId("galleryWrapper", $galleryContent);

echo $galleryWrapper;

?>


</body>
</html>