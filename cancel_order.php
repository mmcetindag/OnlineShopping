<?php
	require_once("inc/header.php");
	session_start();
	if (isset($_GET['id']) && isset($_SESSION['id'])) {
		$order_id = $_GET['id'];
		$user_id = $_SESSION['id'];
		$fetch = $db->Fetch("*","buy","user_id='$user_id' AND id='$order_id' AND (status_code='1' OR status_code='2')");
		
		if ($fetch) {
			$cancel = $db->Update("buy","status_code='5',status='Canceled'","id='$order_id'");
			if ($cancel) {
				
				redirect("user.php");
			}else{
				die("Error in canceling order try again or contact us");
			}
		}else{
			die("You cannot cancel order for more detail contact us");
		}
	}else{
		die("Invalid url");
	}
?>