<?php

include("../db.php");
include("productClass.php");

if( empty($_GET['word']) ){ //vart kommer word ifrån?
    echo "Inget sökord är skriven";
    die();
}

$product = new Product($pdo);
echo $product->SearchProduct($_GET['word']);