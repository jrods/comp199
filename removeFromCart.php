<?php
@session_start();
include('scripts/php/shoppingCart.php');
  
    $server = 'localhost';
    $username = 'c199grp07';
    $password = 'c199grp07';
    $schema = 'c199grp07';

    $testCart = $_SESSION['testCart'];
    if(!is_object($testCart)) {
	$testCart = $_SESSION['testCart'] = new Cart($server, $username, $password, $schema);
    }
    $currentAlbum = $_POST['test3'];
    if(! in_array($currentAlbum, $_SESSION['allAlbums'])){
        echo $currentAlbum . " not in cart";
        die;
    }
    $key = array_search($currentAlbum,$_SESSION['allAlbums']) ;
    unset($_SESSION['allAlbums'][$key]);
    $_SESSION['allAlbums'] = array_values($_SESSION['allAlbums']);
    $testCart->addItem($currentAlbum);

    $_SESSION['cart']-=$testCart->getTotal();
    $total = number_format((float)($_SESSION['cart']), 2, '.', '');
    if($total < 0){
      $total = 0;
      $_SESSION['cart'] = 0;
    }

    echo "Total: $" . $total;
    echo "<br>";
    echo $currentAlbum . " removed.";
        echo "<br>";
    echo "<br>";
    echo "All Albums: <br>";
    for($i = 0; $i < count($_SESSION['allAlbums']); $i++){
        echo $_SESSION['allAlbums'][$i];
        echo "<br>";
    }
    header('Location: index.php');
?>