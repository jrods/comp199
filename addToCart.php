<?php
@session_start();
include('scripts/php/shoppingCart.php');



    $server = 'localhost';
    $username = 'c199grp07';
    $password = 'c199grp07';
    $schema = 'c199grp07';

    if(! isset($testCart)){
        $testCart = new Cart($server, $username, $password, $schema);
    }

    $testCart = $_SESSION['testCart'];
    if(!is_object($testCart)) {
	$testCart = $_SESSION['testCart'] = new Cart($server, $username, $password, $schema);
    }
    $currentAlbum = $_POST['test2'];
    //echo "$" . $testCart->getTotal() . " added to Cart.";
    $testCart->addItem($currentAlbum);
   // echo "$" . $testCart->getTotal() . " added to Cart.";
    $_SESSION['cart']+=$testCart->getTotal();
    $total = number_format((float)($_SESSION['cart']), 2, '.', '');
    if($total < 0){
       $total = 0;
    }
    echo "Total: $" . $total;
?>