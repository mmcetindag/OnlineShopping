<?php
	header("Content-Type: application/json");
	require_once("../classes/Db.php");
	require_once("../inc/function.php");

	$db = new Db();
	$mysqli = Db::$_mysqli;

	if (isset($_POST['email'])) {
		$email = escape($_POST['email']);
		$password = escape($_POST['password']);
		$md5password = md5($password);
		$result = array();

		$q = $db->Fetch("`id`","user","email='$email' AND password='$md5password'");

		if ($q) {
			$result['type'] = "success";
			$result['message'] = "Welcome";

			session_start();
			$_SESSION['id'] = $q['id'];
		}else{
			$result['type'] = "error";
			$result['message'] = "Invalid Email or Password";
		}

		echo json_encode($result);
	}
?>