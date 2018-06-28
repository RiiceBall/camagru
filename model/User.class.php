<?php
    class User {
        protected $username;
        protected $password;
        protected $cpassword;
        protected $email;

        function __construct($user_username) {
            $this->username = $user_username;
        }

        function set_username($user_uname) {
            $this->username = $user_uname;
        }

        function set_mail($user_email) {
            $this->email = $user_email;
        }

        function set_password($user_password) {
            $this->password = $user_password;
        }

        function set_cpassword($user_cpassword) {
            $this->cpassword = $user_cpassword;
        }

        function get_username() {
            return ($this->username);
        }

        function get_mail() {
            return ($this->email);
        }

        function get_password() {
            return ($this->password);
        }

        function get_cpassword() {
            return ($this->cpassword);
        }

        function check_username($db) {
            $db->set_sql("SELECT `username` FROM `users` WHERE `username`=?");
            $db->exec_sql(array($this->username));
            $ret = $db->get_result();
            $ret = count($ret);
            return ($ret);
        }

        function check_mail($db) {
            $db->set_sql("SELECT `email` FROM `users` WHERE `email`=?");
            $db->exec_sql(array($this->email));
            $ret = $db->get_result();
            $ret = count($ret);
            return ($ret);
        }

        function check_mdp($db) {
            $db->set_sql("SELECT `password` FROM `users`
                WHERE `password`=? AND `username`=?");
            $db->exec_sql(array($this->password, $this->username));
            $ret = $db->get_result();
            $ret = count($ret);
            return ($ret);
        }

        function check_two_mdp($passwd1, $passwd2) {
            if ($passwd1 !== $passwd2)
                return (0);
            else
                return (1);
        }
    }
