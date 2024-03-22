const registerBtn = document.querySelector('.regist');
registerBtn.addEventListener("click",()=>{
    window.location.href = 'Sign-Up.php';
})

function validateForm() {
    var errors = false;
    var errorMessages = document.getElementsByClassName("error");
    for (var i = 0; i < errorMessages.length; i++) {
        errorMessages[i].style.display = "none";
    }

    var usernameInput = document.getElementById("UsernameofSingUp");
    var username = usernameInput.value;
    if (username.length < 6) {
        document.getElementById("usernameError").style.display = "block";
        errors = true;
    }

    var emailInput = document.getElementById("newEmail");
    var email = emailInput.value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").style.display = "block";
        errors = true;
    }

    var passwordInput = document.getElementById("newPassword");
    var password = passwordInput.value;
    var confirmPasswordInput = document.getElementById("newPassword-2");
    var confirmPassword = confirmPasswordInput.value;
    if (password.length < 8 || password !== confirmPassword) {
        document.getElementById("passwordError").style.display = "block";
        errors = true;
    }

    if (errors) {
        return false;
    }

    return true;
}