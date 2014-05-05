<?php

include('shoppingCart.php');
$server = 'localhost';
$username = 'c199grp07';
$password = 'c199grp07';
$schema = 'c199grp07';

$login = @new mysqli($server, $username, $password, $schema);

if($login->connect_error) {
    die("Connect Error: ". $login->connect_error);
}

$testQuery = $login;
$testCart = new Cart();

echo $testCart->addItem("no wind");
echo "<br>";
echo $testCart->addItem("punchline");
echo "<br>";
echo $testCart->getTotal();
$testCart->removeItem("no wind");
//echo $testCart->getTotal();

?>