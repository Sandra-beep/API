<?php

include("../db.php");
include("productClass.php");

if ( empty($_GET['id']) ){
    echo "Inget ID är vald";
    die();
}

if ( empty($_GET['title']) ){
    echo "Ingen titel är satt";
    die();
}

if ( empty($_GET['description']) ){
    echo "Ingen beskrivning är satt";
    die();
}

if ( empty($_GET['price']) ){
    echo "Inget pris är satt";
    die();
}

$product = new Product($pdo);
$product->UpdateProduct($_GET['id'], $_GET['title'], $_GET['description'], $_GET['price']);

