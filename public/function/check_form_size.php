<?php

function check_username_size($username) {
	if (strlen($username) == 0)
		throw new Exception("Le nom ne doit pas être vide!");
	else if (strlen($username) > 15)
		throw new Exception("Le nom ne doit pas dépasser 15 caractères!");
	$pattern = "#^[a-z0-9]+$#i";
	if (!preg_match($pattern , $username)) {
		throw new Exception("Le nom doit contenir que des lettres et des chiffres.");
	}
}

function check_password_size($pass) {
	if (strlen($pass) < 6)
		throw new Exception("Le mot de passe doit avoir au minimum 6 caractères!");
	else if (strlen($pass) > 16)
		throw new Exception("Le mot de passe ne doit pas dépasser 16 caractères!");
}

function check_email_valid($email) {
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		throw new Exception("Le format d'email n'est pas bon!");
}
