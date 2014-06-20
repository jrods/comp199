<?php
session_start();

include('scripts/php/shoppingCart.php');
include_once('scripts/php/psl-config.php');

if (!isset($_POST['name']) or $_POST['name'] == null) {
    die('Album name wasnt posted');
}

if (!isset($_SESSION['allAlbums'])) {
    $_SESSION['allAlbums'] = array();
}

$albumToAdd = $_POST['name'];

if(in_array($albumToAdd, $_SESSION['allAlbums'])) {
    return;
}

$userCart = new Cart(HOST, USER, PASSWORD, DATABASE);

$userCart->addItem($albumToAdd);

array_push($_SESSION['allAlbums'], $albumToAdd);