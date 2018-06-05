<?php
	require_once("./../classes/Db.php");
	require_once("./../inc/function.php");

	$db = new Db();
	$mysqli = Db::$_mysqli;
	
	session_start();
?>