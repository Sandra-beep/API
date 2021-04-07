<?php
    include("../db.php");
    include("UserClass.php");

    $userID = new User($pdo);
    echo "<h2>Rgistrerade i databasen:</h2>";
    
    echo '<pre>';
    print_r($userID->GetAllUsers()); //funkar inte med array_unique
    echo '</pre>';

    //Fixa:Endast 