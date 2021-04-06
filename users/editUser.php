<?php
    include("../db.php");
    include("UserClass.php");

    // Lämnas tomma så att användare kan ändra
    $userId = "";
    $username = "";
    $password = "";
    $email = "";
    // $role = ""; Bara admin ska kunna ändra roll

    // Om users ID är satt så går den vidare och ändrar resten?
    if(isset($_GET['userid'])){
        $id = $_GET['userid'];
    }else {
        echo "Du har ej angett (rätt) User-ID!";
        die();
    }

    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }

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

    $userID = new User($pdo);
    // Behövs print_r eller fetch här?
    echo $userID->editUser($userID, $username, $password, $email);

?>
