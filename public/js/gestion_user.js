document.write("<script type='text/javascript' src='../public/js/xhr.js'></script>");

function request_manage_uname(callback) {
	var xhr = getXMLHttpRequest();
	var newname = encodeURIComponent(document.getElementById("newname").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 2) {
				alert("Une erreur s'est passée!");
				window.location.href="../index.php";
			}
			else
				callback(xhr.responseText);
		}
	};

	xhr.open("POST", "../controller/gestion_user.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("change_uname=OK&newname=" + newname);
}

function check_manage_uname(data) {
	var message_uname = document.getElementById("message_manage_uname");
	var message_pass = document.getElementById("message_manage_password");
	var message_email = document.getElementById("message_manage_email");
	var message_receive = document.getElementById("message_receive_mail");
	var oldname = document.getElementById("oldname");
	var newname = document.getElementById("newname");
	message_pass.innerHTML = "<br>";
	message_email.innerHTML = "<br>";
	message_receive.innerHTML = "<br>";
	if (data != 1) {
		message_uname.innerHTML = data;
		message_uname.style.color = "red";
	}
	else {
		message_uname.innerHTML = "Votre nom a bien été changé.";
		oldname.value = newname.value;
		message_uname.style.color = "green";
	}
	newname.value = "";
}

function request_manage_password(callback) {
	var xhr = getXMLHttpRequest();
	var oldpass = encodeURIComponent(document.getElementById("oldpass").value);
	var newpass = encodeURIComponent(document.getElementById("newpass").value);
	var cnewpass = encodeURIComponent(document.getElementById("cnewpass").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 2) {
				alert("Une erreur s'est passée!");
				window.location.href="../index.php";
			}
			else
				callback(xhr.responseText);
		}
	};

	xhr.open("POST", "../controller/gestion_user.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("change_pass=OK&oldpass=" + oldpass + "&newpass=" + newpass + "&cnewpass=" + cnewpass);
}

function check_manage_password(data) {
	var message_uname = document.getElementById("message_manage_uname");
	var message_pass = document.getElementById("message_manage_password");
	var message_email = document.getElementById("message_manage_email");
	var message_receive = document.getElementById("message_receive_mail");
	var oldpass = document.getElementById("oldpass");
	var newpass = document.getElementById("newpass");
	var cnewpass = document.getElementById("cnewpass");
	oldpass.value = "";
	newpass.value = "";
	cnewpass.value = "";
	message_uname.innerHTML = "<br>";
	message_email.innerHTML = "<br>";
	message_receive.innerHTML = "<br>";
	if (data != 1) {
		message_pass.innerHTML = data;
		message_pass.style.color = "red";
	}
	else {
		message_pass.innerHTML = "Votre mot de passe a bien été modifié.";
		message_pass.style.color = "green";
	}
}

function request_manage_email(callback) {
	var xhr = getXMLHttpRequest();
	var newmail = encodeURIComponent(document.getElementById("newmail").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 2) {
				alert("Une erreur s'est passée!");
				window.location.href="../index.php";
			}
			else
				callback(xhr.responseText);
		}
	};

	xhr.open("POST", "../controller/gestion_user.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("change_mail=OK&newmail=" + newmail);
}

function check_manage_email(data) {
	var message_uname = document.getElementById("message_manage_uname");
	var message_pass = document.getElementById("message_manage_password");
	var message_email = document.getElementById("message_manage_email");
	var message_receive = document.getElementById("message_receive_mail");
	var oldmail = document.getElementById("oldmail");
	var newmail = document.getElementById("newmail");
	message_uname.innerHTML = "<br>";
	message_pass.innerHTML = "<br>";
	message_receive.innerHTML = "<br>";
	if (data != 1) {
		message_email.innerHTML = data;
		message_email.style.color = "red";
	}
	else {
		message_email.innerHTML = "Votre e-mail a bien été changé. Vous devez réactiver votre compte avec le mail qui se trouve sur la nouvelle adresse.";
		oldmail.value = newmail.value;
		message_email.style.color = "green";
	}
	newmail.value = "";
}

function request_receive_mail(callback) {
	var xhr = getXMLHttpRequest();
	var receiveY = document.getElementById("receiveY");
	var receiveN = document.getElementById("receiveN");

	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 2) {
				alert("Une erreur s'est passée!");
				window.location.href="../index.php";
			}
			else
				callback(xhr.responseText);
		}
	};
	xhr.open("POST", "../controller/gestion_user.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	if (receiveY.checked == true)
		xhr.send("change_receive=OK&receive=Y");
	else
		xhr.send("change_receive=OK&receive=N");
}

function check_receive_mail(data) {
	var message_receive = document.getElementById("message_receive_mail");
	var message_uname = document.getElementById("message_manage_uname");
	var message_pass = document.getElementById("message_manage_password");
	var message_email = document.getElementById("message_manage_email");

	message_uname.innerHTML = "<br>";
	message_pass.innerHTML = "<br>";
	message_email.innerHTML = "<br>";
	message_receive.innerHTML = data;
}
