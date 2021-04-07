<?php

//Byt produktid-nr och title i URL fältet så det kan ändra:
//localhost/API-1/Products/editProduct.php?productid=1&title=Armani    include("../db.php");
    include("productClass.php");

    // Lämnas tomma så att användare kan ändra
    $productID = "";
    $title = "";
    $description = "";
    $price = "";
    

    // Om users ID är satt så går den vidare och ändrar resten?
    if(isset($_GET['productid'])){
        $productID = $_GET['productid'];
    }else {
        echo "Ange Produkt-ID!";
        die();
    }

    if(isset($_GET['title'])){
        $username = $_GET['title'];
    }

    if(isset($_GET['description'])){
        $email = $_GET['description'];
    }
    
    if(isset($_GET['price'])){
        $password = $_GET['price'];
    }
    
    $productData = new Product($pdo);
    print_r($productData->editProduct($productID, $title, $description, $price));

?>
