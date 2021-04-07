<?php

include("../db.php");
include("productClass.php");

// Lägg till userid och bytt efter title=, description= och price= i URLen för att skapa en produkt: 
// localhost/API-1/Products/createProduct.php?userid=1&title=Prada&description=shoes&price=5000

if( empty($_GET['userid']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    $error = "En produkt behöver en user ID!";
    print_r($error); //vrf json_encode? för att ta bort extra array-delen. Funkar print_r? Räcker med echo? JA och JA
    die();
}

// Om titeln är tom så visar den error meddelande
if( empty($_GET['title']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    $error = "En produkt behöver en titel!";
    print_r($error); //vrf json_encode? för att ta bort extra array-delen. Funkar print_r? Räcker med echo? JA och JA
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
$product->CreateProduct($_GET['userid'], $_GET['title'], $_GET['description'], $_GET['price']); 