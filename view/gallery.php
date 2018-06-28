<?php
	if (!isset($_SESSION))
		session_start();
	require_once("../model/Database.class.php");
	require_once("../model/Picture.class.php");
	$title = "Gallery";
	$path_gallery = "gallery.php";
	$path_sign_in = "../index.php";
	$path_logout = "../controller/logout.php";
	$path_webcam = "../index.php";
	$path_manage_user = "gestion_user_form.php";
	$path_check_info = "../controller/check_info.php";
	$path_forgot = "forgot_form.php";
	$path_user_php = "../public/js/user_ajax.php";
	$path_index = "../index.php";
?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../public/css/global.css">
	<link rel="stylesheet" type="text/css" href="../public/css/gallery.css">
	<script type="text/javascript" src="../public/js/xhr.js"></script>
	<script type="text/javascript" src="../public/js/gallery.js"></script>
</head>
<body>
	<?php require("header.php"); ?>
	<div id="gallery"><script>request_get_gallery_picture(0);</script></div>
	<?php require("footer.php"); ?>
</body>
</html>
