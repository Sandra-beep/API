<?php

// A class's:
//Variable = properties/egenskaper
//Function = method/metod

class User {

    private $database_connection;
    private $userID;
    private $username;
    private $email;
    private $token;

    // En metod som laddar databasen till variablen $this
    //__construct, för att databasen ska acceptera in data varje gång ett nytt objekt skapas 

    function __construct( $pdo ){
        $this->database_connection = $pdo;
    }

    function CreateNewUser( $username_IN, $email_IN, $password_IN ){

        if ( !empty( $username_IN ) && !empty( $email_IN && !empty( $password_IN )) )
        $sql = "SELECT ID FROM users WHERE Username=:username_IN OR Email=:email_IN";
        $this->database_connection->prepare($sql);
        $stm ->bindParam(":username_IN", $username_IN);
        $stm ->bindParam(":email_IN", $email_IN);

            if( !$stm -> execute() ){
                echo "Kunde inte köra sql-frågan!";
                die();
            }
        //Checkar om det finns en användare registrerad, genom att räkna raderna i tabellen i databasen
        $numberOfRows = $stm->rowCount();
            if( $numberOfRows > 0 ){
                echo "Användare är redan registrerad!";
                die();
            }

            $sql = "INSERT INTO users (username, email, password, role) VALUES(:username_IN, :email_IN, :password_IN, 'user')";
            $stm = $this->database_connection->prepare($sql);
            $stm ->bindParam(":username_IN", $username_IN);
            $stm ->bindParam(":email_IN", $email_IN);
            $stm ->bindParam(":password_IN", $password_IN);

            if( !$stm->execute() ){
                echo "Kunde inte registrera användare!";
                die();
            }

            $this->username = $username_IN;
            $this->email = $email_IN;

            echo 
            "Användarnamn: $this->username_IN <br> " . "Email: $this->email_IN";

        } else {
            echo "Alla argument behöver ett värde!";
            die();
        }
}


?>