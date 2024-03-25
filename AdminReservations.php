<?php
include "Header_Footer/Header.php";

$stmt = $pdo->prepare("SELECT r.*, u.Username
                       FROM reservations r
                       JOIN users u ON r.UserID = u.UserID");
$stmt->execute();
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicio </title>
</head>
<body>
    <div class="allresHis">
        <h1>All Reservations</h1>
        <div class="resDetails">
            <div class="headerResHis">
                <p>Nr.</p>
                <p>Usename</p>
                <p>Date of Reservation</p>
                <p>Nr Persons</p>
                <p>Ambient</p>
            </div>
            <div class="reservationsMade">
            <?php
                $count = 1;
                foreach ($reservations as $row) {
                    ?>
                    <div class="resRow">
                        <p><?php echo $count; ?></p>
                        <p><?php echo $row['Username']; ?></p>
                        <p><?php echo $row['ReservationDate']; ?></p>
                        <p><?php echo $row['NumberOfPersons']; ?></p>
                        <p><?php echo $row['Place']; ?></p>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include "Header_Footer/Footer.php";
?>