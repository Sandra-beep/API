<?php

include("../db.php");
include("productClass.php");

$productID = "";
$title = "";
$description = "";
$price = "";

$product = new Product($pdo);
$product->UpdateProduct($_GET['productid'], $_GET['title'], $_GET['description'], $_GET['price']);

