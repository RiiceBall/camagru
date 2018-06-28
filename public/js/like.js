function request_like_picture(callback, user_id, picture_id) {
	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == 0) {
				alert("Une erreur s'est passée!");
				window.location.href = "gallery.php";
			}
			else
				callback(xhr.responseText);
		}
	};
	xhr.open("POST", "../controller/like_picture.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("user_id=" + user_id + "&picture_id=" + picture_id);
}

function check_like_picture(data) {
	var like = document.getElementById("icone_like");
	if (like.src.indexOf("like_yet.png") != -1) {
		like.src = "../public/img/like.png";
	}
	else {
		like.src = "../public/img/like_yet.png";
	}
	request_get_like(check_get_like, data);
}

function request_get_like(callback, picture_id) {
  	var xhr = getXMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			if (xhr.responseText == -1) {
				alert("Une erreur s'est passée!");
				window.location.href = "gallery.php";
			}
			else
				callback(xhr.responseText, picture_id);
		}
	};
	xhr.open("POST", "../controller/get_like.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("picture_id=" + picture_id);
}

function check_get_like(data, picture_id) {
	var id = "nb_like" + String(parseInt(picture_id));
	var nb_like = document.getElementById(id);
	nb_like.innerHTML = data;
}
