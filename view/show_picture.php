<?php
    ob_start();
    $db = new Database();
    $picture = new Picture();
    $ret = $picture->get_users_picture($db, $_SESSION['id']);
    $delete_icone = "public/img/delete_icone.png";
    $number = count($ret);
    $i = 0;
    while ($i < $number) {
        $img = $ret[$i];
        $i++;
        $path = "public/picture/" . $img['picture_path'];
        $picture_id = $img['id'];
        $div_id = 'my_picture' . $i;
        ?>
        <div id="<?= $div_id ?>"><a href="view/commentaire.php?picture_id=<?= $picture_id ?>">
            <img src=<?= $path ?> alt="photo"></a>
            <span onclick="request_delete_my_picture(check_delete_my_picture, <?= $picture_id ?>, <?= $i ?>);">
                <img src=<?= $delete_icone ?>></span></div>
        <?php
    }
    if ($number == 0) {
        ?><p class="no_picture">Vous n'avez pas encore partagé de photo :(</p><?php
    }
    $db->close_conn();
    $content = ob_get_contents();
    ob_get_clean();
    echo $content;
?>
