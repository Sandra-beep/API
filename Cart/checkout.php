<?php

//är man i checkout så anger man productID
//så ska dessa läggas till, en i taget?


include("../db.php");
include('cartClass.php');

$cartID = $_GET['cartid']; //behöver man skriva i URL?
$userID = $_GET['userid']; //behöver man skriva i URL?

$stm->$pdo->prepare('SELECT ID, productID FROM cart WHERE ID=:cartId_IN');
$stm->bindParam('cartId_IN', $cartid);

        $stm->execute();
        return $stm->fetchAll();

        $stm->$pdo->prepare('SELECT Username FROM users WHERE ID=:userId_IN');
