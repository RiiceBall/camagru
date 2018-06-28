<?php
    class Check_info extends User {
        private $data;
        private $cle;

        function __construct($user_username, $user_password) {
            parent::__construct($user_username);
            $this->password = hash("whirlpool", $user_password);
        }

        function get_register_info($user_cpassword, $user_email) {
            $this->cpassword = hash("whirlpool", $user_cpassword);
            $this->set_mail($user_email);
        }

        function verif_username($db, $i) {
            $ret = $this->check_username($db);
            if ($ret === 1 && $i == 1) {
                $db->close_conn();
                throw new Exception("Ce nom existe déjà");
            }
            else if ($ret === 0 && $i == 0) {
                $db->close_conn();
                throw new Exception("Nom ou mot de passe incorrecte.");
            }
        }

        function verif_mail($db) {
            $ret = $this->check_mail($db);
            if ($ret === 1) {
                $db->close_conn();
                throw new Exception("Cette adresse email est déjà utilisée.");
            }
        }

        function verif_mdp_confirm($db) {
            $ret = $this->check_mdp($db);
            if ($ret === 0) {
                $db->close_conn();
                throw new Exception("Nom ou mot de passe incorrecte.");
            }
            else if ($ret === 1) {
                $db->set_sql("SELECT `confirm`, `email`, `id`, `receive_mail` FROM `users` WHERE `username`=?");
                $db->exec_sql(array($this->username));
                $ret = $db->get_result();
                $ret = $ret[0];
                if ($ret['confirm'] === 'N') {
                    $db->close_conn();
                    throw new Exception("Veuillez activer votre compte.");
                }
                else {
                    $_SESSION['id'] = $ret['id'];
                    $_SESSION['user'] = $this->username;
                    $_SESSION['password'] = $this->password;
                    $_SESSION['email'] = $ret['email'];
                    $_SESSION['receive'] = $ret['receive_mail'];
                    $db->close_conn();
                    throw new Exception("1");
                }
            }
        }

        function register($db) {
            $this->cle = hash("whirlpool", microtime(TRUE) * 100000);
            $db->set_sql("INSERT INTO `users`
                (`username`, `password`, `email`, `cle`)
                VALUES (?, ?, ?, ?)
                ");
            $db->exec_sql(array($this->username, $this->password, $this->email, $this->cle));
            send_verif_mail($this->email, "From: inscription@camagru.42.fr", $this->username, $this->cle);
            $db->close_conn();
            throw new Exception("1");
        }
    }
