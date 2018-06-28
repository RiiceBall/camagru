<?php
    require_once("../model/Database.class.php");
    require_once("../model/Picture.class.php");
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['id']) && isset($_POST['picture_id'])) {
        $db = new Database();
        $picture = new Picture();
        $picture_id = $_POST['picture_id'];
        $picture_name = $db->get_value("picture_path", "picture", "id", $picture_id);
        $picture_path = "../public/picture/" . $picture_name;
        $db->set_sql("DELETE FROM `picture` WHERE `id`=?");
        $db->exec_sql(array($picture_id));
        $db->set_sql("DELETE FROM `comment` WHERE `picture_id`=?");
        $db->exec_sql(array($picture_id));
        $db->set_sql("DELETE FROM `like` WHERE `picture_id`=?");
        $db->exec_sql(array($picture_id));
        $db->close_conn();
        unlink($picture_path);
        if (!count(glob("../public/picture/*")))
            rmdir("../public/picture");
        echo "1";
    }
    else {
        echo "";
    }
