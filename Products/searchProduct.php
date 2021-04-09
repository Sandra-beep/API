<?php

include("../db.php");
include("productClass.php");

// Om du inte skrivit "word" i URL-fältet så körs echo
if( empty($_GET['word']) ){ //vart kommer word ifrån?
    echo "Inget sökord är skriven";
    die();
}

$product = new Product($pdo);
echo "<pre>";
print_r ($product->SearchProduct($_GET['word']));
echo "</pre>";