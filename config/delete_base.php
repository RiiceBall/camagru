<?php

include("database.php");

// Delete database camagru

try {
	$conn = new PDO($DB_DSN_NO_BASE, $DB_USER, $DB_PASSWORD);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DROP DATABASE IF EXISTS $DB_NAME";
	$conn->exec($sql);
	echo "Deleted databse with success." . "<br>";
} catch (PDOException $e) {
	echo "Failed to delete database " . $e->getMessage() . "<br>";
}
$conn = null;
