<?php
    class Comment {
        function add_comment($db, $user_id, $picture_id, $content) {
            $db->set_sql("INSERT INTO `comment` (`user_id`, `picture_id`, `content`) VALUES(?, ?, ?)");
            $db->exec_sql(array($user_id, $picture_id, $content));
        }

        function get_comments($db, $picture_id) {
            $db->set_sql("SELECT `user_id`, `content` FROM comment WHERE `picture_id`=? ORDER BY `comment_date` DESC");
            $db->exec_sql(array($picture_id));
            return ($db->get_result());
        }
    }
