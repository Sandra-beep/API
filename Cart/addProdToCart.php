<?php

include("../db.php");
include('cartClass.php');

$cart = new Cart($pdo);
print_r($cart->createCart($_GET['title'], $_GET['description'], $_GET['price'])); 