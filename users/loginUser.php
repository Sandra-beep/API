<?php
    include("../db.php");
    include("UserClass.php");


    $username = $_GET ['username'];
    $password = $_GET ['password'];

    //Skriv i URL-fältet: http://localhost/API-1//Users/loginUser.php?username=Sandra&password=sandra
    $userID = new User($pdo);
    $userID->LoginUser($username, $password);
    $return->$userID->LoginUser($username, $password);

    //Om den returnerar 1 så är det likamed True, att användare existerar i users-tabellen.
