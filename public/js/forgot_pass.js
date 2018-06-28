document.write("<script type='text/javascript' src='../public/js/xhr.js'></script>");

function request_forgot_pass(callback) {
	var xhr = getXMLHttpRequest();
	var username = encodeURIComponent(document.getElementById("uname").value);
	var email = encodeURIComponent(document.getElementById("email").value);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 0) {
				alert("Une erreur s'est passée!");
				window.location.href = "../index.php";
			}
			else
				callback(xhr.responseText);
		}
	};
	xhr.open("POST", "../controller/forgot.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("submit=OK&username=" + username + "&email=" + email);
}

function check_forgot_pass(data) {
	var message = document.getElementById("message_forgot");
	var username = document.getElementById("uname");
	var email = document.getElementById("email");
	username.value = "";
	email.value = "";
	if (data != 1) {
		message.innerHTML = data;
		message.style.color = "red";
	}
	else {
		message.innerHTML = "Un mail de réinitialisation de mot de passe a été envoyé sur votre mail.";
		message.style.color = "green";
	}
}
