<?php
	require_once("../model/Database.class.php");
	require_once("../public/function/mail.php");

	function username_s_email($db, $username, $email) {
		$db->set_sql("SELECT * FROM `users` WHERE `username`=? AND `email`=?");
		$db->exec_sql(array($username, $email));
		$ret = $db->get_result();
		$ret = count($ret);
		return ($ret);
	}

	try {
		if (!isset($_POST['username']) || !isset($_POST['email']))
			throw new Exception("0");
		$username = $_POST['username'];
		$email = $_POST['email'];
		$db = new Database();
		if (username_s_email($db, $username, $email) === 0) {
			$db->close_conn();
			throw new Exception("Le nom ou le mail incorrect.");
		}
		else {
			$cle = $db->get_value("cle", "users", "username", $username);
			send_forgot_mail($email, "From: forgot_password@camagru.42.fr", $username, $cle);
			$db->close_conn();
			throw new Exception("1");
		}
	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
