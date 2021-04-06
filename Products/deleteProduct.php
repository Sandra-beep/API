<?php

include("../db.php");
include("productClass.php");

if( empty($_GET['productid']) ){
    echo "Specificera ett produkt-ID!";
    die();
}

$product = new Product( $pdo );
echo $product->DeleteProduct($_GET['productid']); //id efter hur du skriver i URLen