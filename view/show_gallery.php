<?php
    require_once("../model/Database.class.php");
    require_once("../model/Picture.class.php");
    $db = new Database();
    $picture = new Picture();
    $nb_page = count($picture->get_all_picture($db)) / 12;
    if (isset($_POST['offset'])) {
        $ret = $picture->get_some_picture($db, ($_POST['offset'] * 12));
        ob_start();
        $i = 0;
        $number = count($ret);
        while ($i < $number) {
            $img = $ret[$i];
            $i++;
            $path = "../public/picture/" . $img['picture_path'];
            $picture_id = $img['id'];
            ?>
            <a href="commentaire.php?picture_id=<?= $picture_id ?>"><img src=<?= $path ?> alt="photo"></a>
            <?php
        }
        if ($number == 0 && $nb_page == 0) {
            ?><p class="no_picture">Personne a partagé de Photo :(</p><?php
        }
        $db->close_conn();
        $content = ob_get_contents();
        ob_get_clean();
        if ($content)
            echo $content;
        else if ($nb_page > 0)
            echo "1";
    }
    else {
        echo "0";
    }
?>
