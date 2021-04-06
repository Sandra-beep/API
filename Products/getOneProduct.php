<?php

include("../db.php");
include("productClass.php");

// Om id till produkten är tom så kör den echo
if (empty($_GET['id'])){
    echo "Ingen ID specificerad!";
    die();
}



$product = new Product( $pdo );
print_r($product->GetOneProducts($_GET['id']));