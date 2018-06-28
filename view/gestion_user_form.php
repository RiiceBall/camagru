<?php
	if (!isset($_SESSION))
		session_start();
	if (!isset($_SESSION['user'])) {
		echo '<script> alert("Une erreur s\'est passée!");
		window.location.href="../index.php";</script>';
		exit(0);
	}
	$title = "Espace personnel";
	$path_gallery = "gallery.php";
	$path_logout = "../controller/logout.php";
	$path_webcam = "../index.php";
	$path_manage_user = "gestion_user_form.php";
?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../public/css/global.css">
	<link rel="stylesheet" type="text/css" href="../public/css/manage.css">
	<script type="text/javascript" src="../public/js/gestion_user.js"></script>
</head>
<body>
	<?php require("header.php"); ?>
	<div id="manageu">
		<div>
				<h2>Username</h2>
				<label for="oldname">Username actuelle: </label>
				<input class="readonly" type="text" name="oldname" id="oldname" readonly="readonly" value="<?=$_SESSION['user'];?>">
				<br>
				<label for="newname">Nouveau username: </label>
				<input type="text" name="newname" id="newname" maxlength="15">
				<br>
				<input type="submit" name="change_uname" onclick="request_manage_uname(check_manage_uname);" value="OK">
				<br>
				<p id="message_manage_uname" class="error_message message_manage"><br></p>
				<hr>
		</div>
		<div>
				<h2>Password</h2>
				<label for="oldpass">Old password: </label>
				<input type="password" name="oldpass" id="oldpass" maxlength="16">
				<br>
				<label for="newpass">New password: </label>
				<input type="password" name="newpass" id="newpass" maxlength="16">
				<br>
				<label for="cnewpass">Confirm password: </label>
				<input type="password" name="cnewpass" id="cnewpass" maxlength="16">
				<br>
				<input type="submit" name="change_pass" onclick="request_manage_password(check_manage_password);" value="OK">
				<p id="message_manage_password" class="error_message message_manage"><br></p>
				<hr>
		</div>
		<div>
				<h2>E-mail</h2>
				<label for="olamail">E-mail actuelle: </label>
				<input class="readonly" type="email" name="oldmail" id="oldmail" readonly="readonly" value="<?=$_SESSION['email'];?>">
				<br>
				<label for="newmail">Nouveau e-mail: </label>
				<input type="email" name="newmail" id="newmail">
				<br>
				<input type="submit" name="change_mail" onclick="request_manage_email(check_manage_email);" value="OK">
				<p id="message_manage_email" class="error_message message_manage"><br></p>
				<hr>
		</div>
		<div>
				<h2>Recevoir les mails de notifications</h2>
				<p>Vodivez-vous recevoir les mails de notifications?</p>
				<input type="radio" name="receive" id="receiveY" onclick="request_receive_mail(check_receive_mail);" value="oui">
				<label for="receiveY">Oui</label>
				<input type="radio" name="receive" id="receiveN" onclick="request_receive_mail(check_receive_mail);" value="non">
				<label for="receiveN">Non</label>
				<?php if ($_SESSION['receive'] == 'Y') { ?>
					<script>
						var radioY = document.getElementById('receiveY');
						radioY.checked = true;
					</script>
				<?php } else { ?>
					<script>
						var radioN = document.getElementById('receiveN');
						radioN.checked = true;
					</script>
				<?php } ?>
				<p id="message_receive_mail" class="error_message"><br></p>
		</div>
	</div>
	<?php require("footer.php"); ?>
</body>
</html>
