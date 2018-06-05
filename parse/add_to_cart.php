<?php
	header("Content-Type: application/json");
	require_once("../classes/Db.php");
	require_once("../inc/function.php");
	session_start();
	$db = new Db();
	$mysqli = Db::$_mysqli;

	if (isset($_POST['product_id'])) {
		$product_id = escape($_POST['product_id']);
		$result = array();
		if (isset($_SESSION['id'])) { 
			$user_id = $_SESSION['id'];
			$insert = $db->Insert("cart","'','$product_id','$user_id','y',''");

			if ($insert) {
				$result['type'] = "success";
				$result['message'] = "Product has been added to the cart <a href='cart.php' class='text-bd-blue'>View Cart</a>";
			}else{
				$result['type'] = "error";
				$result['message'] = "Error try again.";
			}

		}else{ 
			$result['type'] = "error";
			$result['message'] = "Please Login <a href='login.php' class='text-bd-blue'>Login</a>";
		}

		echo json_encode($result);
	}
?>