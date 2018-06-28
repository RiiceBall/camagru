function request_sign_in(callback) {
	var xhr = getXMLHttpRequest();
	var username = encodeURIComponent(document.getElementById("suname").value);
	var pass = encodeURIComponent(document.getElementById("spasswd").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 0) {
				alert("Une erreur s'est passée!");
				window.location.href = "index.php";
			}
			else
				callback(xhr.responseText, username);
		}
	};
	xhr.open("POST", "controller/check_info.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("submit=sign_in&suname=" + username + "&spasswd=" + pass);
}

function check_sign_in(data, username) {
	var err_reg = document.getElementById("error_register");
	err_reg.innerHTML = "";
	if (data != 1) {
		var err = document.getElementById("error_sign_in");
		var pass = document.getElementById("spasswd");
		err.innerHTML = data;
		err.style.color = "red";
		pass.value = "";
	}
	else {
		alert("Bienvenue " + username + "!");
		window.location.href="index.php";
	}
}

function request_register(callback) {
	var xhr = getXMLHttpRequest();
	var username = encodeURIComponent(document.getElementById("runame").value);
	var pass = encodeURIComponent(document.getElementById("rpasswd").value);
	var cpass = encodeURIComponent(document.getElementById("rpasswd2").value);
	var email = encodeURIComponent(document.getElementById("email").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 0) {
				alert("Une erreur s'est passée!");
				window.location.href = "index.php";
			}
			else
				callback(xhr.responseText);
		}
	};
	xhr.open("POST", "controller/check_info.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("submit=register&runame=" + username + "&rpasswd=" + pass + "&rpasswd2=" + cpass + "&email=" + email);
}

function check_register(data) {
	var err_sign = document.getElementById("error_sign_in");
	var err = document.getElementById("error_register");
	var pass = document.getElementById("rpasswd");
	var cpass = document.getElementById("rpasswd2");
	err_sign.innerHTML = "";
	pass.value = "";
	cpass.value = "";
	if (data != 1) {
		err.innerHTML = data;
		err.style.color = "red";
	}
	else {
		var username = document.getElementById("runame");
		var email = document.getElementById("email");
		username.value = "";
		email.value = "";
		err.innerHTML = "Votre compte a été avec succes. Un mail de confirmation a été envoyé sur votre mail.";
		err.style.color = "green";
	}
}
