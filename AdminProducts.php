<?php
include "Header_Footer/Header.php";

$stmt = $pdo->prepare("SELECT * FROM `products`");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteId = $_POST['delete_id'];
    $sql = "DELETE FROM products WHERE ProductID = :id";
    $stm = $pdo->prepare($sql);
    $stm->execute(['id' => $deleteId]);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicio </title>
</head>
<body>
   
    <form action="submit_product.php" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" required><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <input type="submit" value="Submit">
    </form>
    </div>
    <div class="allresHis">
        <h1>All Reservations</h1>
        <div class="resDetails">
            <div class="headerResHis">
                <p>Nr.</p>
                <p>Category</p>
                <p>Product Name</p>
                <p>Price</p>
                <p>Delete</p>
            </div>
            <div class="productsInAdmin reservationsMade">
            <?php
                $count = 1;
                foreach ($products as $row) {
                    ?>
                    <div class="resRow detilPro">
                        <p><?php echo $count; ?></p>
                        <p><?php echo $row['Category']; ?></p>
                        <p><?php echo $row['Name']; ?></p>
                        <p><?php echo $row['Price']; ?></p>
                        <p id="<?php echo $row['ProductID']; ?>" onclick="confirmDelete(<?php echo $row['ProductID']; ?>)"><i class="bi bi-trash"></i></p>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            </div>
        </div>
    </div>
    
    <script src="JavaScript/Admin.js"></script>
    <div class="spacer"></div> 
</body>
</html>
<?php
include "Header_Footer/Footer.php";
?>