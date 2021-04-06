<?php
    include("../db.php");
    include("UserClass.php");

    $user = new User($pdo);

    //Om man har angett ID så tas user bort från tabellen
    if( !empty($_GET['id']) ){
        //vrf json_encode? (borttagen)
       echo $user->DeleteUser($_GET['id']); //kan man göra såhär?
    } else {
        $error->message = "Du har varken skrivit eller angett rätt ID!";
        echo $error; //vrf json_encode, funkar detta ändå?
    }

?>