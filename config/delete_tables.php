<?php

include("database.php");

// Delete tables

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP TABLE IF EXISTS `users`";
	$conn->exec($sql);
	echo "Deleted users table with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to delete user table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP TABLE IF EXISTS `picture`";
	$conn->exec($sql);
	echo "Deleted picture table with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to delete picture table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP TABLE IF EXISTS `comment`";
	$conn->exec($sql);
	echo "Deleted comment table with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to delete comment table " . $e->getMessage() . "<br>";
}
$conn = null;

try {
	$conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP TABLE IF EXISTS `like`";
	$conn->exec($sql);
	echo "Deleted like table with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to delete like table " . $e->getMessage() . "<br>";
}
$conn = null;
