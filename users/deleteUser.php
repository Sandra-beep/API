<?php
//Ändra/välj siffran efter userid= för att ta bort den användare som den tillhör
//http://localhost/API-1/Users/deleteUser.php?userid=3

    include("../db.php");
    include("UserClass.php");

    $userID = new User($pdo);

    //Om man har angett ID så tas user bort från tabellen
    if( !empty($_GET['userid']) ){
        //vrf json_encode? (borttagen)
       echo $userID->DeleteUser($_GET['userid']);
    } else {
        $error->message = "Du har inte angett (rätt) ID!";
        echo $error; //vrf json_encode, funkar detta ändå?
    }

?>