<?php
    include("../db.php");
    include("UserClass.php");

    $user = new User($pdo);

    //Hårdkoda för att testa om det kommer in en ny användare:
    //http://localhost/API-1/Users/createUser.php?username=Sara&email=sara@gmail.com&password=sara
    // $user->CreateNewUser("Sara", "sara@gmail.com", "sara");
    

    // $user->Login($username, $password);

?>