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


        // $message = new stdClass();//behöver inte meddelande class

        if( $stm->execute() ){
            echo "Produkten skapades!" . $this->database_connection->lastInsertId(); //räcker med ett echo?
        }else{
            echo "Kunde inte skapa produkten - testa igen!";
        }
    
    }

    function GetAllProducts(){
        $sql = "SELECT * FROM products";
        $stm = $this->database_connection->prepare($sql);
        $stm->execute();
        echo '<pre>';
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
            echo "Produkten är borttagen!";
        }
    }

    //argumenten inne paranteser lämnas tomma för att kunna bytas av användare
    function UpdateProduct($productID, $title="", $description="", $price=""){

        // Om de är inte tomma så visar befintlig information
        if( !empty( $title ) ){
            $this->updateTitle($productID, $title);
            echo "Ny titel: " . $title;
        }

        if( !empty( $description ) ){
            $this->updateDescription( $productID, $description );
            echo "Ny beskrivning: " . $description;

        }

        if( !empty( $price ) ){
            $this->updateDescription( $productID, $price );
            echo "Nytt pris: " . $price;

        }
    }

    // Uppdaterar produktens titel
    private function updateTitle( $productID, $title ){
        $sql = "UPDATE products SET Title=:title_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ; //OK att den kommer före?
        $stm->bindParam( "$title_IN", $title );
        $stm->execute();
    }
    // Uppdaterar produktens beskrivning
    private function updateDescription( $productID, $description ){
        $sql = "UPDATE products SET Description=:description_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ;
        $stm->bindParam( "$description_IN", $description );
        $stm->execute(); 
    }
    // Uppdaterar produktens pris
    private function updatePrice( $productID, $price ){
        $sql = "UPDATE products SET Price=:price_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ;
        $stm->bindParam( "$price_IN", $price );
        $stm->execute(); 
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
}