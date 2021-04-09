<?php
//Ändra/välj siffran efter userid= för att ta bort den användare som den tillhör
// localhost/API-1/Cart/deleteFromCart.php?userid=1&productid=1

    include("../db.php");
    include("cartClass.php");
    
    if( empty($_GET['userid']) ){ 
        echo "Ange User-ID!";
        die();
    }

    if( empty($_GET['productid']) ){ 
        echo "Ange Product-ID!";
        die();
    }

    $cart = new Cart($pdo);
    echo $cart->DeleteFromCart($_GET['productid']); //[]vilken get det kommer påverka

?>