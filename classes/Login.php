<?php

class Login
{
    // private $db_connection = null;
    public $errors = array();
    public $messages = array();
    public function __construct()
    {
        session_start();

        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        if (isset($_GET["contact"])) {
            $this->contactPage();
        }
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    private function dologinWithPostData()
    {
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            require("config/db.php");
            if (!$db_connection) {
                echo "An error occurred.\n";
                exit;
              }
            $user_name = $_POST['user_name'];

            $sql = "SELECT user_name, user_email, user_password_hash
                    FROM users
                    WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";

            $result_of_login_check = pg_query($db_connection, $sql);

            if (pg_num_rows($result_of_login_check) == 1) {

                $result_row = pg_fetch_object($result_of_login_check);
                if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {
                    $_SESSION['user_name'] = $result_row->user_name;
                    $_SESSION['user_email'] = $result_row->user_email;
                    $_SESSION['user_login_status'] = 1;
                } else {
                    $this->errors[] = "Wrong password. Try again.";
                }
            } else {
                $this->errors[] = "This user does not exist.";
            }
        }
    }


    public function doLogout()
    {
        $_SESSION = array();
        session_destroy();
        $this->messages[] = "You have been logged out.";

    }

    public function contactPage()
    {
        include("views/contact.php");
    }

    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        return false;
    }
}
