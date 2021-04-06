<?php
    include("../db.php");
    include("UserClass.php");

    $user = new User($pdo);
    print_r($user->GetAllUsers());

?>