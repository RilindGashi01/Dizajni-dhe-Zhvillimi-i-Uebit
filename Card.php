<?php 
include 'Header_Footer/Header.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
         <?php
         $sql = "SELECT Products.ProductID, Products.Name, Products.Price, Cart.Quantity 
         FROM Cart 
         INNER JOIN Products ON Cart.ProductID = Products.ProductID";
         $stm = $pdo->query($sql);
         $elems = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productId = $_POST['product_id'];
                $newQuantity = $_POST['quantity'];
                
                $sql = "UPDATE `cart` SET Quantity = :quantity WHERE ProductID = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['quantity' => $newQuantity, 'id' => $productId]);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $deleteId = $_POST['delete_id'];
                $sql = "DELETE FROM cart WHERE ProductID = :id";
                $stm = $pdo->prepare($sql);
                $stm->execute(['id' => $deleteId]);
            }   
            ?>
            <div class="conCard">
                <div class="container-card">
                    <h1 class="card-h1">Card</h1>
                    <?php
                    $total = 0;
                    foreach ($elems as $elem):
                        $total += $elem['Price'] * $elem['Quantity'];
                    ?>
                        <div class="card-elem">
                            <p class="emriPro"><?php echo $elem['Name']?></p>
                            <input type="hidden" class="producID" value="<?php echo $elem['ProductID']?>">
                            <input id="<?php echo $elem['ProductID']; ?>" type="number" class="quantityCard" value="<?php echo $elem['Quantity']?>" onchange="submit(<?php echo $elem['ProductID']; ?>,event)">
                            <p class="qmimi qmimi1"><?php echo number_format($elem['Price'], 2)?></p>
                            <button onclick="confirmDelete(<?php echo $elem['ProductID'];?>)"><i class="bi bi-trash"></i></button>
                            <p class="qmimi qmimi2"><?php echo number_format($elem['Price'] * $elem['Quantity'], 2)?></p>
                        </div>
                    <?php endforeach; ?>
                    <p class="checkOutTotal">Totali: <span class="totalValue"><?php echo number_format($total, 2)?></span></p>
                    <div class="button-container">
                        <button type="submit" class="order-button" onclick=handleOrder()>Order Now</button>
                    </div>
                </div>
            </div>

        <div class="spacer"></div>
</body>
<script src="JavaScript/Card.js"></script>
</html>
<?php include 'Header_Footer/Footer.php'?>