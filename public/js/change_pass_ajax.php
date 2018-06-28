<script type="text/javascript">

function request_change_password(callback) {
	var xhr = getXMLHttpRequest();
	var newpass = encodeURIComponent(document.getElementById("newpass").value);
	var cnewpass = encodeURIComponent(document.getElementById("cnewpass").value);
	var username = "<?= $username ?>";
	var cle = "<?= $cle ?>";
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 0) {
				alert("Une erreur s'est passée!");
				window.location.href = "change_pass_form.php?username=" + username + "&cle=" + cle;
			}
			else
				callback(xhr.responseText);
		}
	};
	xhr.open("POST", "<?= $path_change_pass ?>", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("submit=OK&username=" + username + "&cle=" + cle + "&newpass=" + newpass + "&cnewpass=" + cnewpass);
}

function check_change_password(data) {
	var message = document.getElementById("message_change_pass");
	var newpass = document.getElementById("newpass");
	var cnewpass = document.getElementById("cnewpass");
	newpass.value = "";
	cnewpass.value = "";
	if (data != 1) {
		message.innerHTML = data;
		message.style.color = "red";
	}
	else {
		alert("Votre mot de passe a bien été modifié.");
		window.location.href="../index.php";
	}
}


</script>
