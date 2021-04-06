<?php

    // Här skapar jag en användare:
    //localhost/API-1/Users/createUser.php?username=Sara&email=sara@gmail.com&password=sara&role=user

    include("../db.php");
    include("UserClass.php");

    $userID = new User($pdo);
    print_r($userID->CreateNewUser());

    
    //Hårdkoda, byt värde i "" för att testa om det kommer in en ny användare:
    // $user->CreateNewUser("Carlos", "carlos@gmail.com", "carlos", "user");
    


?>