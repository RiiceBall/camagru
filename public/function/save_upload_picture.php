<?php
    if (!isset($_SESSION))
        session_start();
    if (isset($_SESSION['id'])) {
        if (!empty($_FILES)) {
            if (!file_exists("../user_upload" . $_SESSION['id']))
                mkdir("../user_upload" . $_SESSION['id']);
            if (!(move_uploaded_file($_FILES['upload']["tmp_name"], "../user_upload" . $_SESSION['id'] . "/" . $_FILES['upload']["name"]))) {
                echo "1";
            }
            echo "";
        }
    }
    else {
        echo "2";
    }
