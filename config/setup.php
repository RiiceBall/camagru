<?php

include("database.php");
try {
	$conn = new PDO($DB_DSN_NO_BASE, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
	$conn->exec($sql);
	echo "Base " . $DB_NAME . " created with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to create database " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(15) NOT NULL,
		password VARCHAR(255) NOT NULL,
		email VARCHAR(50) NOT NULL,
		cle VARCHAR(255) NOT NULL,
		receive_mail ENUM('N', 'Y') NOT NULL DEFAULT 'Y',
		confirm ENUM('N', 'Y') NOT NULL DEFAULT 'N'
	)";
	$conn->exec($sql);
	echo "Table users created with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to create user table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS `picture` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id INT(6) UNSIGNED NOT NULL,
		picture_path VARCHAR(255) NOT NULL,
		create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	)";
	$conn->exec($sql);
	echo "Table picture created with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to create picture table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS `comment` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id INT(6) UNSIGNED NOT NULL,
		picture_id INT(6) UNSIGNED NOT NULL,
		content TEXT NOT NULL,
		comment_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	)";
	$conn->exec($sql);
	echo "Table comment created with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to create comment table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS `like` (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		user_id INT(6) UNSIGNED NOT NULL,
		picture_id INT(6) UNSIGNED NOT NULL
	)";
	$conn->exec($sql);
	echo "Table like created with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to create like table " . $e->getMessage() . "<br>";
}
$conn = null;
