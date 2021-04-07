<?php

// Här ligger alla mina funktioner en class

class Cart {

    private $database_connection;
    private $cartID;

    function __construct ($pdo){
        $this->database_connection = $pdo;
    }

    function CreateCart ($userID, $productID){//Behövs userid?
        $sql = ('INSERT INTO cart (userID, productID) VALUES(:userid_IN,:productid_IN)');
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(':userid_IN', $userID); //länkar userID
        $stm->bindParam(':productid_IN', $productID); //länkar productID   
        
        if($stm->execute()){
            echo "Du lyckades lägga in en vara!";
        } else {
            echo "Gick inte skapa en ny produkt - försök igen!";
        }
    }

    function RemoveFromCart($userID, $productID){
        $stm = $pdo->prepare('DELETE FROM cart (userID, productID) VALUES(:userId_IN,:productId_IN');
        $stm->bindParam(':userId_IN', $_GET['userid']); //länkar userID
        $stm->bindParam(':productId_IN', $_GET['productid']); //länkar productID   
        
        if($stm->execute()){
            echo "Produkten borttagen ur varukorg!";
        } else {
            echo "Gick inte ta bort produkt - försök igen!";
            }
        }


    function Checkout (){
        $sql = "SELECT * FROM cart WHERE userID=:userid_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm->bindParam(':userid_IN', $_GET['userid']); //länkar userID och vilka produkter som ligger på den
        $stm->execute();
        echo '<pre>';
        print_r ($stm->fetchAll()); // json_encode
        echo '</pre>';
        }



    }



    
