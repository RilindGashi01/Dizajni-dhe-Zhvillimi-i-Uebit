<?php
session_start();
include 'DBCon/db.php';

    $stmt = $pdo->prepare("DELETE FROM loggedusers WHERE Username = ?");
    $stmt->execute([$_SESSION['loggedInUser']]);

    session_destroy();
    
    header("Location: Log-In.php");
    exit;

?>