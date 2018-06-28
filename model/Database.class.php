<?php
    class Database {
    	private $conn;
    	private $sql;
    	private $result;

    	function __construct() {
    		try
    		{
    			$this->conn = new PDO("mysql:host=127.0.0.1:3306;dbname=camagru", "root", "password");
    			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    		} catch (PDOException $e) {
    			echo "Failed to connect to database " . $e->getMessage() . "<br>";
    		}
    	}

    	function set_sql($user_sql) {
    		$this->sql = $this->conn->prepare($user_sql);
    	}

    	function exec_sql($value) {
    		$this->sql->execute($value);
    	}

    	function get_result() {
    		$this->result = $this->sql->fetchAll();
    		$this->sql->closeCursor();
    		return ($this->result);
    	}

    	function get_sql() {
    		return ($this->sql);
    	}

    	function get_value($value, $table, $db_value, $user_value) {
    		$this->set_sql("SELECT `$value` FROM `$table` WHERE `$db_value`=?");
    		$this->exec_sql(array($user_value));
    		$ret = $this->get_result();
    		if (count($ret) > 0) {
    			$ret = $ret[0];
    			return ($ret[$value]);
    		}
    	}

    	function new_cle($username) {
    		$cle = hash("whirlpool", microtime(TRUE) * 100000);
    		$this->set_sql("UPDATE `users` SET `cle`=? WHERE `username`=?");
    		$this->exec_sql(array($cle, $username));
    	}

    	function close_conn() {
    		$this->conn = null;
    	}
    }
