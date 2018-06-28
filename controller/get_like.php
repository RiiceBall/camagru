<?php
  require_once("../model/Database.class.php");
  require_once("../model/Picture.class.php");
  try {
      if (!isset($_POST['picture_id'])) {
          throw new Exception("-1");
      }
      $db = new Database();
      $picture = new Picture();
      $nb_like = $picture->get_picture_like($db, $_POST['picture_id']);
      $db->close_conn();
      echo $nb_like;
  } catch (Exception $e) {
      echo $e->getMessage();
  }
