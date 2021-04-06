<?php

include("../db.php");
include('cartClass.php');

$cartid = $_GET['cartid']; //behöver man skriva i URL?
$userid = $_GET['userid']; //behöver man skriva i URL?
//är man i checkout så anger man productID, så ska dessa läggas till, en i taget?

$stm->$pdo->prepare('SELECT ID, productID FROM cart WHERE ID=:cartId_IN');
$stm->bindParam('cartId_IN', $cartid);

        $stm->execute();
        return $stm->fetchAll();

        $stm->$pdo->prepare('SELECT Username FROM users WHERE ID=:userId_IN');
