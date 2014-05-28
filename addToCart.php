<?php
@session_start();
include('scripts/php/shoppingCart.php');
    if(isset($_POST['name'])){
        $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';
        //$_SESSION['allAlbums'] = array();
        
        if(! isset($_SESSION['cart'])) {
            $_SESSION['cart'] = 0;
        }

        if(! isset ($testCart)){
            $testCart = null;
        }
        if(! isset($_SESSION['allAlbums'])) {
            $_SESSION['allAlbums'] = array();
        }

        if(!is_object($testCart)) {
    	    $testCart = $_SESSION['testCart'] = new Cart($server, $username, $password, $schema);
        }

        $currentAlbum = $_POST['name'];
        if(in_array($currentAlbum, $_SESSION['allAlbums'])){
            $total = number_format((float)($_SESSION['cart']), 2, '.', '');
            if($total < 0){
                $total = 0;
                $_SESSION['cart'] = 0;
            }
            echo $currentAlbum . " already in cart";
            echo "<br>";

            die;
        }
        array_push($_SESSION['allAlbums'],$currentAlbum);
        $testCart->addItem($currentAlbum);
        $_SESSION['cart']+=$testCart->getTotal();
        $total = number_format((float)($_SESSION['cart']), 2, '.', '');
        if($total < 0){
           $total = 0;
           $_SESSION['cart'] = 0;
        }

        echo $currentAlbum . " added.";
        echo "<br><br>";
        echo "Current Total: $" . $total;

    }