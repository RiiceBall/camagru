<?php
	if (!isset($_SESSION))
	session_start();
	require_once("../model/Database.class.php");
	require_once("../model/Picture.class.php");
	$title = "Commentaire";
	$path_gallery = "gallery.php";
	$path_sign_in = "../index.php";
	$path_logout = "../controller/logout.php";
	$path_webcam = "../index.php";
	$path_manage_user = "gestion_user_form.php";
	$path_check_info = "../controller/check_info.php";
	$path_forgot = "forgot_form.php";
	$path_user_php = "../public/js/user_ajax.php";
	$path_index = "../index.php";
	if (isset($_GET['picture_id']) && !empty($_GET['picture_id']) && ctype_digit($_GET['picture_id'])) {
		$picture_id = intval($_GET['picture_id']);
	}
	else {
		?>
		<script>alert('Une erreur s\'est produit!');
		window.location.href="<?= $path_gallery ?>"</script>;
		<?php
	}
	$db = new Database();
	$check = new Picture();
	if ($check->check_picture_exist($db, $picture_id) == 0) {
		?>
		<script>alert('Une erreur s\'est produit!');
		window.location.href="<?= $path_gallery ?>"</script>;
		<?php
	}
	$picture_path = "../public/picture/" . $db->get_value("picture_path", "picture", "id", $picture_id);
	$puid = $db->get_value("user_id", "picture", "id", $picture_id);
	$user_id = 0;
	$user_like = 0;
	if (isset($_SESSION['id'])) {
		$user_id = $_SESSION['id'];
		$db->set_sql("SELECT `id` FROM `like` WHERE `user_id`=? AND `picture_id`=?");
		$db->exec_sql(array($user_id, $picture_id));
		$user_like = count($db->get_result());
	}
	$db->close_conn();
?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../public/css/global.css">
		<link rel="stylesheet" type="text/css" href="../public/css/comment.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="../public/js/xhr.js"></script>
		<script type="text/javascript" src="../public/js/comment.js"></script>
		<script type="text/javascript" src="../public/js/like.js"></script>
		<script type="text/javascript" src="../public/js/delete.js"></script>
	</head>
	<body>
		<?php require("header.php"); ?>
		<div id="center_commentaire">
			<img id="comment_picture" src="<?= $picture_path ?>" alt="picture" style="width:400px;height:300px;">
			<br>
			<div id="like_zone">
				<span>
				<?php if (!isset($_SESSION['id'])) { ?>
					<img id="icone_like" src="../public/img/like_yet.png" alt="coeur_gris">
				<?php } else if ($user_like) { ?>
					<input id="icone_like" type="image" src="../public/img/like.png" alt="coeur_rouge" onclick="request_like_picture(check_like_picture, <?= $user_id ?>, <?= $picture_id ?>);">
				<?php } else { ?>
					<input id="icone_like" type="image" src="../public/img/like_yet.png" alt="coeur_rouge" onclick="request_like_picture(check_like_picture, <?= $user_id ?>, <?= $picture_id ?>);">
				<?php } ?>
				</span>
				<span id="<?= 'nb_like' . $picture_id ?>"><script>request_get_like(check_get_like, <?= $picture_id ?>);</script></span>
				<?php if ($user_id == $puid) { ?>
					<button id="btn_delete" class="fa fa-trash" type="button" name="delete" onclick="request_delete_picture(check_delete_picture, <?= $picture_id ?>);"></button>
				<?php } ?>
			</div>

			<?php
			if (isset($_SESSION['id'])) { ?>
				<div id="picture_commentaire">
					<textarea id="comment_text" name="comment_text"></textarea>
					<button id="send_comment" onclick="request_comment_picture(<?= $user_id ?>, <?= $picture_id ?>)">Envoyer</button>
				</div>
			<?php } ?>
			<br>
			<br>
			<div id="zone_commentaire">
				<?php
					require("show_comment.php");
				?>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>
