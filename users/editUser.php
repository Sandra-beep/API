<?php

//Skriv i URL fältet så att jag kan ändra:
//http://localhost/API-1/Users/editUser.php?userid=1&username=Sandrita
    include("../db.php");
    include("UserClass.php");

    // Lämnas tomma så att användare kan ändra
    $userID = "";
    $username = "";
    $password = "";
    $email = "";
    // $role = ""; Bara admin ska kunna ändra roll

    // Om users ID är satt så går den vidare och ändrar resten?
    if(isset($_GET['userid'])){
        $userID = $_GET['userid'];
    }else {
        echo "Du har ej angett (rätt) User-ID!";
        die();
    }

    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    // else{ //Kan detta funka? Får fatal error om jag använder samma namn
    //     echo "Samma namn som sist!"; 
    // }

    if(isset($_GET['email'])){
        $email = $_GET['email'];
    }
    
    if(isset($_GET['password'])){
        $password = $_GET['password'];
    }


    //bara OM Role = "admin" ska kunna ändra
    // if(isset($_GET['role'])){
    //     $role = $_GET['role'];
    // }

    $userData = new User($pdo);
    // Behövs print_r eller fetch här?
    print_r($userData->editUser($userID, $username, $password, $email));

?>
