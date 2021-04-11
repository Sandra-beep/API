<?php

//Byt produktid-nr och title i URL fältet så det kan ändra:
// localhost/API-1/Products/editProduct.php?productid=1&title=Armani
    include("../db.php");
    include("productClass.php");

    // Lämnas tomma så att användare kan ändra
    $userID = ""; 
    $productID = "";
    $title = "";
    $description = "";
    $price = "";

    if(isset($_GET['userid'])){
        $userID = $_GET['userid'];
    }else {
        echo "Ange User-ID!<br>";
    }

    if(isset($_GET['productid'])){
        $productID = $_GET['productid'];
    }else {
        echo "Ange Produkt-ID!";
    }

    if(isset($_GET['title'])){
        $title = $_GET['title'];
    }

    if(isset($_GET['description'])){
        $description = $_GET['description'];
    }
    
    if(isset($_GET['price'])){
        $price = $_GET['price'];
    }
    
    $productData = new Product($pdo);
    $productData->EditProduct($userID, $productID, $title, $description, $price);

?>
