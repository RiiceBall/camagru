<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../public/css/global.css">
	<link rel="stylesheet" type="text/css" href="../public/css/form.css">
	<script type="text/javascript" src="../public/js/xhr.js"></script>
</head>
<body>
	<?php
		if (isset($_GET['username']) && isset($_GET['cle'])) {
			$username = $_GET['username'];
			$cle = $_GET['cle'];
		}
		else {
			echo '<script> alert("Une erreur s\'est passée! Redirection vers la page d\'accueil!");
			window.location.href="../index.php";</script>';
			exit(0);
		}
		$path_change_pass = "../controller/change_password.php?username=$username&cle=$cle";
		require("../public/js/change_pass_ajax.php")
	?>
	<div id="change_pass">
		<label for="newpass">New password: </label>
		<input type="password" name="newpass" id="newpass" maxlength="16">
		<br>
		<label for="cnewpass">Confirm password: </label>
		<input type="password" name="cnewpass" id="cnewpass">
		<br>
		<input type="submit" name="submit" onclick="request_change_password(check_change_password);" value="OK">
		<p id="message_change_pass" class="error_message"><br></p>
	</div>
</body>
</html>
