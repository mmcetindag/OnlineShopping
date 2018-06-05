<?php
	header("Content-Type: application/json");
	require_once("../classes/Db.php");
	require_once("../inc/function.php");
	session_start();
	$db = new Db();
	$mysqli = Db::$_mysqli;

	if (isset($_POST['cart_id'])) {
		$cart_id = escape($_POST['cart_id']);
		$result = array();

		if (isset($_SESSION['id'])) {
			$user_id = $_SESSION['id'];
			$delete = $db->Query("DELETE FROM `cart` WHERE id='$cart_id' AND user_id='$user_id'");

			$affected_rows = mysqli_affected_rows($mysqli);
			if ($affected_rows != 0) {
				$result['type'] = "success";
			}else{
				$result['type'] = "error";
				$result['message'] = "Error Try again <a href='cart.php' class='text-bs-primary'> Reload</a>";
			}
		}else{
			$result['type'] = "error";
			$result['message'] = "Please login <a href='login.php' class='text-bs-primary'>login</a>";
		}

		echo json_encode($result);
	}
?>