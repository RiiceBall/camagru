<?php
	if (!isset($_SESSION))
		session_start();
?>

<html>
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
</head>
<body>
	<header>
		<nav id="menu">
			<a id="logo" href="<?= $path_gallery ?>">Camagru</a>
			<ul id="normal_menu">
				<li><a href="<?= $path_gallery ?>">Gallery</a></li>
				<?php if (isset($_SESSION['user']) === FALSE) { ?>
				<li><a href="<?= $path_sign_in ?>">Connexion</a></li>
				<?php } else { ?>
				<li><a href="<?= $path_webcam ?>">WebCam</a></li>
				<li><a href="<?= $path_manage_user ?>">Gestion</a></li>
				<li><a href="<?= $path_logout ?>">Déconnecté</a></li>
				<?php } ?>
			</ul>
			<ul id="dropdown_menu">
				<li id="sub_menu"><span>Menu</span>
					<ul>
						<li><a href="<?= $path_gallery ?>">Gallery</a></li>
						<?php if (isset($_SESSION['user']) === FALSE) { ?>
						<li><a href="<?= $path_sign_in ?>">Connexion</a></li>
						<?php } else { ?>
						<li><a href="<?= $path_webcam ?>">WebCam</a></li>
						<li><a href="<?= $path_manage_user ?>">Gestion</a></li>
						<li><a href="<?= $path_logout ?>">Déconnecté</a></li>
						<?php } ?>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
</body>
</html>
