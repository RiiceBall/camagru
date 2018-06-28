<?php
  require_once("../model/Database.class.php");
  require_once("../model/Picture.class.php");
  try {
      if (!isset($_SESSION)) {
          session_start();
      }
      if (!isset($_SESSION['id']) || !isset($_POST['user_id']) || !isset($_POST['picture_id'])) {
          throw new Exception("0");
      }
      $db = new Database();
      $picture = new Picture();
      if ($picture->check_picture_exist($db, $_POST['picture_id']) == 0) {
          throw new Exception("0");
      }
      $user_id = $_POST['user_id'];
      $picture_id = $_POST['picture_id'];
      $like_id = $picture->check_like($db, $user_id, $picture_id);
      if ($like_id != 0) {
          $picture->del_like_picture($db, $like_id);
      }
      else {
          $picture->add_like_picture($db, $user_id, $picture_id);
      }
      $db->close_conn();
      echo $picture_id;
  } catch (Exception $e) {
      echo $e->getMessage();
  }
