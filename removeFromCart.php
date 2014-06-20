<?php
session_start();

include('scripts/php/shoppingCart.php');
include_once('scripts/php/psl-config.php');

if (!isset($_SESSION['allAlbums'])) {
    die('something is very wrong, trying to remove an album from an empty session array');
}

if(isset($_POST['name'])) {
    $albumToRemove = $_POST['name'];
}

if(isset($_POST['removeAll'])) {
   $_SESSION['allAlbums'] = array();
}

if(! in_array($albumToRemove, $_SESSION['allAlbums'])) {
    console.log($albumToRemove . ' no album in cart');
    return;
}

$userCart = new Cart(HOST, USER, PASSWORD, DATABASE);

$userCart->repopulateCart($_SESSION['allAlbums']);

if(!isset($_POST['removeAll'])) {
    $userCart->removeItem($albumToRemove);
}

$_SESSION['cart'] = $userCart->getTotal();

$_SESSION['allAlbums'] = array();

foreach($userCart->getAllItems() as $album) {
    $albumTitle = $album->getTitle();

    if($albumTitle == $albumToRemove){
        continue;
    }

    array_push($_SESSION['allAlbums'], $albumTitle);
}