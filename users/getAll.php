<?php
    include("../db.php");
    include("UserClass.php");

    $userID = new User($pdo);
    echo "<h3>Alla registrerade i databasen:</h3>";
    echo '<pre>';
    print_r($userID->GetAllUsers()); //funkar
    echo '</pre>';

?>