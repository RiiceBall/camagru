var video = document.getElementById('video'),
    canvas = document.getElementById('canvas'),
    snap = document.getElementById('tack'),
    img_video = document.getElementById('img_video'),
    side = document.getElementById('side'),
    no_video = document.getElementById('no_video'),
    message_to_user = document.getElementById('message_to_user'),
    video_value = 0,
    img_value = "none";

navigator.getMedia = navigator.getUserMedia ||
                     navigator.webkitGetUserMedia ||
                     navigator.mozGetUserMedia ||
                     navigator.msGetUserMedia;
navigator.getMedia({
    video: true,
    audio: false
}, function(stream){
    message_to_user.innerHTML = "Choisissez un filtre pour prendre une photo";
    vendorUrl = window.URL || window.webkitURL;
    video.srcObject = stream;
    video.play();
}, function(error) {
    message_to_user.innerHTML = "Upload une image et choisissez un filtre pour prendre une photo";
});

function draw_img_video(img_name, value) {
    if (video.srcObject || no_video.src)
        snap.style['pointer-events'] = "auto";
    img_value = value;
    img_video.src = "public/filtre/" + img_name;
    img_video.style.display = "block";
}

function upload_image(id) {
    var target = document.querySelector("#upload").files[0];
    if (!(target))
        return (0);
    if ((target.type == "image/jpeg" || target.type == "image/png")) {
        video_value = 1;
        video.src = "";
        if (img_value != "none")
            snap.style['pointer-events'] = "auto";
        var xhr = getXMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                if (!xhr.responseText) {
                    no_video.src = "public/user_upload" + id + "/" + target.name;
                    no_video.style.display = "block";
                }
                else if (xhr.responseText == 1) {
                    snap.style['pointer-events'] = "none";
                    alert("L'upload a échoué, veuillez upload a nouveau!");
                }
                else if (xhr.responseText == 2) {
                    alert("Error! Vous n'etes pas encore connecté!");
                    window.location.href="index.php";
                }
            }
        };
        var formdata = new FormData();
        formdata.append("upload", target);
        xhr.open("POST", "public/function/save_upload_picture.php", true);
        xhr.send(formdata);
    }
    else {
        alert("Vous devez upload que des fichier de type jpg, jpeg ou png!");
    }
}

snap.addEventListener('click', function(){
    canvas.getContext('2d').clearRect(0, 0, 400, 300);
    if (video_value == 0) {
        canvas.getContext('2d').drawImage(video, 0, 0, 400, 300);
        var dest = canvas.toDataURL("image/png");
    }
    else {
        canvas.getContext('2d').drawImage(no_video, 0, 0, 400, 300);
        var dest = no_video.src;
    }
    canvas.getContext('2d').drawImage(img_video, 0, 0, 400, 300);
    var elem = document.createElement("img");
    var source = img_video.src;
    elem.src = canvas.toDataURL("image/png");
    elem.setAttribute("alt", img_value);
    side.prepend(elem);
    elem.onclick = function() {
        var xhr = getXMLHttpRequest();
        var data = canvas.toDataURL("image/png");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                if (xhr.responseText != 1 && xhr.responseText != 2) {
                    elem.remove();
                    document.getElementById("old_picture").innerHTML = xhr.responseText;
                }
                else if (xhr.responseText == 2) {
                    alert("Error! Vous n'etes pas encore connecté!");
                    window.location.href="index.php";
                }
                else {
                    alert("Error! Partage de photo échoué!");
                }
            }
        };
        xhr.open("POST", "public/function/upload.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("source=" + source + "&dest=" + dest + "&img=" + elem.alt);
    }
})
