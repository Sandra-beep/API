<?php

//Skriv i URL fältet så att jag kan ändra:
// localhost/API-1/Users/editUser.php?userid=1&username=Sandrita

    include("../db.php");
    include("UserClass.php");

    // Lämnas tomma så att användare kan lägga till
    $userID = "";
    $username = "";
    $email = "";
    $password = "";
    // $role = ""; Bara admin ska kunna ändra roll

    // Om users ID är satt så går den vidare och ändrar resten
    if(isset($_GET['userid'])){
        $userID = $_GET['userid'];
    }else {
        echo "Ange User-ID!";
    }

    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    // else { // Man behöver skriv till detta!
    //     echo "Ange tex username! <br>";
    //     die();
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
    print_r($userData->editUser($userID, $username, $email, $password));

?>
