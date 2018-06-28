<?php
	$title = "Réinitialiser le mot de passe";
	$path_gallery = "gallery.php";
	$path_sign_in = "../index.php";
	$path_logout = "../controller/logout.php";
	$path_webcam = "../index.php";
	$path_manage_user = "gestion_user_form.php";
?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../public/css/global.css">
	<link rel="stylesheet" type="text/css" href="../public/css/form.css">
	<script type="text/javascript" src="../public/js/forgot_pass.js"></script>
</head>
<body>
	<?php require("header.php"); ?>
	<div id="forgot_form">
		<label for="uname">Username: </label>
		<input type="text" name="uname" id="uname" maxlength="15">
		<br>
		<label for="email">E-mail: </label>
		<input type="email" name="email" id="email">
		<br>
		<input type="submit" name="submit" onclick="request_forgot_pass(check_forgot_pass);" value="OK">
		<p id="message_forgot" class="error_message"><br></p>
	</div>
	<?php require("footer.php"); ?>
</body>
</html>
