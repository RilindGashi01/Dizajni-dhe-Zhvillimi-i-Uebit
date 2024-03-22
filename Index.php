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
    <div class="text">
            <h3 class="first-h3">WE ARE OPEN AGAIN</h3>
            <h1 class="main-h1">BOOK OR ORDER ONLINE</h1>
            <p class="paragraph">MORE INFORMATION ABOUT RESERVES DOWN BELOW</p>
            <div class="buttons">
            <button id="reservation" class="first butt">RESERVE</button>
            <buttonn id="order-online" class="second butt" >ORDER ONLINE</button>
            </div>
    </div>

    <form id="reservationBox">
        <span id="closeButton">&times;</span>
        <h2>Reservation Details</h2>
        <label for="date">Date and Time:</label>
        <input type="datetime-local" id="date" required>
        <label for="persons">Number of Persons:</label>
        <input type="number" id="persons" required>
        <label class="checkbox-label">
            <input type="checkbox" id="outside"> Reserve Outside
        </label>
        <label class="checkbox-label">
            <input type="checkbox" id="inside"> Reserve Inside
        </label>
        <button id="reserveButton" >Reserve</button>
    </form>
        
    <div class="carousel">
    <div class="carousel-slides">
        <div class="slide active">
        <img src="Images/Slider-1.jpg" alt="Slide 1">
        </div>
        <div class="slide">
        <img src="Images/Slider-2.jpg" alt="Slide 2">
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
