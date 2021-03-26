<?php


class User {

    private $database_connection;
    private $userID;
    private $username;
    private $email;
    private $token;

    function __construct( $pdo ){
        $this->database_connection = $pdo;
    }

    function CreateNewUser( $username_IN, $email_IN, $password_IN ){

        if ( !empty($username_IN) && !empty($email_IN && !empty($password_IN)) )
        $sql = "SELECT ID FROM users WHERE Username=:username_IN OR Email=:email_IN";
        $this->database_connection->prepare($sql);
        $stm ->bindParam(":username_IN", $username_IN);
        $stm ->bindParam(":email_IN", $email_IN);

            if( !$stm -> execute() ){
                echo "Kunde inte köra sql frågan!";
                die();
            }
        //Checkar om det finns en användare registrerad, genom att räkna raderna i tabellen i databasen
        $numberOfRows = $stm->rowCount();
            if( $numberOfRows > 0 ){
                echo "Användare är redan registrerad!";
                die();
            }

        }else{

        }
}


?>