<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">All Users</h1>
		<table class="table table-bordered table-striped">
			<th>Id</th>
			<th>Fullname</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Booked Orders</th>
			<tr>
		
		<?php
			$users = $db->FetchAll("id,fullname,email,phone","user",null,"`id` DESC");
			foreach ($users as $key => $user) {
				$user_id = $user['id'];
				$booked_orders = $db->GetNum("buy","user_id='$user_id'");
				echo "<td>{$user['id']}</td><td>{$user['fullname']}</td><td>{$user['email']}</td><td>{$user['phone']}</td><td>{$booked_orders}</td><tr>";
			}
		?>
		</table>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
