<?php
	header("Content-Type: application/json");

	require_once("../classes/Db.php");
	require_once("../inc/function.php");

	$db = new Db();
	$mysqli = Db::$_mysqli;

	if (isset($_POST['name'])) {
		$name = escape($_POST['name']);
		$email = escape($_POST['email']);
		$phone = escape($_POST['phone']);
		$password = escape($_POST['password']);
		$result = array();

		$email_num = $db->GetNum("user","email='$email'");

		if ($email_num == 0) {
			$md5password = md5($password);
			$insert = $db->Insert("user","'','$name','$email','$phone','$md5password'");

			if ($insert) {
				$result['type'] = "success";
				$result['message'] = "Your are Register";

				session_start();
				$_SESSION['id'] = mysqli_insert_id($mysqli);
			
			}else{ 
				$result['type'] = "error";
				$result['message'] = "Error Please Try again.";
			}

		}else{
			$result['type'] = "error";
			$result['message'] = "Email Already Register <span class='text-bs-primary'>Please Login</span>";
		}

		echo json_encode($result);
	}
?>