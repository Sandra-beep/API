<?php

class Product {

    private $database_connection;

    function __construct ($pdo){
        $this->database_connection = $pdo;
    }

    function CreateProduct ($title, $description, $price){

        $sql = "INSERT INTO product (Title, Description, Price) VALUES(:title_IN, :description_IN, :price_IN)";
        $stm = $this->database_connection->prepare( $sql );
        $stm-> bindParam( "title_IN", $title );
        $stm-> bindParam( "description_IN", $description );
        $stm-> bindParam( "price_IN", $price );

        $message = new stdClass();//vad gör den här?

        if( $stm->execute() ){
            $msg->message = "Produkten skapades!";
            $message->productID = $this->database_connection->lastInsertId();
        }else{
            $message->message = "Kunde inte skapa produkten, testa igen!";
            // $message->code = "";
        }
        
        return $message;

    }

    function GetAllProducts(){
        $sql = "SELECT * FROM products";
        $stm = $this->database_connection->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }

    function GetOneProduct(){
        $sql = "SELECT * FROM products WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":id_IN", $productId);

        if($stm->execute()){
            return $stm->fetch();
        }else{
            echo "Kunde inte hämta en produkt, försök igen!";
        }
    }

    function DeleteProduct($productId){
        $sql = "DELETE FROM products WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":id_IN", $productId);

        if($stm->execute){
            $message->message = "Du har tagit bort produkten!";
            return $message; //ska man ha något istället för json_encode
        }
    }

    function UpdateProduct($productId, $title="", $description="", $price=""){

        if( !empty( $title ) ){
            $this->updateTitle($productId, $title);
        }

        if( !empty( $description ) ){
            $this->updateDescription( $productId, $description );
        }

        if( !empty( $price ) ){
            $this->updateDescription( $productId, $price );
        }
    }

    private function updateTitle( $productId, $title ){
        $sql = "UPDATE products SET Title=:title_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ; //OK att den kommer före?
        $stm->bindParam( "$title_IN", $title );
        $stm->execute();
    }

    private function updateDescription( $productId, $description ){
        $sql = "UPDATE products SET Description=:description_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ;
        $stm->bindParam( "$description_IN", $description );
        $stm->execute(); 
    }

    private function updatePrice( $productId, $price ){
        $sql = "UPDATE products SET Price=:price_IN WHERE ID=:id_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam( "$id_IN", $productID) ;
        $stm->bindParam( "$price_IN", $price );
        $stm->execute(); 
    }

    function SearchProduct ( $word ){
        $sql = "SELECT * FROM products WHERE Title LIKE :word_IN OR Description LIKE :word_IN";
        $stm = $this->database_connection->prepare( $sql );
        $word = '%' . $word . '%';
        $stm->bindParam( "word_IN", $word );
        $stm->execute;
        return $stm->fetchAll();
    }
}