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

    // Kollar först om det har skickats in nånting
    function CreateNewUser( $username_IN, $email_IN, $password_IN ){
        if ( !empty( $username_IN ) && !empty( $email_IN && !empty( $password_IN ) ) ) {
        
            $sql = "SELECT ID FROM users WHERE Username=:username_IN OR Email=:email_IN";
            $stm = $this->database_connection->prepare($sql);
            $stm ->bindParam(":username_IN", $username_IN);
            $stm ->bindParam(":email_IN", $email_IN);

            if( !$stm -> execute() ){
                echo "Kunde inte köra sql-frågan!";
                die();
            }
        //Checkar om det finns en användare registrerade, genom att räkna raderna/användarna i tabellen i databasen
        $numberOfRows = $stm->rowCount();
            if( $numberOfRows > 0 ){
                echo "Användare är redan registrerad!";
                die();
            }

                $sql = "INSERT INTO users (Username, Email, Password, Role) VALUES(:username_IN, :email_IN, :password_IN, 'user')";
                $stm = $this->database_connection->prepare($sql);
                $stm ->bindParam(":username_IN", $username_IN);
                $stm ->bindParam(":email_IN", $email_IN);
                $stm ->bindParam(":password_IN", $password_IN);

                // Om man inte lyckas lägga in användare rätt så visas echot
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

    function GetAllUsers(){
            $sql = "SELECT Username, Email, Password FROM users";
            $stm = $this -> database_connection->prepare($sql);
            $stm -> execute();
            return $stm -> fetchAll();
        }

        //Hämtar en användare genom dess ID i users-tabellen i db
    function GetOneUser($userID) {
            $sql = "SELECT ID, Username, Email, Password FROM users WHERE ID=:userID_IN";
            $stm = $this->database_connection->prepare($sql);
            $stm->bindParam(":userID_IN", $userID);
            
            //Om den inte executar eller hittar någon användare när den räknar raderna
            if( !$stm->execute() || $stm->rowCount() < 1 ) {
                echo "Användare existerar inte!";
                return $stm -> fetch();
                die();
            }
    
            $row = $stm->fetch();
    
            $this->username = $row['Username'];
            $this->email = $row['Email'];
            $this->password = $row['Password'];
            $this->userID = $row['ID'];
            
            return $row;
    
        }

        
    function DeleteUser($userID) {
            $sql = "DELETE FROM users WHERE ID=:userID_IN";
            $stm = $this->database_connection->prepare($sql);
            $stm->bindParam(":userID_IN", $userID);
            $stm->execute();
    
            $message = new stdClass(); // new stdClass?
            if($stm->rowCount() > 0) {
                $message->text = "Användare med ID $userID blev borttagen!";
                return $message;
            } else { 
                $message->text = "Ingen användare med ID=$userID hittades!";
                return $message;
            }
    
        }


    function EditUser($userID, $username = "", $password = "", $email = "", $role = ""){

        if( !empty($username) ){
            $error->message = $this->UpdateUsername($userID, $username);
        }

        if( !empty($email) ){
            $error->message = $this->UpdateEmail($userID, $email);
        }

        if( !empty($password) ){
            $error->message = $this->UpdatePassword($userID, $password);
        }

        if( !empty($role) ){
            $error->message = $this->UpdateRole($userID, $role);
        }

        return $error; //kopplas till New Std rad 104 så det blir samma error meddelande?
    }


    function UpdateUsername( $userID, $username ){
        $sql = "UPDATE users SET Username=:username_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":username_IN", $username_IN);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->execute();

            if( !$stm->rowCount() < 1){
                return "Ingen användare med ID = $userID hittades!";
            }
    }

    function UpdatePassword( $userID, $password ){
        $sql = "UPDATE users SET Password=:password_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":password_IN", $password_IN);
        $stm ->execute();
    
            if( !$stm->rowCount() < 1) {
                return "Ingen användare med ID = $userID hittades!";
            }
        }

    function UpdateEmail($userID, $email){
        $sql = "UPDATE users SET Email=:username_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":email_IN", $email_IN);
        $stm ->execute();

        if( !$stm->rowCount() < 1) {
            return "Ingen användare med ID = $userID hittades!";
        }
    }

    function UpdateRole($userID, $role){
        $sql = "UPDATE users SET Role=:role_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $useriD_IN);
        $stm ->bindParam(":role_IN", $role);
        $stm ->execute();

        if( !$stm->rowCount() < 1){
            return "Ingen användare med ID=$userID hittades!";
        }
    }







}

?>