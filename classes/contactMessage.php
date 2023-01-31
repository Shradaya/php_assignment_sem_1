<?php

class Contact
{
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        if (isset($_POST['message'])) {
            $this->messageContact();
        }
    }

    private function messageContact()
    {
        if (empty($_POST['message'])) {
            $this->errors[] = 'Empty Comment';
        } else {
            require('config/db.php');
            if (!$db_connection) {
                echo 'An error occurred.\n';
                exit;
              }
            $user_name = $_POST['user_name']; 
            $message = $_POST['message'];
            $insert_sql = "INSERT INTO messages (user_name, message) VALUES ('" . $user_name . "', '" . $message . "');";
            pg_query($db_connection, $insert_sql);
    }
}
}
