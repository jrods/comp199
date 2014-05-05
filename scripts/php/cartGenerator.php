<!DOCTYPE html>
<html lang="en">

<head>
    <title>gallery gen test</title>
    <link href="../../css/cartButton.css" rel="stylesheet" type="text/css" />
    <link href="../../css/galleryGenerator.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'/>
    <script>
    
    inc = (function () {
    var variableName = 0;

    var init = function () {
        variableName += 1;
        alert(variableName);
    }

    })();
    function removeItem(total, item){
        alert(total);

        document.getElementById("cartTotal").innerHTML = total - item;

    }
    </script>
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
//include('db_connect.php');

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

$cartTotal = 0;
$itemCosts[] = 0;
for($i = 0; $i < $userResults->num_rows; $i++){
    $row = $userResults->fetch_assoc();
    $itemCosts[$i] = number_format((float)($row['album_price'] / 100), 2, '.', '');
    $cartTotal += $itemCosts[$i];

}
for($j = 0; $j < $userResults->num_rows; $j++){

    $albumArt = spanBlock("albumArt", imgBlock("art", "../../res/image/cart.png"));
    $albumArtButton = divId("albumObject", $albumArt);

    $albumTitle = divIdClass("albumTitle", "albumText", $row['album_title']);
    $artistName = divIdClass("artistName", "albumText", $row['artist_name']);
    $tags = divIdClass("cash", "albumText", "$" . $itemCosts[$j]);
    $albumBlock = divId("albumObject", $albumArt . $albumTitle . $artistName . $tags);
    $currentItem = "javascript:removeItem('$cartTotal' , '$itemCosts[$j]')";
    $removeButton = '<button type="button" name="" value="" class="removeCartButton" onclick="' . $currentItem .'">Remove</button>';
    $removeBlock = divIdClass("removeCartSpace", "albumItem", $removeButton);

    $albumObject = $albumBlock . $removeBlock;
    $galleryListItem .= listItem($albumObject);

}
$galleryList = unOrderList($galleryListItem);
$galleryContent = divIdClass("galleryContent", "galleryContent", $galleryList);
$galleryWrapper = divId("galleryWrapper", $galleryContent);

echo $galleryWrapper;
echo divId("cartTotal", "Total cash: $" . $cartTotal);


?>


</body>
</html>