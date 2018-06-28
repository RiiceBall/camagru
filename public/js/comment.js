function request_comment_picture(user_id, picture_id) {
	var xhr = getXMLHttpRequest();
  	var content = encodeURIComponent(document.getElementById("comment_text").value);
	if (content) {
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				if (xhr.responseText != -1) {
					window.location.href = "commentaire.php?picture_id=" + picture_id;
				}
				else {
					alert("Une erreur s'est passée!");
					window.location.href = "commentaire.php?picture_id=" + picture_id;
				}
			}
		};
		xhr.open("POST", "../controller/add_comment.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("user_id=" + user_id + "&picture_id=" + picture_id + "&content=" + content);
	}
}
