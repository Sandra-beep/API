<?php

//Skriv i URL-fältet:
// localhost/API-1/Users/loginUser.php?username=Sandra&password=sandra
    
include("../db.php");
include("UserClass.php");


$username = $_GET ['username'];
$password = $_GET ['password'];

// Kryptering av lösenord:
// $salt = "hejåhå235246369()/=/r6**";
// $password = md5($password.$salt);

$userID = new User($pdo);
print_r($userID->LoginUser($username, $password));