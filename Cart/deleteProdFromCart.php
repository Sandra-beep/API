<?php

include("../db.php");
include("cartClass.php");

if( empty($_GET['id']) ){
    echo "Specificera ett ID!";
    die();
}

$product = new Product( $pdo );
echo $product->DeleteProduct($_GET['id']); //ID eller id???