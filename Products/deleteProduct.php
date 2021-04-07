<?php

//localhost/API-1/Products/deleteProduct.php?userid=1&productid=9

include("../db.php");
include("productClass.php");

if( empty($_GET['productid']) ){
    echo "Specificera ett produkt-ID!";
    die();
}

$product = new Product( $pdo );
echo $product->DeleteProduct($_GET['productid']); //id efter hur du skriver i URLen