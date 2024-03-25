<?php
include "Header_Footer/Header.php";
$stmt = $pdo->query("SELECT o.OrderID, o.OrderDate, o.TotalAmount, u.Username FROM Orders o JOIN Users u ON o.UserID = u.UserID;");
$orderNumber = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicio</title>
</head>
<body>
    <div class="orders-history">
        <h1>Orders History</h1>
        <div class="ordersDetails">
            <p>Nr.</p>
            <p>User</p>
            <p>Date</p>
            <p>TotalAmount</p>
        </div>
        <?php foreach ($stmt as $row): ?>
        <div>
        <div class="orders-details">
            <div class="ord-det">
            <p class="orderNumber"><?php echo $orderNumber++; ?></p>
            <button class="orderDetaisData" onclick="adminOrder(<?php echo $row['OrderID']; ?>)">Details</button>
            </div>
            <div class="productsNames">
                <p><?php echo $row['Username']; ?></p>
            </div>
            <div class="productsQuantity">
                <p><?php echo $row['OrderDate']; ?></p>
            </div>
            <div class="totalOfTotal">
                <p>$<?php echo number_format($row['TotalAmount'],2); ?></p>
            </div>
        </div>
        <div class="allOfDetOrders" id="<?php echo $row['OrderID']?>" >
            <div class="detAllOr">
            <p class="nameDet">Product Name</p>
            <p class="nameDet">Quantity</p>
            <p class="nameDet">Price</p>
            <p class="nameDet">Total Price</p>
            </div>
            <?php 
            $sql = "SELECT od.OrderDetailID, od.OrderID, od.ProductID, od.Quantity, p.Name AS ProductName, p.Price AS ProductPrice \n"
            . "        FROM `orderdetails` od \n"
            . "        JOIN `products` p ON od.ProductID = p.ProductID \n"
            . "        WHERE od.OrderID = :id;";
            $stm1 =$pdo->prepare($sql);
            $stm1->bindParam(':id',$row['OrderID']);
            $stm1->execute();
            $result = $stm1->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $res) {
                    ?>
                    <div class="details-of-each">
                        <p class="proName"><?php echo $res['ProductName']; ?></p>
                        <p class="quanti"><?php echo $res['Quantity']; ?></p>
                        <p><?php echo $res['ProductPrice']; ?></p>
                        <p><?php echo $res['Quantity']*$res['ProductPrice']; ?></p>
                    </div>
                    <?php
                }
                ?>
                <div class="HideDetails" onclick="adminOrder1(<?php echo $row['OrderID']; ?>)">
                <button>Hide Detalis</button>
                </div>
        </div>
        </div>
         
        <?php endforeach; ?>
        </div>   
        <div class="spacer"></div>  
        
    <script src="JavaScript/Admin.js"></script>
</body>
</html>
<?php
include "Header_Footer/Footer.php";
?>