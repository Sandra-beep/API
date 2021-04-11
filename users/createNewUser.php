<?php

    // Bytt info efter username, email och password
    // localhost/API-1/Users/createNewUser.php?username=Joakim&email=joakim@gmail.com&password=joakim123

    include("../db.php");
    include("UserClass.php");

    $userData = new User($pdo);
    $userData->CreateNewUser($_GET['username'], $_GET['email'], $_GET['password']);
    // ['']= det som ska in i URL-fältet

    
    //Hårdkoda, byt värde i "" för att testa om det kommer in en ny användare:
    // $user->CreateNewUser("Joakim", "joakim@gmail.com", "joakim123");
    


?>