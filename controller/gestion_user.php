<?php
	require_once("../model/User.class.php");
	require_once("../model/Database.class.php");
	require_once("../public/function/mail.php");
	require_once("../public/function/check_form_size.php");
	if (!isset($_SESSION))
		session_start();
	try {
		if (!isset($_SESSION['user']))
			throw new Exception("2");
		$db = new Database();
		$user = new User($_SESSION['user']);
		$username = $user->get_username();
		if (isset($_POST['change_uname'])) {
			if (!isset($_POST['newname']))
				throw new Exception("2");
			check_username_size($_POST['newname']);
			$user->set_username($_POST['newname']);
			if ($user->check_username($db) === 1) {
				$db->close_conn();
				throw new Exception("Ce nom est déjà utilisée.");
			}
			else {
				$newname = $user->get_username();
				$db->set_sql("UPDATE `users` SET `username`=? WHERE `username`=?");
				$db->exec_sql(array($newname, $username));
				$_SESSION['user'] = $newname;
				$db->close_conn();
				throw new Exception("1");
			}
		}
		else if (isset($_POST['change_pass'])) {
			if (!isset($_POST['oldpass']) || !isset($_POST['newpass']) || !isset($_POST['cnewpass']))
				throw new Exception("2");
			check_password_size($_POST['oldpass']);
			check_password_size($_POST['newpass']);
			check_password_size($_POST['cnewpass']);
			$user->set_password(hash("whirlpool", $_POST['oldpass']));
			if ($user->check_mdp($db) === 0)
			{
				$db->close_conn();
				throw new Exception("L'ancien mot de passe incorrect.");
			}
			$user->set_password(hash("whirlpool", $_POST['newpass']));
			$user->set_cpassword(hash("whirlpool", $_POST['cnewpass']));
			$newpass = $user->get_password();
			$cnewpass = $user->get_cpassword();
			if ($user->check_two_mdp($newpass, $cnewpass) === 0) {
				$db->close_conn();
				throw new Exception("Les deux mot de passe sont différents.");
			}
			else {
				$db->set_sql("UPDATE `users` SET `password`=? WHERE `username`=?");
				$db->exec_sql(array($newpass, $username));
				$db->close_conn();
				throw new Exception("1");
			}
		}
		else if (isset($_POST['change_mail'])) {
			if (!isset($_POST['newmail']))
				throw new Exception("2");
			check_email_valid($_POST['newmail']);
			$user->set_mail($_POST['newmail']);
			if ($user->check_mail($db) === 1) {
				$db->close_conn();
				throw new Exception("Cette adresse email est déjà utilisée.");
			}
			else {
				$newmail = $user->get_mail();
				$cle = $db->get_value("cle", "users", "username", $username);
				$db->set_sql("UPDATE `users` SET `email`=? WHERE `username`=?");
				$db->exec_sql(array($newmail, $username));
				$db->set_sql("UPDATE `users` SET `confirm`='N' WHERE `username`=?");
				$db->exec_sql(array($username));
				$_SESSION['email'] = $newmail;
				send_verif_mail($newmail, "From: inscription@camagru.42.fr", $username, $cle);
				$db->close_conn();
				throw new Exception("1");
			}
		}
		else if (isset($_POST['change_receive'])) {
			if (!isset($_POST['receive']))
				throw new Exception("2");
			if ($_POST['receive'] == 'Y') {
				if ($_SESSION['receive'] != 'Y') {
					$db->set_sql("UPDATE `users` SET `receive_mail`='Y' WHERE `username`=?");
					$db->exec_sql(array($username));
					$_SESSION['receive'] = 'Y';
					throw new Exception("Vous allez recevoir des notifications à partir de maintenant!");
				}
			}
			else if ($_POST['receive'] == 'N') {
				if ($_SESSION['receive'] != 'N') {
					$db->set_sql("UPDATE `users` SET `receive_mail`='N' WHERE `username`=?");
					$db->exec_sql(array($username));
					$_SESSION['receive'] = 'N';
					throw new Exception("Vous n'allez plus recevoir de notifications à partie de maintenant!");
				}
			}
		}
		else
			throw new Exception("2");
	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
