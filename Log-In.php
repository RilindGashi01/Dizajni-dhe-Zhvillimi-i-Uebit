<?php
include "Header_Footer/Header.php";
include "DBcon/db.php";
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
            $logUsername = $_POST['username'];
            $logRole = $_POST['userType'];
            $logPassword = $_POST['password'];

            if($logRole == 'user'){
                $sql = "SELECT * FROM users WHERE Username = :username;";
                $stm = $pdo->prepare($sql);
                $stm->bindParam(':username',$logUsername,PDO::PARAM_STR);
                $stm->execute();
                $results = $stm->fetch(PDO::FETCH_ASSOC);

                if($results){
                    $dbPassword = $results['Password'];
                    $userID = $results['UserID'];
                    if(password_verify($logPassword,$dbPassword)){
                        $stm = $pdo->prepare('SELECT * FROM `loggedusers`');
                        $stm->execute();
                        $result1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result1) > 0){
                            $_SESSION['error']="There is one user logged in";
                        }else{
                            $userRole= $pdo->prepare('INSERT INTO `loggedusers`(`UserID`, `Username`, `UserType`) VALUES (?,?,?)');
                            $userRole->execute([$userID,$logUsername,$logRole]);
                            $_SESSION['logUsername']=$logUsername;
                            header("Location: index.php");
                        }
                    }else{
                        $_SESSION['error']="This username and Password dosent exists on Users database";
                    
                }
            }
        }
        else{
            $sql = "SELECT * FROM admins WHERE Username = :username;";
                $stm = $pdo->prepare($sql);
                $stm->bindParam(':username',$logUsername,PDO::PARAM_STR);
                $stm->execute();
                $results = $stm->fetch(PDO::FETCH_ASSOC);

                if($results){
                    $dbPassword = $results['Password'];
                    if(password_verify($logPassword,$dbPassword)){
                        $stm = $pdo->prepare('SELECT * FROM `loggedusers`');
                        $stm->execute();
                        $result1 = $stm->fetchAll(PDO::FETCH_ASSOC);
                        if (count($result1) > 0){
                            $_SESSION['error']="There is one user logged in";
                        }else{$userRole= $pdo->prepare('INSERT INTO `loggedusers`(`Username`, `UserType`) VALUES (?,?)');
                            $userRole->execute([$logUsername,$logRole]);
                            $_SESSION['logUsername']=$logUsername;
                            header("Location: index.php");
                        }
                    }else{
                        $_SESSION['error']="This username and Password dosent exists on Admins database";
                    
                }
            }
        }
    }
    ?>
    <div class="logsig">
        <div class="form-container login">
            <h2>Login</h2>
                <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="userType">User Type:</label>
                    <select class="typeUser" id="userType" name="userType" style="height: 23px; margin-bottom: 10px;">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo '<p style="color:red; font-size:10px; margin:0;">' . $_SESSION['error'] . '</p>';
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div class="logreg">
                    <button type="submit" class="BtnLogin">Login</button>
                    <button type="button" class="regist">Resgister</button>
                    </div>
                </form>
        </div>
    </div>
    <script src="JavaScript/Validation.js"></script>
</body>
</html>
<?php 
include "Header_Footer/Footer.php";
?>