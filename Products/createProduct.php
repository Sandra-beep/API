<?php

include("../db.php");
include("productClass.php");

// Bytt efter title=, description= och price= i URLen för att skapa en produkt: 
// localhost/API-1/Products/createProduct.php?title=Prada&description=shoes&price=5000kr


// Om titeln är tom så visar den error meddelande
if( empty($_GET['title']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    $error = "En produkt behöver en titel!";
    print_r($error); //vrf json_encode? Funkar print_r? Räcker med echo?
    die();
}
// Om beskrivningen är tom så visar den error meddelande
if( empty($_GET['description']) ){
    $error = "En produkt behöver en beskrivning!";
    print_r($error);
    die();
}
// Om priset är tom så visar den error meddelande
if( empty($_GET['price']) ){
    $error = "En produkt behöver ett prisförslag!";
    print_r($error);
    die();
}

// Lägger till en ny produkt, genom att lägga till i tabellen?
$product = new Product($pdo);
$product->CreateProduct($_GET['title'], $_GET['description'], $_GET['price']); 