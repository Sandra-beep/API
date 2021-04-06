<?php

// A class's: Variable = properties/egenskaper. Function = method/metod.

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
    function CreateNewUser( $username, $email, $password ){
        if ( !empty( $username ) && !empty( $email && !empty( $password ) ) ) {
        
            $sql = "SELECT ID FROM users WHERE Username=:username_IN OR Email=:email_IN";
            $stm = $this->database_connection->prepare($sql);
            $stm-> bindParam(":username_IN", $username);
            $stm-> bindParam(":email_IN", $email);

            if( !$stm -> execute() ){
                echo "Kunde inte köra sql-frågan!";
                die();
            }
        //Checkar om det finns en användare registrerade, genom att räkna raderna/användarna i tabellen i databasen
        $numberOfRows = $stm->rowCount();
            if( $numberOfRows > 0 ){
                echo "Användare är redan registrerad!";
                die();
            } //Om den inte är registrerad så läggs den till i tabellen users

                $sql = "INSERT INTO users (Username, Email, Password, Role) VALUES(:username_IN, :email_IN, :password_IN, 'user')";
                $stm = $this->database_connection->prepare($sql);
                $stm-> bindParam(":username_IN", $username);
                $stm-> bindParam(":email_IN", $email);
                $stm-> bindParam(":password_IN", $password);

                // Om man inte lyckas lägga in användare rätt så visas echot
                if( !$stm->execute() ){
                    echo "Kunde inte registrera användare!";
                    die();
                }

            $this->username = $username;
            $this->email = $email;

            echo 
            "Användarnamn: $this->username <br> " . "Email: $this->email";

        } else {
            echo "Alla argument behöver ett värde!";
            die();
        }
     }

    function GetAllUsers(){
            $sql = "SELECT * FROM users";
            $stm = $this->database_connection->prepare($sql);
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
                return $stm->fetch();
                die();
            } 
    
            $row = $stm->fetch();
            
            $this->userID = $row['ID'];
            $this->username = $row['Username'];
            $this->email = $row['Email'];
            $this->password = $row['Password'];
            
            return $row;

        }

        
    function DeleteUser($userID) {
            $sql = "DELETE FROM users WHERE ID=:userID_IN";
            $stm = $this->database_connection->prepare($sql);
            $stm->bindParam(":userID_IN", $userID);
            $stm->execute();
    
            // $message = new stdClass(); // ny stdClass?
            if($stm->rowCount() > 0) {
                echo "Användare med user-ID $userID blev borttagen!";
            } else { 
                echo "Ingen användare med User-ID=$userID hittades!";
            }
        }


    function EditUser($userID, $username = "", $password = "", $email = "", $role = ""){

        if( !empty($username) ){
            echo $this->UpdateUsername($userID, $username);
        }

        if( !empty($email) ){
            echo $this->UpdateEmail($userID, $email);
        }

        if( !empty($password) ){
            echo $this->UpdatePassword($userID, $password);
        }

        //if (isset($_SESSION[’Role’]) && $_SESSION [’Role’] == ”admin”)){

        // if( !empty($role) ){
        //     echo $this->UpdateRole($userID, $role);
        //     }
        // }
        

    function UpdateUsername( $userID, $username ){
        $sql = "UPDATE users SET Username=:username_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":username_IN", $username);
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
        $stm ->bindParam(":password_IN", $password);
        $stm ->execute();
    
            if( !$stm->rowCount() < 1) {
                return "Ingen användare med ID = $userID hittades!";
            }
        }

    function UpdateEmail($userID, $email){
        $sql = "UPDATE users SET Email=:username_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":email_IN", $email);
        $stm ->execute();

        if( !$stm->rowCount() < 1) {
            return "Ingen användare med ID = $userID hittades!";
        }
     }

    function UpdateRole($userID, $role){
        $sql = "UPDATE users SET Role=:role_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID_IN);
        $stm ->bindParam(":role_IN", $role);
        $stm ->execute();

        if( !$stm->rowCount() < 1){
            return "Ingen användare med ID=$userID hittades!";
        }
     }
    
    function LoginUser($username, $password){

        $username = $_GET['username'];
        $password = $_GET['password'];

        $sql = "SELECT ID, Username, Email FROM users WHERE username=:username_IN AND Password=:password_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam("username_IN", $username);
        $stm->bindParam("password_IN", $password);
        
        //Om användaren skriver rätt, 1 true 0 false
        if( $stm->rowCount() == 1){
            $row = $stm->fetch();
            echo "User-ID :" . $row['id'] . " - " . $row['username']; 
            //funkar det såhär om jag skriver små bokstäver?
            }
        }
    
    // function CreateNewToken(){}

    }
}
?>