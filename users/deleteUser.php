<?php
//Ändra/välj siffran efter userid= för att ta bort den användare som den tillhör
//localhost/API-1/Users/deleteUser.php?userid=3

    include("../db.php");
    include("UserClass.php");

    $userID = new User($pdo);

    if( !empty($_GET['userid']) ){
       echo $userID->DeleteUser($_GET['userid']);
    } else {
        echo "Ange User-ID!";
    }

?>