<?php
//Ändra numret efter cartid för att ange 
// http://localhost/API-1/Cart/checkout.php?cartid=1

include("../db.php");
include("cartClass.php");

if( empty($_GET['userid']) ){
    echo "Specificera ett ID!";
    die();
}

$cart = new Product( $pdo );
echo $cart->RemoveFromCart($_GET['userid']); //det man skriver in i URL-fältet