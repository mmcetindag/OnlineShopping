<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<div class="container">
<?php
	require_once("inc/init.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");
	if (isset($_GET['id'])) {
		$id = escape($_GET['id']);

	
		$buy = $db->Fetch("status_code","buy", "id='$id'");
		if (empty($buy)) {
			die("Invalid Order Id");
		}
	}else{
		die("Invalid Page");
	}
?>

<center>
	<?php
		if (isset($_POST['update'])) {
			$statuscode = $_POST['statuscode'];
			$allowed = array("1","2","3","4","5","6");
			if (in_array($statuscode, $allowed)) {
				switch ($statuscode) {
					case '1':
						$status = "Processing";
						break;
					case "2":
						$status = "Processed";
						break;
					case "3":
						$status = "Shipped";
						break;
					case "4":
						$status = "Deliverd";
						break;
					case "5":
						$status = "Canceled";
						break;
					case '6':
						$status = "Returned";
						break;
				}
				if ($statuscode == 4) {
					$time = time();
					$update = $db->Update("buy","status_code='$statuscode',dispatch_time='$time',status='$status'","id='$id'");
				}else{
					$update = $db->Update("buy","status_code='$statuscode',status='$status'","id='$id'");
				}

				if ($update) {
					die("Successfull updated status code <a href='order.php?status=1'>Go Back</a>");
				}else{
					die("Error Try again");
				}
			}else{
				die("Invalid Status code. Dont play bro");
			}
		}
	?>
	Current Status Code: <b><?php echo $buy['status_code']; ?></b><br>
	<b>1</b> : Processing<br>
	<b>2</b> : Processed<br>
	<b>3</b> : Shipped<br>
	<b>4</b> : Deliverd<br>
	<b>5</b> : Canceled<br>
	<b>6</b> : Returend
	<form action="change_order_status.php?id=<?php echo $id; ?>" method="post">
	<select name="statuscode">
		<option value='1'>Processing</option>
		<option value='2'>Processed</option>
		<option value='3'>Shipped</option>
		<option value='4'>Deliverd</option>
		<option value='5'>Canceled</option>
		<option value='6'>Returned</option>
	</select><br><br>
	<input type="submit" value="update" name="update">
	</form>
</center>