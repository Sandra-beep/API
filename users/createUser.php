<?php
    include("../db.php");
    include("UserClass.php");

    $username = $_GET ['username'];
    $password = $_GET ['password'];


    //Testa om det kommer in en ny användare:
    $user->CreateNewUser("Sandra", "sandra@gmail.com", "Sandra");
    
    $user = new User($pdo);
    // $user->Login($username, $password);

?>