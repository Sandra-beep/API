<?php
//Snabblänk till URLen:
//localhost/API-1/Products/getAllProducts.php

include("../db.php");
include("productClass.php");

$product = new Product( $pdo );
print_r ($product->GetAllProducts());
