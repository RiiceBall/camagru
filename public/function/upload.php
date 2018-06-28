<?php
    require_once("../../model/Database.class.php");
    require_once("../../model/Picture.class.php");
    require_once("handle_picture.php");
    if (!isset($_SESSION))
        session_start();
    if (!isset($_SESSION['id']))
        echo "2";
    else if (isset($_POST['source']) && isset($_POST['dest']) && isset($_POST['img'])) {
        if (!file_exists("../picture"))
            mkdir("../picture");
        $uploadDir = '../picture/';
        $fileName = $_SESSION['user'] . '_' . $_POST['img'] . '_' . uniqid();
        $dest = get_dest($_POST['dest']);
        $size_dest = getimagesize($dest);
        $size_src = getimagesize($_POST['source']);
        $destination = resize($dest, $size_dest, "temp_dest");
        $source = resize($_POST['source'], $size_src, "temp_source");
        del_temp_file();
        if (empty($source) || empty($destination)) {
            echo "1";
            exit(0);
        }
        imagecopyresampled($destination, $source, 0, 0, 0, 0, 400, 300, 400, 300);
        if (!(file_put_contents($uploadDir . $fileName, " "))) {
            imagedestroy($source);
            imagedestroy($destination);
            echo "1";
        } else {
            imagepng($destination, $uploadDir . $fileName);
            imagedestroy($source);
            imagedestroy($destination);
            $db = new Database();
            $id = $db ->get_value("id", "users", "username", $_SESSION['user']);
            $picture = new Picture();
            $picture->send_picture_to_db($db, $id, $fileName);
            $db->close_conn();
            require("../../view/show_picture.php");
        }
    }
    else {
        echo "1";
    }
