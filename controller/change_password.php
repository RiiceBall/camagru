<?php
	if (!isset($_SESSION))
		session_start();
	require_once("../model/User.class.php");
	require_once("../model/Database.class.php");
	require_once("../public/function/check_form_size.php");

	try {
		if (!isset($_POST['username']) || !isset($_POST['cle']) ||
		!isset($_POST['newpass']) || !isset($_POST['cnewpass'])) {
			throw new Exception("0");
		}
		$db = new Database();
		$username = $_POST['username'];
		$cle = $_POST['cle'];
		$user = new User($username);
		if (isset($_POST['submit'])) {
			check_password_size($_POST['newpass']);
			check_password_size($_POST['cnewpass']);
			$user->set_password(hash("whirlpool", $_POST['newpass']));
			$user->set_cpassword(hash("whirlpool", $_POST['cnewpass']));
			$newpass = $user->get_password();
			$cnewpass = $user->get_cpassword();
			if ($user->check_two_mdp($newpass, $cnewpass) === 0) {
				$db->close_conn();
				throw new Exception("Les deux nouveaux mot de passe sont différents.");
			}
			else {
				$cledb = $db->get_value("cle", "users", "username", $username);
				if ($cle !== $cledb) {
					$db->close_conn();
					throw new Exception("Erreur ! Le mot de passe n'a pas été changé ! Demandez un nouveau mail pour changer le mot de passe !");
				}
				$db->set_sql("UPDATE `users` SET `password`=? WHERE `username`=?");
				$db->exec_sql(array($newpass, $username));
				$db->new_cle($username);
				$db->close_conn();
				throw new Exception("1");
			}
		}
	}
	catch (Exception $e) {
		echo $e->getMessage();
	}
