<?php

include("../db.php");
include("productClass.php");

// Om titeln är tom så visar den error meddelande
if( empty($_GET['title']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    $error->message = "En produkt behöver en titel!";
    print_r($error); //vrf json_encode?
    die();
}
// Om beskrivningen är tom så visar den error meddelande
if( empty($_GET['description']) ){
    $error->message = "En produkt behöver en beskrivning!";
    print_r($error); //vrf json_encode?
    die();
}
// Om priset är tom så visar den error meddelande
if( empty($_GET['price']) ){
    $error->message = "En produkt behöver ett prisförslag!";
    print_r($error); //vrf json_encode?
    die();
}

// Lägger till en ny produkt, genom att lägga till i tabellen?
$product = new Product($pdo);
print_r($product->CreateProduct($_GET['title'], $_GET['description'], $_GET['price'])); 