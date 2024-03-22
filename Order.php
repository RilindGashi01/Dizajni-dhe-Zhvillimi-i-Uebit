<?php
include "Header_Footer/Header.php";
include 'DBcon\db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo&family=Oswald&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@200;400&family=Nanum+Myeongjo&family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Hind+Madurai&family=Lilita+One&family=Nanum+Myeongjo&family=Pinyon+Script&family=Playfair+Display&family=Raleway:wght@200;300&family=Roboto&family=Roboto+Condensed&family=Sigmar&family=Sofia+Sans+Semi+Condensed&display=swap" rel="stylesheet">
    <title>Delicio</title>
</head>
<body>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productName = isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : '';
        $productPrice = isset($_POST['productPrice']) ? number_format($_POST['productPrice'], 2) : '';

        $stm = $pdo->prepare('SELECT Emri_Produktit FROM `Karta` WHERE Emri_Produktit = :productName');
        $stm->bindParam(':productName', $productName, PDO::PARAM_STR);
        $stm->execute();

        $result = $stm->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            $insertQuery = $pdo->prepare('INSERT INTO `Karta`(`Emri_Produktit`, `Qmimi`) VALUES (?, ?)');
            $insertQuery->execute([$productName, $productPrice]);
        }    
    }
    ?>
<div class="menu">
        <div class="categorys-of-menu">
            <button id="drink" class="cate drink">Drinks</button>
            <button id="pasta" class="cate pasta">Pasta</button>
            <button id="pizza" class="cate pizza">Pizza</button>
        </div>
    </div>    

        <div class="menus">
            <div class="drinks">
                    <h2 class="menus-h2">Drinks</h2>
                        <div class="items-of-menu">
                            <?php 
                                $sql = "SELECT * FROM `products` WHERE Category = \"Drinks\";";
                                $stm = $pdo->prepare($sql);
                                $stm -> execute();
                                $drinks =$stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($drinks as $item): ?>
                                    <div class="drink-item">
                                        <img src="images/<?= $item['Name']; ?>.jpg" alt="<?= $item['Name']; ?>">
                                        <div class="drink-details">
                                            <p class="item-name"><?= $item['Name']; ?></p>
                                            <p class="item-price">$ <?= number_format($item['Price'],2); ?></p>
                                            <button class="checkOutBtn" onclick="handleOrder('<?= $item['Name']; ?>','<?= number_format($item['Price'],2); ?>')" >Order</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                         </div>
                    
            </div>
            <div class="pasta-menu">
                <h2 class="menus-h2">Pasta</h2>
                <div class="items-of-menu">
                        <?php 
                                $sql = "SELECT * FROM `products` WHERE Category = \"Pasta\";";
                                $stm = $pdo->prepare($sql);
                                $stm -> execute();
                                $drinks =$stm->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($drinks as $item): ?>
                                    <div class="drink-item">
                                        <img src="images/<?= $item['Name']; ?>.jpg" alt="<?= $item['Name']; ?>">
                                        <div class="drink-details">
                                            <p class="item-name"><?= $item['Name']; ?></p>
                                            <p class="item-price">$ <?= number_format($item['Price'],2); ?></p>
                                            <button class="checkOutBtn" onclick="handleOrder('<?= $item['Name']; ?>','<?= number_format($item['Price'],2); ?>')" >Order</button>
                                        </div>
                                    </div>
                        <?php endforeach; ?>
                    
                </div>
            </div>
        <div class="pizza-menu">
            <h2 class="menus-h2">Pizza</h2>
            <div class="items-of-menu">
                <?php 
                                $sql = "SELECT * FROM `products` WHERE Category = \"Pizza\";";
                                $stm = $pdo->prepare($sql);
                                $stm -> execute();
                                $drinks =$stm->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($drinks as $item): ?>
                                    <div class="drink-item">
                                        <img src="images/<?= $item['Name']; ?>.jpg" alt="<?= $item['Name']; ?>">
                                        <div class="drink-details">
                                            <p class="item-name"><?= $item['Name']; ?></p>
                                            <p class="item-price">$ <?= number_format($item['Price'],2); ?></p>
                                            <button class="checkOutBtn" onclick="handleOrder('<?= $item['Name']; ?>','<?= number_format($item['Price'],2); ?>')" >Order</button>
                                        </div>
                                    </div>
                        <?php endforeach; ?>
                </div>
                
            </div>
        </div>
        <div class="spacer"></div>
        <script src="JavaScript/Order.js"></script>
</body>
</html>

<?php
include "Header_Footer/Footer.php";
?>