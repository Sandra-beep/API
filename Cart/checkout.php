<?php
//Här ska alla produkten i ens beställning visas!
// localhost/API-1/Cart/checkout.php?userid=1

include("../db.php");
include("cartClass.php");

$cart = new Cart( $pdo );
echo "<h2>Din varukorg:</h2><br>";
echo '<pre>';
print_r($cart->checkout($_GET['userid']));
echo '</pre>';


