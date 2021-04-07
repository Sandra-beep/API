<?php

//Skapar en cart, skriv i URL
// http://localhost/API-1/Cart/createCart.php?userid=1&productid=1

include('../db.php');
include('cartClass.php');

$cart = new Cart($pdo);
print_r($cart->CreateCart($_GET['userid'], $_GET['productid'])); //här är det som bestäms vad som ska in i URL:n

//$_GET['username'] - Behövs den?