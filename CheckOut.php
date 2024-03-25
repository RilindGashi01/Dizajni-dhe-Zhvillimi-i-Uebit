<?php
session_start();
include 'DBcon/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = json_decode($_POST['productId']);
    $sasia = json_decode($_POST['sasia']);
    $qmimiTotal = $_POST['qmimiTotal'];   

    $userQuery = $pdo->prepare('SELECT * FROM `loggedusers`');
    $userQuery->execute();
    $result1 = $userQuery->fetch(PDO::FETCH_ASSOC);

    $stm = $pdo->prepare('INSERT INTO `orders`(`UserID`, `TotalAmount`) VALUES(?,?)');
    $stm->execute([$result1['UserID'],number_format($qmimiTotal,2)]);

    $userQuery = $pdo->prepare('SELECT MAX(OrderID) AS lastOrder FROM `orders`;');
    $userQuery->execute();
    $result = $userQuery->fetch(PDO::FETCH_ASSOC);
    $lastOrder = (int) $result['lastOrder'];

    $stm1= $pdo->prepare('INSERT INTO `orderdetails`(`OrderID`, `ProductID`,`Quantity`) VALUES(?,?,?)');
    for ($i = 0; $i < count($productId); $i++) {
    $stm1->execute([$lastOrder,$productId[$i],$sasia[$i]]);
    }
    $stmt = $pdo->prepare("DELETE FROM `cart`");
    $stmt->execute();
}
?>
