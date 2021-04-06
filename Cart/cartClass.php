<?php

// Här ligger alla mina funktioner en class

class Cart {

    private $database_connection;

    function __construct ($pdo){
        $this->database_connection = $pdo;
    }

    function CreateCart ($userID, $cartID){//Behövs userid?
        $stm = $pdo->prepare('INSERT INTO carts (userID, productID) VALUES(:userId_IN,:productId_IN');
        $stm->bindParam(':userId_IN', $_GET['userid']); //länkar userID
        $stm->bindParam(':productId_IN', $_GET['productid']); //länkar productID   
        
        if($stm->execute()){
            echo "Du lyckades skapa en produkt";
        } else {
            echo "Gick inte skapa en ny produkt - försök igen!";
        }
    }

    function removeFromCart($userID, $productID){
        $stm = $pdo->prepare('DELETE FROM carts (userID, productID) VALUES(:userId_IN,:productId_IN');
        $stm->bindParam(':userId_IN', $_GET['userid']); //länkar userID
        $stm->bindParam(':productId_IN', $_GET['productid']); //länkar productID   
        
        if($stm->execute()){
            echo "Produkten borttagen ur varukorg!";
        } else {
            echo "Gick inte ta bort produkt - försök igen!";
            }
        }



    function Checkout (){

        }

    }



    
