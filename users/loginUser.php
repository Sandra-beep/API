<?php

//Skriv i URL-fältet:
// localhost/API-1/Users/loginUser.php?username=Sandra&password=sandra
    
include("../db.php");
include("UserClass.php");

// Om username till användaren är tom så kör den echo
if (empty($_GET['username'])){
    echo "Ange användarnamn!";
    die();
} 

if (empty($_GET['password'])){
    echo "Ange lösenord!";
    die();
}

$userLogin = new User($pdo);
$userLogin->LoginUser($_GET['username'], $_GET['password']);
