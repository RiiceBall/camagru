<?php
    class Picture {
    	function send_picture_to_db($db, $user_id, $picture_path) {
    		$db->set_sql("INSERT INTO `picture` (`user_id`, `picture_path`) VALUES (?, ?)");
    		$db->exec_sql(array($user_id, $picture_path));
    	}

    	function get_all_picture($db) {
    		$db->set_sql("SELECT `picture_path`, `id` FROM `picture` ORDER BY `create_date` DESC");
    		$db->exec_sql(array());
    		return ($db->get_result());
    	}

    	function get_some_picture($db, $offset) {
    		$db->set_sql("SELECT `picture_path`, `id` FROM `picture` ORDER BY `create_date` DESC LIMIT 12 OFFSET $offset ");
    		$db->exec_sql(array());
    		return ($db->get_result());
    	}

    	function get_users_picture($db, $user_id) {
    		$db->set_sql("SELECT `picture_path`, `id` FROM `picture` WHERE `user_id`=? ORDER BY `create_date` DESC");
    		$db->exec_sql(array($user_id));
    		return ($db->get_result());
    	}

    	function get_picture_like($db, $picture_id) {
    		$db->set_sql("SELECT `id` FROM `like` WHERE `picture_id`=?");
    		$db->exec_sql(array($picture_id));
    		return (count($db->get_result()));
    	}

        function check_picture_exist($db, $picture_id) {
            $db->set_sql("SELECT `id` FROM `picture` WHERE `id`=?");
            $db->exec_sql(array($picture_id));
            return (count($db->get_result()));
        }

    	function check_like($db, $user_id, $picture_id) {
    		$db->set_sql("SELECT `id` FROM `like` WHERE `user_id`=? AND `picture_id`=?");
    		$db->exec_sql(array($user_id, $picture_id));
    		$ret = $db->get_result();
    		if ((count($ret)) != 0)
    			return ($ret[0]['id']);
    		else
    			return (0);
    	}

    	function add_like_picture($db, $user_id, $picture_id) {
    		$db->set_sql("INSERT INTO `like` (`user_id`, `picture_id`) VALUES (?, ?)");
    		$db->exec_sql(array($user_id, $picture_id));
    	}

    	function del_like_picture($db, $like_id) {
    		$db->set_sql("DELETE FROM `like` WHERE `id`=?");
    		$db->exec_sql(array($like_id));
    	}
    }
