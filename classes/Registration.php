<?php

class Registration
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    private function registerNewUser()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Empty Username";
        } elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['user_password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
            $this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
            $this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
        } elseif (empty($_POST['user_email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['user_email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (!empty($_POST['user_name'])
            && strlen($_POST['user_name']) <= 64
            && strlen($_POST['user_name']) >= 2
            && preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
            && !empty($_POST['user_email'])
            && strlen($_POST['user_email']) <= 64
            && filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['user_password_new'])
            && !empty($_POST['user_password_repeat'])
            && ($_POST['user_password_new'] === $_POST['user_password_repeat'])
        ) {
            require("config/db.php");
            if (!$db_connection) {
                echo "An error occurred.\n";
                exit;
              }
            $user_name = $_POST['user_name']; 
            $user_email = $_POST['user_email'];

            $user_password = $_POST['user_password_new'];

            $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

            $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
            $query_check_user_name = pg_query($db_connection, $sql);

            if (pg_num_rows($query_check_user_name) == 1) {
                $this->errors[] = "Sorry, that username / email address is already taken.";
            } else {
                $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                        VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                $query_new_user_insert = pg_query($db_connection, $sql);

                if ($query_new_user_insert) {
                    $this->messages[] = "Your account has been created successfully. You can now log in.";
                } else {
                    $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                }
            }
    }
}
}