<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	if (isset($_SESSION['id'])) {
		redirect("index.php");
	}
?>
<div class="container">
	<div class="row">

		<div class="col-sm-6 col-md-6 padding-10">
			<div class="thumbnail padding-10 box-sizing">
				<h1 class="text-bs-primary text-center text-upper">Login</h1>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="l-form">
					<div class="form-group">
						<label class="text-bs-primary" for="l-email">Email</label>
						<input type="text" class="form-control" id="l-email" name="l-email" placeholder="Enter Your Email.">
					</div>
					<div class="form-group">
						<label class="text-bs-primary" for="l-password">Password</label>
						<input type="password" class="form-control" id="l-password" name="l-password" placeholder="Enter Your Password.">	
					</div>
					<input type="submit" value="Login" id="l-login" name="l-login" class="btn btn-primary">
					<span id="l-message" class="text-bold text-20 float-right"></span>
				</form>
			</div>
		</div>

		<div class="col-sm-6 col-md-6 padding-10" style="min-height:550px;">
			<div class="thumbnail padding-10 box-sizing">
			<h1 class="text-bs-primary text-center text-upper">Signup</h1>
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="s-form">
					<div class="form-group">
						<label for="s-name" class="text-bs-primary">Fullname</label>
						<input type="text" class="form-control" name="s-name" id="s-name" placeholder="Enter Your Fullname.">
					</div>
					<div class="form-group">
						<label for="s-email" class="text-bs-primary">Email</label>
						<input type="email" class="form-control" name="s-email" id="s-email" placeholder="Enter Your Email.">
					</div>
					<div class="form-group">
						<label for="s-phone" class="text-bs-primary">Phone No</label>
						<input type="text" class="form-control" name="s-phone" id="s-phone" placeholder="Enter Your Phone Number.">
					</div>
					<div class="form-group">
						<label for="s-password" class="text-bs-primary">Password</label>
						<input type="password" class="form-control" name="s-password" id="s-password" placeholder="Enter Your Password.">
					</div>
					<input type="submit" class="btn btn-primary" value="Signup" id="s-register" name="s-register">
					<span id="s-message" class="text-bold text-20 float-right"></span>
				</form>
			</div>
		</div>

	</div>
	<?php require_once("inc/footer-nav.php"); ?>
</div>

<?php
	require_once("inc/footer.php");
?>