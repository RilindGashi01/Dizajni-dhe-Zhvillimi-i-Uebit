<?php
class SignupFormValidator {
    private $username;
    private $email;
    private $password;
    private $confirmPassword;
    private $errors = [];

    public function __construct($username, $email, $password, $confirmPassword) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function validate() {
        if (strlen($this->username) < 6) {
            $this->errors['usernameError'] = "Username must be at least 6 characters long.";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['emailError'] = "Email must be in the correct format.";
        }

        if (strlen($this->password) < 8 || $this->password !== $this->confirmPassword) {
            $this->errors['passwordError'] = "Passwords do not match or must be at least 8 characters long.";
        }

        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }
}

?>