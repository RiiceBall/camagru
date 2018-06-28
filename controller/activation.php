<html>
<head>
	<meta charset="UTF-8">
	<title>Activation</title>
	<link rel="stylesheet" type="text/css" href="../public/css/global.css">
</head>
<body>

<?php
    require_once("../model/Database.class.php");
	if (!isset($_GET['username']) || !isset($_GET['cle']) || empty($_GET['username']) || empty($_GET['cle'])) {
		echo "Une erreur s'est passée! Ouvrez la page avec le lien reçu par mail!"; ?>
		<a href="../index.php">Cliquez ici pour acceder au site!</a><?php
		exit(0);
	}

	$username = $_GET['username'];
	$cle = $_GET['cle'];
	$db = new Database();
	$db->set_sql("SELECT `cle`, `confirm` FROM `users` WHERE `username`=?");
	$db->exec_sql(array($username));
	$ret = $db->get_result();
	$ret = $ret[0];
	$cledb = $ret['cle'];
	$confirm = $ret['confirm'];
	if ($confirm === 'Y') {
		echo "Votre compte est déjà actif !";
	}
	else {
		if ($cle === $cledb) {
			$db->set_sql("UPDATE `users` SET `confirm`='Y' WHERE `username`=?");
			$db->exec_sql(array($username));
			$db->new_cle($username);
			echo "Votre compte a bien été activé !";
		}
		else {
			echo "Erreur ! La cle n'est pas le bon ! Votre compte ne peux être activé...";
		}
	}
?>
<a href="../index.php"> Cliquez ici pour acceder au site!</a>

</body>
</html>
