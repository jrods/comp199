
<?php
/*
echo "<br>";

echo "<br>";
echo "<br>";

echo "Cart: <br>";

    $newAlbum = $_SESSION['allAlbums'][$i];
    echo $newAlbum;
    echo "<br>";
    echo "<form id='form1' action='removeFromCart.php' method='post'>";
    echo "<a href='javascript:;' onclick='parentNode.submit();'><b>Remove</b></a>";
    echo "<input type='hidden' name='test3' value='" . $newAlbum . "' />";
    echo "</form>";
    echo "<br>";
    echo "<br>";*/
?>
<html>

<body>
<?php
@session_start();

include("scripts/php/htmlGenerator.php");

if (!isset($_SESSION['allAlbums'])) {
    $_SESSION['allAlbums'] = array();
}

$total = number_format((float)($_SESSION['cart']), 2, '.', '');
echo divIdClass( "cartTotal", "cartTotal", sprintf("<h2>Total: $%s</h2>", $total));

for ($i = 0; $i < count($_SESSION['allAlbums']); $i++) {
    $newAlbum = $_SESSION['allAlbums'][$i];
    echo $newAlbum;
    echo "<br>";
}

//echo "<form action='myCart.php'><input type='submit' value='Checkout'></form>";

?>
</body>
</html>