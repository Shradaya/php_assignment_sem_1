<?php

class Comment
{
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        if (isset($_POST['comment'])) {
            $this->addNewComment();
        }
    }

    private function addNewComment()
    {
        if (empty($_POST['comment'])) {
            $this->errors[] = 'Empty Comment';
        } else {
            require('config/db.php');
            if (!$db_connection) {
                echo 'An error occurred.\n';
                exit;
              }
            $user_name = $_POST['user_name']; 
            $comment = $_POST['comment'];
            $insert_sql = "INSERT INTO comments (user_name, comment) VALUES ('" . $user_name . "', '" . $comment . "');";
            pg_query($db_connection, $insert_sql);
    }
}
}
