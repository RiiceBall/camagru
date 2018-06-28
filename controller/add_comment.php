<?php
  require_once("../model/Database.class.php");
  require_once("../model/Comment.class.php");
  require_once("../model/Picture.class.php");
  require_once("../public/function/mail.php");
  if (!isset($_SESSION)) {
      session_start();
  }
  if (isset($_SESSION['id']) && isset($_POST['user_id']) && isset($_POST['picture_id']) && isset($_POST['content'])) {
      $db = new Database();
      $comment = new Comment();
      $picture = new Picture();
      if ($picture->check_picture_exist($db, $_POST['picture_id']) != 0) {
          $user_id = $_POST['user_id'];
          $picture_id = $_POST['picture_id'];
          $content = $_POST['content'];
          $comment->add_comment($db, $user_id, $picture_id, $content);
          $cuname = $db->get_value("username", "users", "id", $user_id);
          $puid = $db->get_value("user_id", "picture", "id", $picture_id);
          $receive_mail = $db->get_value("receive_mail", "users", "id", $puid);
          if ($receive_mail == "Y") {
              $puname = $db->get_value("username", "users", "id", $puid);
              $puemail = $db->get_value("email", "users", "id", $puid);
              send_comment_mail($puemail, "From: commentaire@camagru.42.fr", $puname, $cuname, $picture_id);
          }
          $db->close_conn();
          echo $cuname;
      }
  }
  else {
      echo "-1";
  }
