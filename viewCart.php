<html>
<body>
<div id="cartInfo" class="cart whiteText">
    <div id="info" class="info">
        <?php
        @session_start();

        include("scripts/php/htmlGenerator.php");

        if (empty($_SESSION['allAlbums'])) {
            $_SESSION['allAlbums'] = array();
            $_SESSION['cart'] = 0;
        }

        $total = number_format((float)($_SESSION['cart']), 2, '.', '');
        echo divIdClass("cartTotal", "cartTotal", sprintf("<h3>Total: $%s</h3>", $total));

        echo divIdClass("item", "itemTitle", "<h3>Items</h3>");

        if(count($_SESSION['allAlbums']) == 1) {
            echo "<div id=\"album\"><h4>Album:</h4></div>";

        } elseif (count($_SESSION['allAlbums']) > 1) {
            echo "<div id=\"album\"><h4>Albums:</h4></div>";
        }

        echo "<form id='form1' action='removeFromCart.php' method='post'>";

        for ($i = 0; $i < count($_SESSION['allAlbums']); $i++) {
            $newAlbum = $_SESSION['allAlbums'][$i];
            echo "<span>$newAlbum</span>";
            echo "<a href='javascript:;' onclick='parentNode.submit();' class=\"remove slightlyRed\">Remove</a><br>";
            echo sprintf("<input type='hidden' name='test3' value='%s' />", $newAlbum);
        }

        echo "</form>";
        echo "<form id=\"form2\" action='myCart.php'><input id='checkout' class='button whiteText' type='submit' value='Checkout'></form>";

        ?>
    </div>
</div>

</body>
</html>