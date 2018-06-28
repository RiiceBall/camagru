<?php
	function send_verif_mail($email, $header, $username, $cle) {
		$message = "Bienvenue sur le site Camagru de lezhang,

		Pour activer votre compte, veuillez cliquer sur le lien ci dessous
		ou copier/coller dans votre navigateur internet.

		http://localhost:8080/camagru/controller/activation.php?username=" . $username . "&cle=" . $cle . "

		Ceci est un mail automatique, merci de ne pas y répondre.";
		mail($email, "Activer votre compte", $message, $header);
	}

	function send_forgot_mail($email, $header, $username, $cle) {
		$message = "Bonjour,

		Pour changer le mot de passe, veuillez cliquer sur le lien ci dessous
		ou copier/coller dans votre navigateur internet.

		http://localhost:8080/camagru/view/change_pass_form.php?username=" . $username . "&cle=" . $cle . "

		Ceci est un mail automatique, merci de ne pas y répondre.";
		mail($email, "Changer le mot de passe", $message, $header);
	}

	function send_comment_mail($email, $header, $puname, $cuname, $picture_id) {
		$message = "Bourjour " . $puname . ",

		" . $cuname . " a commenté votre photo!
		Cliquez sur le lien suivant pour voir le commentaire!

		http://localhost:8080/camagru/view/commentaire.php?picture_id=" . $picture_id . "

		Ceci est un mail automatique, merci de ne pas y répondre.";
		mail($email, "Votre photo a été commenté", $message, $header);
	}
