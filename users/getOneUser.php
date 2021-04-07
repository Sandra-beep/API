<?php
//Byt userid i URL-fältet, för att se info: 
//localhost/API-1/Users/getOneUser.php?userid=1

include("../db.php");
include("UserClass.php");


// Om den inte är tom så hämtar den användare
if( !empty($_GET['userid']) ){
    echo "<h3>Info om User-ID: " . $_GET['userid'] . "</h3>";
    $userID = new User($pdo);
    $userData = $userID->GetOneUser($_GET['userid']);
    echo "<pre>";
    print_r (array_unique($userData));
    echo "</pre>";

}else{
    echo "Inget ID är specificerat!";
    die();
}