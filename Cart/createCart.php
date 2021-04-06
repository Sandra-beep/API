<?php

include('db.php');
include('');


if( $stm->execute() ){
    echo "En beställning skapades!"; //räcker med ett echo?
    echo $product = $this->database_connection->lastInsertId();
}else{
    echo "Kunde inte skapa en beställningen - försök igen!";
}

//Skapar en cart, skriv i URL
//
$cart = new Cart($pdo);
print_r($cart->CreateCart($_GET['username'], $_GET['cartid'], $_GET['productid'], $_GET['title'], $_GET['description'], $_GET['price'])); 

//$_GET['username'] - Behövs den?