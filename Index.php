<?php
include "Header_Footer/Header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicio</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $dateOfres = $_POST['dateRes'];
            $nrPers = $_POST['nrPersons'];
            if (isset($_POST['place']) && !empty($_POST['place'])) {
                $place = $_POST['place'];
            }

            $userQuery = $pdo->prepare('SELECT * FROM `loggedusers`');
            $userQuery->execute();
            $result = $userQuery->fetch(PDO::FETCH_ASSOC);
            if(!empty($result) && $result['UserID']!= null){
                $resQuery =$pdo->prepare('INSERT INTO `reservations`(`UserID`,`ReservationDate`,`NumberOfPersons`,`Place`) VALUES(?,?,?,?)');
                $resQuery->execute([$result['UserID'],$dateOfres,$nrPers,$place]);
            }else{
                $_SESSION['error']="You cannot make a reservation unless you are logged in or you are an admin.";
            }
        }
    ?>
    <div class="text">
            <h3 class="first-h3">WE ARE OPEN AGAIN</h3>
            <h1 class="main-h1">BOOK OR ORDER ONLINE</h1>
            <p class="paragraph">MORE INFORMATION ABOUT RESERVES DOWN BELOW</p>
            <div class="buttons">
            <button id="reservation" class="first butt">RESERVE</button>
            <button id="order-online" class="second butt">ORDER ONLINE</button>
            </div>
    </div>

    <form id="reservationBox" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <span id="closeButton">&times;</span>
        <h2>Reservation Details</h2>
        <label for="date">Date and Time:</label>
        <input type="datetime-local" id="date" name="dateRes" required>
        <label for="persons">Number of Persons:</label>
        <input type="number" id="persons" name="nrPersons" required>
        <label class="checkbox-label">
        <input type="radio" name="place" value="outside" > Reserve Outside
        </label>
        <label class="checkbox-label">
            <input type="radio" name="place" value="inside"> Reserve Inside
        </label>
        <?php
                        if (isset($_SESSION['error'])) {
                            echo '<p style="color:red; font-size:10px; margin:0;">' . $_SESSION['error'] . '</p>';
                            unset($_SESSION['error']);
                        }
        ?>
        <button type="submit" id="reserveButton" >Reserve</button>
    </form>
        
    <div class="carousel">
        <div class="carousel-slides">
            <div class="slide active">
                <img src="Images/Slider-1.jpg" alt="Slide 1">
            </div>
            <div class="slide">
                <img src="Images/Slider-2.webp" alt="Slide 2">
            </div>
            <div class="slide">
                <img src="Images/Slider-3.jpg" alt="Slide 3">
            </div>
        </div>
        <div class="spacer"></div>
        <button class="prev">❮</button>
        <button class="next">❯</button>
    </div>

    <script src="JavaScript/Home.js"></script>
</body>
</html>


<?php 
include "Header_Footer/Footer.php";
?>
