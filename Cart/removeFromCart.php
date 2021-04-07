<?php
//Ändra numret efter userid och cartid för att ta bort rätt vara från varukorgen
// localhost/API-1/Cart/removeFromCart.php?userid=1&cartid=1&productid=4

include("../db.php");
include("cartClass.php");

if( empty($_GET['userid']) ){
    echo "Specificera ett User-ID!";
    die();
}

if( empty($_GET['cartid']) ){
    echo "Specificera ett varukorgs-ID!";
    die();
}

if( empty($_GET['productid']) ){
    echo "Specificera en Produkt-ID!";
    die();
}

$cart = new Cart( $pdo );
echo $cart->RemoveFromCart($_GET['userid'], $_GET['cartid'], $_GET['productid']); //det man skriver in i URL-fältet


// Inte produktid, då försvinner alla med samma produktid i beställningen
if( empty($_GET['productid']) ){
    echo "Specificera ett produkt-ID!";
    die();
}

$product = new Product( $pdo );
echo $product->DeleteProduct($_GET['productid']); //id efter hur du skriver i URLen