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
            $newAlbum = $_SESSION['allAlbums'][$i];
            echo $newAlbum;
            echo "<br>";
            echo "<form id='form1' action='removeFromCart.php' method='post'>";
            echo "<a href='javascript:;' onclick='parentNode.submit();'>Remove</a>";
            echo "<input type='hidden' name='test3' value='".$newAlbum."' />";
            echo "</form";
              //'<a href= "removeFromCart.php" value="" class="removeCartButton" name="$_SESSION['allAlbums'][$i]">x</button>'
            echo "<br>";
            echo "<br>";

        }
?>