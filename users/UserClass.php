<?php

// A class's: Variable = properties/egenskaper. Function = method/metod.

class User {

    private $database_connection;
    private $userID;
    private $username;
    private $email;
    private $password;

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
        //Checkar om det finns en användare registrera, genom att räkna raderna/användarna i tabellen i databasen
        $rows = $stm->rowCount();
            if( $rows > 0 ){
                echo "Användare är redan registrerad - försök med ny info!";
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

            echo "<pre>";
            "Användarnamn: $this->username <br> " . "Email: $this->email";
            echo"<pre>";

        } else {
            echo "Antingen username, email eller password behöver ett värde!";
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


    function EditUser($userID, $username = "", $email = "", $password = "", $role = ""){

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
    }

    function UpdateUsername( $userID, $username ){
        $sql = "UPDATE users SET Username=:username_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":username_IN", $username);

         if($stm ->execute()){
            echo "User-ID: $userID <br> Ny username: " . $username . "<br>";
            die();
         }
            if( !$stm->rowCount() < 1){
                echo "Ingen användare med ID = $userID hittades!";
            }

        }

    function UpdateEmail($userID, $email){
        $sql = "UPDATE users SET Email=:email_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":email_IN", $email);

         if($stm ->execute()){
            echo "User-ID: $userID <br> Ny email: " . $email . "<br>";
            die();
         }
            if( !$stm->rowCount() < 1){
                echo "Ingen användare med ID = $userID hittades!";
            }

        }

     function UpdatePassword( $userID, $password ){
        $sql = "UPDATE users SET Password=:password_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID);
        $stm ->bindParam(":password_IN", $password);
        $stm ->execute();
    
        if($stm ->execute()){
            echo "User-ID: $userID <br> Nytt lösenord: " . $password . "<br>";
            die();
         }
            if( !$stm->rowCount() < 1){
                echo "Lösenordet kunde inte bytas - testa igen!";
            }

    function UpdateRole($userID, $role){
        $sql = "UPDATE users SET Role=:role_IN WHERE ID=:userID_IN";
        $stm = $this->database_connection->prepare($sql);
        $stm ->bindParam(":userID_IN", $userID_IN);
        $stm ->bindParam(":role_IN", $role);
        $stm ->execute();

        echo "Ny roll: " . $role . "<br>";


        if( !$stm->rowCount() < 1){
            echo "Ingen användare med ID=$userID hittades!";
        }
     }
    
    function LoginUser($username, $password){

        $sql = "SELECT ID, Username, Email FROM users WHERE username=:username_IN AND Password=:password_IN";
        $stm = $this->database_connection->prepare( $sql );
        $stm->bindParam(":username_IN", $username);
        $stm->bindParam(":password_IN", $password);
        $return = $stm->execute();

        print_r ($return);
        $row = $stm->fetch();

        //Om rätt skrivet, så visas 1 true och är 0 false
        if($row[0] > 0){
            echo "Toppen du är inloggad! <br>" 
            . "User-ID :" . $row['ID'] 
            . "<br>Username: " . $row['Username']
            . "<br>Email: " . $row['Email']; 
            //row['']innanför brackets samma som column-namn
            }
        }
    
    // function CreateNewToken(){}

    }
}

?>