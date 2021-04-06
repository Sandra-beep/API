<?php

include("../db.php");
include("productClass.php");

if( empty($_GET['id']) ){
    $error = "Specificera ett ID!";
    print_r($error);
    die();
}

$product = new Product( $pdo );
echo $product->DeleteProduct($_GET['id']); //ID eller id???