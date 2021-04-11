<?php

class Product {

    private $database_connection;
    private $productID;
    private $title;
    private $description;
    private $price;
    

    function __construct ($pdo){
        $this->database_connection = $pdo;
    }

    function CreateProduct ($userID, $title, $description, $price){
        

        $sql = "INSERT INTO products (userID, Title, Description, Price) VALUES(:userid_IN, :title_IN, :description_IN, :price_IN)";
        $stm = $this->database_connection->prepare( $sql );
        $stm-> bindParam( ":title_IN", $title );
        $stm-> bindParam( ":description_IN", $description );
        $stm-> bindParam( ":price_IN", $price );
        $stm-> bindParam( ":userid_IN", $userID );

         //Checkar om det finns en användare registrera, genom att räkna raderna/användarna i tabellen i databasen
        $rows = $stm->rowCount();
        if( $rows > 0 ){
        echo "Produkt är redan registrerad - försök med ny info!";
        die();
     }


        if( $stm->execute() ){
            echo "<h2>Produkten skapades! <br> </h2> Produkt-ID: " . $this->database_connection->lastInsertId() . "<br>";
            echo $title  . "<br>" . $description . "<br>" . $price . " kr <br>";
        }else{
            echo "Kunde inte skapa produkten - testa igen!";
        }
    
    }

    function GetAllProducts(){
        $sql = "SELECT * FROM products";
        $stm = $this->database_connection->prepare($sql);
        $stm->execute();
        echo '<h2>Produktlista: </h2><pre>';
        print_r ($stm->fetchAll()); //hoppar över json_encode
        echo '</pre>';
    }
    
    function GetOneProduct($productID){
        $sql = "SELECT * FROM products WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":id_IN", $productID);

        if($stm->execute()){
            return $stm->fetch();
        }else{
            echo "Kunde inte hämta en produkt - försök igen!";
        }
    }

    function DeleteProduct($productID){
        $sql = "DELETE FROM products WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":id_IN", $productID);

        if($stm->execute()){
            echo "Produkten med Produkt-ID $productID är borttagen!";
        } else {
            echo "Hittade inget - redan borttaget?";
        }
    }

    //="*" *det som ska läggas till nytt i URLen
    function EditProduct($userID, $productID, $title="", $description="", $price=""){

        // Om de är inte tomma så visar befintlig information
        if( !empty( $title ) ){
            echo $this->UpdateTitle($productID, $title);
        }

        if( !empty( $description ) ){
            echo $this->UpdateDescription( $productID, $description );
        }

        if( !empty( $price ) ){
            echo $this->UpdatePrice( $productID, $price );
        }
    }

    // Uppdaterar produktens titel
        function UpdateTitle( $productID, $title ){
        $sql = "UPDATE products SET Title=:title_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm->bindParam( ":id_IN", $productID);
        $stm->bindParam( ":title_IN", $title );
        
        if($stm ->execute()){
            echo "Produkt-ID: $productID <br> 
            Ny titel: " . $title . "<br>";
            die();
         }
        
         if( !$stm->rowCount() < 1){
            echo "Ingen produkt med ID = $productID hittades!";
         }

        }
    
    // Uppdaterar produktens beskrivning
        function UpdateDescription( $productID, $description ){
        $sql = "UPDATE products SET Description=:description_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( ":id_IN", $productID) ;
        $stm->bindParam( ":description_IN", $description );
        if($stm->execute()){
            echo "Produkt-ID: $productID <br> 
            Ny produktbeskrivning: " . $description . "<br>";
            die();
         }
            if( !$stm->rowCount() < 1){
                echo "Beskrivning till product-ID = $productID kunde inte ändras!";
            } 
    }

    // Uppdaterar produktens pris
        function UpdatePrice( $productID, $price ){
        $sql = "UPDATE products SET Price=:price_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( ":id_IN", $productID) ;
        $stm->bindParam( ":price_IN", $price );
        if($stm ->execute()){
            echo "Produkt-ID: $productID <br> Nytt pris: " . $price . "<br>";
            die();
         }
            if( !$stm->rowCount() < 1){
                echo "Priset med product-ID = $productID kunde inte ändras!";
            }

        } 
    

    // Leta efter en produkt
        function SearchProduct ( $word ){ //är word definerad, eller blir det när man skriver i URL?
        $sql = "SELECT * FROM products WHERE Title LIKE :word_IN OR Description LIKE :word_IN";
        $stm = $this->database_connection->prepare( $sql );
        $word = '%' . $word . '%';
        $stm->bindParam( "word_IN", $word );
        $stm->execute();
        return $stm->fetchAll();
    }


}//Endtag för class Product