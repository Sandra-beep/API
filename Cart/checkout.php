<?php
//Här ska alla produkten i ens beställning visas,ange userid:
// localhost/API-1/Cart/checkout.php?userid=1

include("../db.php");
include("cartClass.php");

$userID = "";

if(isset($_GET['userid'])){
    $userID = $_GET['userid'];
}else {
    echo "Ange User-ID!<br>";
}


$cart = new Cart( $pdo );
echo "<h2>Din varukorg:</h2><br>";
echo '<pre>';
print_r($cart->Checkout($_GET['userid']));
echo '</pre>';

