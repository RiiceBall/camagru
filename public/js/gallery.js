function request_get_gallery_picture(page) {
    var gallery = document.getElementById('gallery');
    var charger = document.getElementById('charger_photo');
    var xhr = getXMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            if (xhr.responseText != 0 && xhr.responseText != 1) {
                var element = document.createElement("span");
                element.innerHTML = xhr.responseText;
                gallery.append(element);
            }
            else if (xhr.responseText == 0){
                alert("Une erreur s'est passée!");
				window.location.href="../index.php";
            }
        }
    };
    xhr.open("POST", "show_gallery.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("offset=" + page);
}

function incre() {
    if( typeof incre.counter == 'undefined' ) {
        incre.counter = 0;
    }
    incre.counter++;
    return (incre.counter);
}

function check_scroll() {
    var gallery = document.getElementById('gallery');
    var body = document.body;
    var diff = gallery.clientHeight - body.clientHeight;
    var top = body.scrollTop;

    if (!gallery.getElementsByTagName('p').length) {
        if (top >= diff) {
            request_get_gallery_picture(incre());
        }
    }
}

window.addEventListener("scroll", check_scroll);
