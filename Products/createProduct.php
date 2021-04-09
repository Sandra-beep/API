<?php

include("../db.php");
include("productClass.php");

// Lägg till userid och bytt efter title=, description= och price= i URLen för att skapa en produkt: 
// localhost/API-1/Products/createProduct.php?userid=1&title=Prada&description=shoes&price=5000

if( empty($_GET['userid']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    echo "En produkt behöver en user ID!";
    die();
}

// Om titeln är tom så visar den error meddelande
if( empty($_GET['title']) ){ //stor bokstav som i tabell eller när man skriver i URL??
    echo "En produkt behöver en titel!";
    die();
}
// Om beskrivningen är tom så visar den error meddelande
if( empty($_GET['description']) ){
    echo "En produkt behöver en beskrivning!";
    die();
}
// Om priset är tom så visar den error meddelande
if( empty($_GET['price']) ){
    echo "En produkt behöver ett prisförslag!";
    die();
}

// Lägger till en ny produkt i products-tabellen i databasen
$product = new Product($pdo);
$product->CreateProduct($_GET['userid'], $_GET['title'], $_GET['description'], $_GET['price']); 