<?php
@session_start();
include('scripts/php/shoppingCart.php');
    if(isset($_POST['test2'])){
        $server = 'localhost';
        $username = 'c199grp07';
        $password = 'c199grp07';
        $schema = 'c199grp07';

        $testCart = $_SESSION['testCart'];
        if(! isset($_SESSION['allAlbums'])) {
            $_SESSION['allAlbums'] = array();
        }
        if(!is_object($testCart)) {
    	$testCart = $_SESSION['testCart'] = new Cart($server, $username, $password, $schema);
        }

        $currentAlbum = $_POST['test2'];
        array_push($_SESSION['allAlbums'],$currentAlbum);
        $testCart->addItem($currentAlbum);
        $_SESSION['cart']+=$testCart->getTotal();
        $total = number_format((float)($_SESSION['cart']), 2, '.', '');
        if($total < 0){
           $total = 0;
           $_SESSION['cart'] = 0;
        }
        echo "Total: $" . $total;
        echo "<br>";
        echo $currentAlbum . " added.";
        echo "<br>";
        echo "<br>";
        echo "All Albums: <br>";
        for($i = 0; $i < count($_SESSION['allAlbums']); $i++){
            echo $_SESSION['allAlbums'][$i];
            echo "<br>";
        }
    } else {
        $total = number_format((float)($_SESSION['cart']), 2, '.', '');
        echo "Total: $" . $total;
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "All Albums: <br>";
        for($i = 0; $i < count($_SESSION['allAlbums']); $i++){
            echo $_SESSION['allAlbums'][$i];
            echo "<br>"; 
        }
    }

?>