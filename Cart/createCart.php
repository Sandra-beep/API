<?php

//Skapar en cart, skriv i URL
// localhost/API-1/Cart/createCart.php?userid=1&productid=1

include('../db.php');
include('cartClass.php');

// Vad som ska föras in i databasen
$userID = "";
$productID = "";


if( empty($_GET['userid']) ){ //[]som man skriver i URL
    echo "Ange User-ID!";
    die(); //så den inte går automatiskt på nästa if-sats
}

if( empty($_GET['productid']) ){ 
    echo "Ange Produkt-ID!";
    die();
}


$cart = new Cart($pdo);
print_r($cart->CreateCart($_GET['userid'], $_GET['productid'])); //här är det som bestäms vad som ska in i URL:n
