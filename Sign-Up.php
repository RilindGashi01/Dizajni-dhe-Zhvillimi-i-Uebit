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
    require_once 'Classes/SignUpVal.php'; 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['UsrnameofSingUp'];
        $email = $_POST['newEmail'];
        $password = $_POST['newPassword'];
        $confirmPassword = $_POST['newPassword-2'];
        $role = $_POST['userType'];

        $validator = new SignupFormValidator($username, $email, $password, $confirmPassword);
        if ($validator->validate()) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if($role == 'user'){
                $stm = $pdo->prepare('SELECT Username FROM `users` WHERE Username = :username');
                $stm->bindParam(':username', $username, PDO::PARAM_STR);
                $stm->execute();
                $result = $stm->fetch(PDO::FETCH_ASSOC);

                if ($result == false) {
                $userRole= $pdo->prepare('INSERT INTO `users`(`Username`, `Email`, `Password`, `Role`) VALUES (?,?,?,?)');
                $userRole->execute([$username,$email,$hashedPassword,$role]);
                header('Location: Log-In.php');
                exit;
                }else{
                    $_SESSION['error']="This username exists on Users database";
                }
            }else{
                $stm = $pdo->prepare('SELECT Username FROM `admins` WHERE Username = :username');
                $stm->bindParam(':username', $username, PDO::PARAM_STR);
                $stm->execute();
                $result = $stm->fetch(PDO::FETCH_ASSOC);

                if ($result == false) {
                $adminRole= $pdo->prepare('INSERT INTO `admins`(`Username`, `Email`, `Password`, `Role`) VALUES (?,?,?,?)');
                $adminRole->execute([$username,$email,$hashedPassword,$role]);
                header('Location: Log-In.php');
                exit;
                }else{
                    $_SESSION['error']="This username exists on Admins database";
                }
            }
        } else {
            echo json_encode($validator->getErrors());
        }
    }
    ?>

    
    <div class="logsig">
        <div class="form-container singup">
                <h2>Sign-up</h2>
                <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                    <label for="UsernameofSingUp">Username:</label>
                    <p id="usernameError" class="error">Username must be at least 6 characters long.</p>
                    <input type="text" id="UsernameofSingUp" name="UsrnameofSingUp" class="usernameSingUp" required>

                    <label for="userType">User Type:</label>
                    <select class="typeUser" id="userType" name="userType" style="height: 23px; margin-bottom: 10px;">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                    
                    <label for="newEmail">Email:</label>
                    <p id="emailError" class="error">Invalid Email</p>
                    <input type="email" id="newEmail" name="newEmail">
                    
                    <label for="newPassword">Password:</label>
                    <p id="passwordError" class="passwordError error">Passwords do not match.</p>
                    <input type="password" id="newPassword" name="newPassword" required>
                    
                    <label for="newPassword-2">Repeat-Password:</label>
                    <input type="password" id="newPassword-2" name="newPassword-2" required>
                    <?php
                        if (isset($_SESSION['error'])) {
                            echo '<p style="color:red; font-size:10px; margin:0;">' . $_SESSION['error'] . '</p>';
                            unset($_SESSION['error']);
                        }
                    ?>
                    <button type="submit" class="singbutt" >Sign Up</button>
                </form>
                <div id="signupError" class="error"></div>
            </div>
        </div>
    </div> 
    <div class="spacer"></div>  
    <script src="JavaScript/Validation.js"></script>
</body>
</html>
<?php 
include "Header_Footer/Footer.php";
?>