<html>
<body>
<div class="cart whiteText">
    <div class="info">
        <?php
        @session_start();

        include("scripts/php/htmlGenerator.php");

        if (!isset($_SESSION['allAlbums'])) {
            $_SESSION['allAlbums'] = array();
        }

        $total = number_format((float)($_SESSION['cart']), 2, '.', '');
        echo divIdClass("cartTotal", "cartTotal", sprintf("<h3>Total: $%s</h3>", $total));

        echo divIdClass("item", "itemTitle", "<h3>Items</h3>");

        $allItems = "";

        echo "<form id='form1' action='removeFromCart.php' method='post'>";

        for ($i = 0; $i < count($_SESSION['allAlbums']); $i++) {
            $newAlbum = $_SESSION['allAlbums'][$i];
            echo "<span>$newAlbum</span>";
            echo "<a href='javascript:;' onclick='parentNode.submit();' class=\"remove slightlyRed\">Remove</a><br>";
            echo sprintf("<input type='hidden' name='test3' value='%s' />", $newAlbum);
        }

        echo "<form action='myCart.php'><input class='button whiteText' type='submit' value='Checkout'></form>";

        ?>
    </div>
</div>

</body>
</html>