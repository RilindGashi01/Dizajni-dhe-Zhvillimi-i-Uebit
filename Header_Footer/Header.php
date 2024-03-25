<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Delicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <?php 
        session_start();
        include 'DBCon\db.php';
        $stmt = $pdo->query("SELECT * FROM loggedusers LIMIT 1");
        $loggedInUser = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!empty($loggedInUser)) {
            $_SESSION['loggedInUser'] = $loggedInUser['Username'];
            $_SESSION['UserType'] = $loggedInUser['UserType'];
        }
    ?>
        <div class="header-container">
            <h1 class="logo">Delicio</h1>
            <nav>
                <ul>
                    <li><a class="header-links" href="Index.php">Home</a></li>
                    <li><a class="header-links" href="Order.php">Order</a></li>
                    <li><a class="header-links" id="Card-header" href="Card.php">Card</a></li>
                    <li><a class="header-links" href="About.php">About</a></li>
                    <?php if(isset($_SESSION['loggedInUser'])): ?>
                        <li><a class="header-links loggedUser" onclick="logOutType('<?php echo $_SESSION['UserType']?>')"><?php echo $_SESSION['loggedInUser']; ?></a></li>
                    <?php else: ?>
                        <li><a class="header-links" href="Log-In.php">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    </header>
    <div class="top-right-boxes adminsignOut">
        <div class="box sign-in-out">
            <a href="#" class="box-link" onclick="logOut()">Sign-Out</a>
        </div>
        <div class="box options">
            <a href="AdminReservations.php" class="box-link">Reservations</a>
        </div>
        <div class="box options">
            <a href="AdminOrders.php" class="box-link">Orders</a>
        </div>
        <div class="box options">
            <a href="AdminProducts.php" class="box-link">Products</a>
        </div>
        <div class="box options" onclick="backAdmin()">
            <a href="#" class="box-link arrowUser"><i class="bi bi-arrow-up-circle-fill"></i></a>
        </div>
    </div>
    <div class="top-right-boxes usersignOut">
        <div class="box sign-in-out">
            <a href="#" class="box-link" onclick="logOut()">Sign-Out</a>
        </div>
        <div class="box options" onclick="backUser()">
            <a href="#" class="box-link arrowUser"><i class="bi bi-arrow-up-circle-fill"></i></a>
        </div>
    </div>   
    <script src="JavaScript/Header.js"></script>
