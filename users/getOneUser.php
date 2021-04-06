<?php
include("../db.php");
include("UserClass.php");

$user = new User($pdo);

// Om den inte är tom så hämtar den användare
if( !empty($_GET['id']) ){
$user->GetOneUser($_GET['id']);
//print_r eller fetch här?

}else{
    echo "Inget ID är specificerat!";
    die();
}
