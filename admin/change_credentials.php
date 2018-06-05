<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	not_login($_SESSION['admin_id'],"login.php");
	$admin_id = $_SESSION['admin_id'];
?>
<div class="container padding-10">
	<div id="search-container">
		<div class="width-400px center">
			<h1 class="text-bs-primary">Change Credentials</h1>
			<?php
			
				if (isset($_POST['update'])) {
					$username = escape($_POST['username']);
					$password = escape($_POST['password']);
					$md5password = md5($password);
					$update = $db->Update("admin","username='$username',password='$md5password'","id='$admin_id'");
					if ($update) {
						echo "<div class='alert alert-success'>Your account information has been updated</div>";
					}else{
						echo "<div class='alert alert-danger'>Error in updating information try again.</div>";
					}
				}
			?>
			<form method="post">
				<div class="form-group">
					<label for="username">Change Username</label>
					<input type="text" name="username" id="username" class="form-control">
				</div>
				<div class="form-group">
					<label for="password">Change Password</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>
				<input type="submit" name="update" value="update" class="btn btn-primary">
			</form>
		</div>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>