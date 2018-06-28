<?php
    if (!isset($_SESSION))
        session_start();
    if (isset($_SESSION['id'])) {
        if (file_exists("../public/user_upload" . $_SESSION['id'])) {
            $files = glob("../public/user_upload" . $_SESSION['id'] . "/*");
            foreach ($files as $value)
                unlink($value);
            rmdir("../public/user_upload" . $_SESSION['id']);
        }
        $_SESSION = array();
        session_destroy();
    }
    header("Location: ../index.php");
