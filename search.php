<?php
error_reporting(0);
include_once('scripts/php/htmlGenerator.php');

/************************************************
 * The Search PHP File
 ************************************************/

$dbhost = "localhost";
$dbname = "c199grp07";
$dbuser = "c199grp07";
$dbpass = "c199grp07";

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}

/************************************************
 * Search Functionality
 ************************************************/

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
    // Build Query
    $query = 'SELECT al.album_title, ar.artist_name, al.album_price FROM album al, artist ar WHERE al.album_title
        LIKE "%' . $search_string . '%" AND ar.artist_id = al.artist_id OR
        ar.artist_name LIKE "%' . $search_string . '%" AND ar.artist_id = al.artist_id';
    //$query = 'SELECT album_title FROM album';

    // Do Search
    $result = $tutorial_db->query($query);
    while ($results = $result->fetch_array()) {
        $result_array[] = $results;
    }
    $galleryListItem = '';
    $itemCounter = 0;
    $newThing[] = "";
    $albumid = 1;
    // Check If We Have Results
    if (isset($result_array)) {
        foreach ($result_array as $result) {

            // Album block creation
            $playButton = spanBlock("playButton", imgBlock("playButton", "res/image/play.png"));
            $albumArt = spanBlock("albumArt", imgBlock("art", "res/image/test.jpg") . $playButton);
            $albumArtButton = albumBlock("album", $albumid, $albumArt . $playButton);

            // Album Info and Link Block
            $albumTitleLink = anchorBlock("/tmp/link", $result['album_title']);
            $albumTitle = divIdClass("albumTitle", "albumText", $albumTitleLink);

            $artistNameLink = anchorBlock("/tmp/link", $result['artist_name']);
            $artistName = divIdClass("artistName", "albumText", $artistNameLink);

            $genreLink = anchorBlock("/tmp/link", "genre");
            $genre = divIdClass("genre", "albumText", $genreLink);

            $albumBlock = divId("albumObject", $albumArtButton . $albumTitle . $artistName . $genre);

            $albumPrice = number_format((float)($result['album_price']) / 100, 2, '.', '');

            // Album Object Button
            $shoppingButton = "<button type=\"button\" value=\"%s\" class=\"addToCartButton\" name=\"addToCartButton" . $itemCounter . "\">+ $%s</button>";
            $shoppingButton = sprintf($shoppingButton, $result['album_title'], $albumPrice);

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
    }
}