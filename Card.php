<?php 
include 'Header_Footer/Header.php';
include 'DBcon\db.php';
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
            $sql = "SELECT ID,Emri_Produktit,Qmimi,Sasia FROM karta;";
            $stm = $pdo->query($sql);
            $elems = $stm->fetchAll(PDO::FETCH_ASSOC);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productId = $_POST['product_id'];
                $newQuantity = $_POST['quantity'];

                $sql = "UPDATE `karta` SET Sasia = :quantity WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['quantity' => $newQuantity, 'id' => $productId]);
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['delete_id'])) {
                    $deleteId = $_POST['delete_id'];
                    $sql = "DELETE FROM karta WHERE ID = :id";
                    $stm = $pdo->prepare($sql);
                    $stm->execute(['id' => $deleteId]);
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $allproductNamesJSON = $_POST['allproductNames'];
                $allquantitiesJSON = $_POST['allquantities'];
                $allpricesJSON = $_POST['prices']; 
                $alltotalPricesJSON = $_POST['alltotalPrices'];
                $totalOfOrder = $_POST['totalOfOrder'];

                $serializedAllproductNames = serialize(json_decode($allproductNamesJSON, true));
                $serializedAllquantities = serialize(json_decode($allquantitiesJSON, true));
                $serializedAllprices = serialize(json_decode($allpricesJSON, true));
                $serializedAlltotalPrices = serialize(json_decode($alltotalPricesJSON, true));

                var_dump($serializedAllproductNames);
            
                $sql = "INSERT INTO porosite (Emri_Produktit, Sasia, Qmimi, Totali, Totali_i_Porosise) VALUES (:productName, :quantity, :price, :totalPrice, :totalOrder)";
                $stm = $pdo->prepare($sql);

                $stm->bindParam(':productName', $serializedAllproductNames);
                $stm->bindParam(':quantity', $serializedAllquantities);
                $stm->bindParam(':price', $serializedAllprices);
                $stm->bindParam(':totalPrice', $serializedAlltotalPrices);
                $stm->bindParam(':totalOrder', $totalOfOrder);
            
                $stm->execute();
            
            }
        ?>

        <div class="conCard">
            <div class="container-card">
                <h1 class="card-h1">Card</h1>
                <?php
                $total=0;
                 foreach($elems as $elem): 
                   $total += $elem['Qmimi'] * $elem['Sasia'] ?>
                <div class="card-elem">
                    <p class="emriPro"><?php echo $elem['Emri_Produktit']?></p>
                    <input id="<?php echo $elem['ID']; ?>"  type="number" class="quantityCard" value=<?php echo $elem['Sasia']?> onchange="submit(<?php echo $elem['ID']; ?>)">
                    <p class="qmimi qmimi1"><?php echo number_format($elem['Qmimi'],2)?></p>
                    <button onclick="confirmDelete(<?php echo $elem['ID'];?>)"><i class="bi bi-trash"></i></button>
                    <p class ="qmimi qmimi2"><?php echo number_format($elem['Qmimi'] * $elem['Sasia'],2 )?></p>
                </div>
                <?php endforeach; ?>
                <p class="checkOutTotal">Totali: <span class="totalValue"><?php echo number_format($total,2)?></span> </p>
                <div class="button-container">
                <button class="order-button" onclick="handleOrder()">Order Now</button>
                </div>
            </div>
        </div>
        <div class="spacer"></div>
</body>
<script src="JavaScript/Card.js"></script>
</html>
<?php include 'Header_Footer/Footer.php'?>