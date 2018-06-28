<?php
    if (!isset($_SESSION))
        session_start();
    $title = "Page No Found";
    $path_gallery = "view/gallery.php";
    $path_sign_in = "index.php";
    $path_logout = "controller/logout.php";
    $path_webcam = "index.php";
    $path_manage_user = "view/gestion_user_form.php";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="public/css/global.css">
        <style>
            p {
                margin-top: 40vh;
                font-size: 40px;
                text-align: center;
                color: #e64d00;
            }
        </style>
    </head>
    <body>
        <?php require("view/header.php"); ?>
        <p>Cette page n'existe pas sur le serveur!</p>
        <?php require("view/footer.php"); ?>
    </body>
</html>
