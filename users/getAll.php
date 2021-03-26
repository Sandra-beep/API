<?php
    include("../db.php");
    include("UserClass.php");

    $user = new User($pdo);
    $user->GetAllUsers();

?>