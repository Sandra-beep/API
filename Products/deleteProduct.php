<?php
//Ändra/välj siffran efter userid= för att ta bort den användare som den tillhör
//localhost/API-1/Products/deleteProduct.php?userid=3&productid=12

    include("../db.php");
    include("productClass.php");

    
    if( empty($_GET['userid']) ){ 
        echo "Ange User-ID!";
        die();
    }

    if( empty($_GET['productid']) ){ 
        echo "Ange Product-ID!";
        die();
    }

    $product = new Product($pdo);

        if(!empty($_GET['productid']) ){
            $product->DeleteProduct($_GET['productid']);
        }

?>