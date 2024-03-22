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
    ?>
        <div class="header-container">
            <h1 class="logo">Delicio</h1>
            <nav>
                <ul>
                    <li><a class="header-links" href="Index.php">Home</a></li>
                    <li><a class="header-links" href="Order.php">Order</a></li>
                    <li><a class="header-links" id="Card-header" href="Card.php">Card</a></li>
                    <li><a class="header-links" href="About.php">About</a></li>
                    <li><a class="header-links" href="Log-In.php"><?php if(isset($_SESSION['logUsername'])){echo $_SESSION['logUsername'];}else{echo "Sign Up";}?></a></li>
                </ul>
            </nav>
        </div>
    </header>
