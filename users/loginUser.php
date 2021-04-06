<?php
    include("../db.php");
    include("UserClass.php");


    $username = $_GET ['username'];
    $password = $_GET ['password'];

    //Skriv i URL-fältet: http://localhost/API-1//Users/loginUser.php?username=Sandra&password=Sandra
    $user = new User($pdo);
    $user->LoginUser($username, $password);
    $return->$user->LoginUser($username, $password);

    //Om den returnerar 1 så är det likamed True, att användare existerar i users-tabellen.
