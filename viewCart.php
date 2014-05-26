<?php
    @session_start();
    //include('scripts/php/shoppingCart.php');

    if(! isset($_SESSION['allAlbums'])) {
            $_SESSION['allAlbums'] = array();
        }

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
?>