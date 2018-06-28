function request_delete_picture(callback, picture_id) {
    if (confirm("Etes vous certain de supprimer cette photo?")) {
        var xhr = getXMLHttpRequest();
    	xhr.onreadystatechange = function() {
    		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                if (xhr.responseText == 1) {
                    callback(xhr.responseText);
                }
                else {
                    alert("Une erreur s'est passée!");
                    window.location.href = "gallery.php";
                }
    		}
    	};
    	xhr.open("POST", "../controller/delete_picture.php", true);
    	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    	xhr.send("picture_id=" + picture_id);
    }
    else {
        callback(0);
    }
}

function check_delete_picture(data) {
    if (data) {
        window.location.href="gallery.php";
    }
}

function request_delete_my_picture(callback, picture_id, div_id) {
    if (confirm("Etes vous certain de supprimer cette photo?")) {
        var xhr = getXMLHttpRequest();
    	xhr.onreadystatechange = function() {
    		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                if (xhr.responseText == 1) {
                    callback(xhr.responseText, div_id);
                }
                else {
                    alert("Une erreur s'est passée!");
                    window.location.href = "index.php";
                }
    		}
    	};
    	xhr.open("POST", "controller/delete_picture.php", true);
    	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    	xhr.send("picture_id=" + picture_id);
    }
    else {
        callback(0, 0);
    }
}

function check_delete_my_picture(data, div_id) {
    if (data) {
        document.getElementById("my_picture" + div_id).remove();
        var old_picture = document.getElementById("old_picture");
        var verif = old_picture.getElementsByTagName("div");
        if (verif.length == 0) {
            var elem = document.createElement("p");
            elem.innerHTML = "Vous n'avez pas encore partagé de photo :(";
            elem.className = "no_picture";
            old_picture.append(elem);
        }
    }
}
