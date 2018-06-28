<?php
	if (!isset($_SESSION))
		session_start();
	$title = "Camagru";
	$path_gallery = "view/gallery.php";
	$path_sign_in = "index.php";
	$path_logout = "controller/logout.php";
	$path_webcam = "index.php";
	$path_manage_user = "view/gestion_user_form.php";
	$path_check_info = "controller/check_info.php";
	$path_forgot = "view/forgot_form.php";
	$path_user_php = "public/js/user.js";
	$path_index = "index.php";
?>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="public/css/global.css">
	<link rel="stylesheet" type="text/css" href="public/css/login.css">
	<link rel="stylesheet" type="text/css" href="public/css/webcam.css">
	<link rel="stylesheet" type="text/css" href="public/css/form.css">
	<script type="text/javascript" src="public/js/xhr.js"></script>
	<script type="text/javascript" src="public/js/delete.js"></script>
</head>
<body>
	<?php require("view/header.php"); ?>

	<?php
		if (!isset($_SESSION['user']))
			require("view/login_form.php");
		else {
			require_once("model/Database.class.php");
			require_once("model/Picture.class.php");
			require("view/webcam.php");
		}
	?>
	<?php require("view/footer.php"); ?>
</body>
</html>
