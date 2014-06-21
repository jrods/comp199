<html>
<head>

    <link href="css/cart-style.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="js/indexController.js"></script>
</head>
<body>
<div id="cartInfo" class="cart whiteText">
    <?php
    session_start();

    include('scripts/php/htmlGenerator.php');
    include('scripts/php/shoppingCart.php');

    include_once('scripts/php/psl-config.php');

    if (empty($_SESSION['allAlbums'])) {
        $_SESSION['allAlbums'] = array();
        $_SESSION['cart'] = 0;
    }

    $userCart = new Cart(HOST, USER, PASSWORD, DATABASE);

    $userCart->repopulateCart($_SESSION['allAlbums']);

    $total = $userCart->getTotal();

    $itemTotal = divIdClass("cartTotal", "cartTotal", sprintf('<h3>Total: <span class="slightlyGreen">$%s</span></h3>', $total));

    if (count($_SESSION['allAlbums']) == 1) {
        echo $itemTotal;
        echo divIdClass("item", "itemTitle", "<h3>Item</h3>");

    } elseif (count($_SESSION['allAlbums']) > 1) {
        echo $itemTotal;
        $count = sizeof($_SESSION['allAlbums']);
        echo divIdClass("item", "itemTitle", "<h3>Items: $count</h3>");

    } else {
        echo '<div id="album"><h4>Your cart is empty, buy some stuff you fu</h4></div>';
        die;
    }

    $allCartItems = '';

    $row = divIdClass('%s', 'column %s', '<span>%s</span>');

    $titleRow = sprintf($row, 'artistColumn','title', 'Artist')
        . sprintf($row, 'albumColumn', 'title', 'Album')
        . sprintf($row, 'priceColumn', 'title', 'Price')
        . sprintf($row, 'removeColumn', 'title', '');

    $allCartItems .= $titleRow;

    foreach ($userCart->getAllItems() as $album) {
        $formattedPrice = number_format((float)($album->getPrice()) / 100, 2, '.', '');

        $removeLink = '<button onclick="removeItem(this)" value="%s" class="remove slightlyRed">Remove</button>';
        $removeLink = sprintf($removeLink, $album->getTitle());

        $allCartItems .= sprintf($row, 'artistColumn', 'item', $album->getArtist())
            . sprintf($row, 'albumColumn', 'item', $album->getTitle())
            . sprintf($row, 'priceColumn', 'item slightlyGreen', '$'.$formattedPrice)
            . sprintf($row, 'removeColumn', 'item', $removeLink);
    }

    echo sprintf('<div id="albumItems" class="">%s</div>', $allCartItems);

    //echo '<form id="formCheckout" action="myCart.php"><input id="checkout" class="button" type="submit" value="Checkout"></form>';
    echo '<div id="formCheckout">';
    echo '<button id="checkout" onclick="checkout(this)" class="button">Checkout</button>';
    echo '<button id="clearCart" onclick="clearTheCart(this)" class="remove slightlyRed">Clear Cart</button>';
    echo '</div>';
    ?>
</div>
</body>
</html>