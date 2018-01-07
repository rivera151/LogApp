<?php
//include_once 'psl-config.php';   // As functions.php is not included
include_once 'LogApp.php';




$host = LogApp::$dbServer;
$dbname= LogApp::$dbName;
$username=Logapp::$appUser;
$password=$dbPW;

try {
	$pgsql = new PDO("pgsql:dbname=$dbname;host=$host", $username, $password );
	
	$stmt = $pgsql->prepare(sql);
	
	$rs = $pgsql->query($stmt);
	
	$rs->closeCursor();
	

} catch (PDOException $e) {
	print "includes/db_connect:PDO(ConnectionString): " . $e->getMessage() . "<br>";
	die();
}
?>