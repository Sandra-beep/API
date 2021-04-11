<?php

// Här ligger alla mina funktioner till class Cart

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
        
        //Om man lyckades:
        if($stm->execute()){
            echo "Du lyckades lägga in en vara! <br>
            Kika i varukorgen/checkout!";
        } else { //om man inte lyckades:
            echo "Gick inte skapa en ny produkt - försök igen!";
        }
    }

    function DeleteFromCart($productID){//()vilket som blir påverkad
        $sql = "DELETE FROM cart WHERE productID=:productid_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":productid_IN", $productID);

        if($stm->execute()){
            echo "Produkten med Produkt-ID $productID är borttagen!";
        } else {
            echo "Hittade inget - redan borttaget?";
        }
    }

    function Checkout ($userid){//det man måste skriva i URL

        $sql = "SELECT productID, Title, Price, 
        COUNT(productID) as Quantity 
        FROM cart c 
        JOIN products p ON c.productID = p.ID 
        WHERE c.userID=:userid_IN 
        GROUP BY c.productID";
        

        $stm = $this->database_connection->prepare($sql);
        $stm->bindParam(':userid_IN', $_GET['userid']);

        // Om koden kan köras så visas allt i varukorgen
        if($stm->execute()){
        echo '<pre>';
        print_r ($stm->fetchAll());
        echo '</pre>';

        }else{ //Annars så visas echot
           echo "Din varukorg är tom!";
        }
        }



    }





    
