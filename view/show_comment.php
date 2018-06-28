<?php
    require_once("../model/Database.class.php");
    require_once("../model/Comment.class.php");
    ob_start();
    $db = new Database();
    $comment = new Comment();
    $ret = $comment->get_comments($db, $picture_id);
    $number = count($ret);
    $i = 0;
    while ($i < $number) {
        $comments = $ret[$i];
        $i++;
        $author = $db->get_value("username", "users", "id", $comments['user_id']);
        ?>
        <div id="user_comment">
            <span id="author"><img src="../public/img/user.png"> <?= htmlspecialchars($author) ?></span>
            <br>
            <span id="user_content"><?= nl2br(htmlspecialchars($comments['content'])) ?></span>
        </div>
        <?php
        if ($i < $number) { ?>
            <br>
            <br>
        <?php }
    }
    $db->close_conn();
    $content = ob_get_contents();
    ob_get_clean();
    echo $content;
?>
