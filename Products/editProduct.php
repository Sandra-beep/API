<?php

//Skriv i URL fältet så att jag kan ändra:
//http://localhost/API-1/Products/editProduct.php?productid=1&username=Sandrita
    include("../db.php");
    include("productClass.php");

    // Lämnas tomma så att användare kan ändra
    $productID = "";
    $title = "";
    $description = "";
    $price = "";
    

    // Om users ID är satt så går den vidare och ändrar resten?
    if(isset($_GET['userid'])){
        $userID = $_GET['userid'];
    }else {
        echo "Du har ej angett (rätt) User-ID!";
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
    print_r(json_encode($productData->editProduct($productID, $title, $description, $price)));

?>
