<?php

include("../db.php");
include("productClass.php");

// Om id till produkten är tom så kör den echo
if (empty($_GET['productid'])){
    echo "Ingen ID specificerad!";
    die();
}


$product = new Product( $pdo );
echo "<pre>";
print_r(array_unique($product->GetOneProduct($_GET['productid'])));
echo "</pre>";
