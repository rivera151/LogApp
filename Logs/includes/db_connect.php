<?php
include_once 'psl-config.php';   // As functions.php is not included
$host = localhost;
$dbname=logs;
$username=ricardo;
$password="";

try {
	$pgsql = new PDO("pgsql:dbname=$dbname;host=$host", $username, $password );

} catch (PDOException $e) {
	print "includes/db_connect:PDO(ConnectionString): " . $e->getMessage() . "<br>";
	die();
}
?>
