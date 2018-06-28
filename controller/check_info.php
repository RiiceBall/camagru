<?php
	if (!isset($_SESSION))
		session_start();
	require_once("../model/User.class.php");
	require_once("../model/Check_info.class.php");
	require_once("../model/Database.class.php");
	require_once("../public/function/mail.php");
	require_once("../public/function/check_form_size.php");

	if (!isset($_POST['submit'])) {
		echo "0";
	}
	else if ($_POST['submit'] === "sign_in")
	{
		try {
			if (!isset($_POST['suname']) || !isset($_POST['spasswd']) || isset($_SESSION['id'])) {
				throw new Exception("0");
			}
			$check = new Check_info($_POST['suname'], $_POST['spasswd']);
			$db = new Database();
			check_username_size($_POST['suname']);
			check_password_size($_POST['spasswd']);
			$check->verif_username($db, 0);
			$check->verif_mdp_confirm($db);
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}

	}
	else if ($_POST['submit'] === "register")
	{
		try {
			if (!isset($_POST['runame']) || !isset($_POST['rpasswd']) ||
				!isset($_POST['rpasswd2']) || !isset($_POST['email'])) {
				throw new Exception("0");
			}
			$check = new Check_info($_POST['runame'], $_POST['rpasswd']);
			$username = $check->get_username();
			check_username_size($username);
			check_password_size($_POST['rpasswd']);
			check_password_size($_POST['rpasswd2']);
			check_email_valid($_POST['email']);
			$check->get_register_info($_POST['rpasswd2'], $_POST['email']);
			$db = new Database();
			$check->verif_username($db, 1);
			if ($check->check_two_mdp($check->get_password(), $check->get_cpassword()) === 0) {
				$db->close_conn();
				throw new Exception("Les deux mots de passes sont differents.");
			}
			$check->verif_mail($db);
			$check->register($db);
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}
