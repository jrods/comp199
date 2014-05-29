<?php
@session_start();
include('scripts/php/shoppingCart.php');

if(isset($_POST['name'])){
    $server = 'localhost';
    $username = 'c199grp07';
    $password = 'c199grp07';
    $schema = 'c199grp07';

    if(! isset($_SESSION['cart'])) {
        $_SESSION['cart'] = 0;
    }

    if(! isset ($usersCart)){
        $usersCart = null;
    }

    if(!is_object($usersCart)) {
        $usersCart = $_SESSION['testCart'] = new Cart($server, $username, $password, $schema);
    }

    if(! isset($_SESSION['allAlbums'])) {
        $_SESSION['allAlbums'] = $usersCart->getAllItems();
    }

    $currentAlbum = $_POST['name'];

    if(in_array($currentAlbum, $_SESSION['allAlbums'])) {
        $total = number_format((float)($_SESSION['cart']), 2, '.', '');

        if($total < 0){
            $total = 0;
            $_SESSION['cart'] = 0;
        }

        echo $currentAlbum . " already in cart";
        echo "<br><br>";
        require_once('viewCart.php');
        die;
    }

    array_push($_SESSION['allAlbums'],$currentAlbum);
    $usersCart->addItem($currentAlbum);

    $_SESSION['cart']+=$usersCart->getTotal();
    $total = number_format((float)($_SESSION['cart']), 2, '.', '');

    if($total < 0) {
        $total = 0;
        $_SESSION['cart'] = 0;
    }

    echo $currentAlbum . " added to cart.";
    echo "<br><br>";
    require_once('viewCart.php');

}