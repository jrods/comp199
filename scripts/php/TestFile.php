<?php

include('shoppingCart.php');
$server = 'localhost';
$username = 'c199grp07';
$password = 'c199grp07';
$schema = 'c199grp07';

$testCart = new Cart($server, $username, $password, $schema);

echo $testCart->addItem("no wind");
echo $testCart->addItem("punchline");
echo $testCart->addItem("some say");
echo $testCart->getTotal();
echo $testCart->removeItem("no wind");
echo "<br>";
echo $testCart->getTotal();
