<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");

	if (isset($_GET['id'])) {
		$banner_id = escape($_GET['id']);
		$banner = $db->Fetch("*","offer","id='$banner_id'");
		if (empty($banner)) {
			die("<center>Invalid Banner Id</center>");
		}
	}else{
		die("<center>Invalid Url</center>");
	}
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Edit Banner</h1>
		<div class="row">
			<div class="col-sm-6">
				<?php
					if (isset($_FILES['image'])) {
						$allowed = array("jpg","png","jpeg");
						$dir = md5(rand().$_FILES['image']['name'].random_password());
						mkdir("../images/{$dir}/");
						$upload = new Upload($_FILES['image'],"../images/{$dir}/",2000000,$allowed);

						$return = $upload->GetResult();

						if ($return['type'] == "success") {
							$filename = $_FILES['image']['name'];
							$insert = $db->Update("offer","image='images/$dir/$filename'","id='$banner_id'");
							echo "<div class='alert alert-success'>Banner updated <a href='banner.php'>GO BACk</a></div>";
						}else{
							echo "<div class='alert alert-danger'>{$return['message']}</div>";
						}
					}
				?>
				<form action="edit_banner.php?id=<?php echo $banner_id; ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="image">Edit Image</label>
						<p class="text-muted">Banner picture should be 1080*300 px</p>
						<input type="file" name="image" id="image">
					</div>	
					<input type="submit" class="btn btn-primary" value="Update Image">

				</form>
			</div>
			<div class="col-sm-6">
				<?php
					if (isset($_POST['add_link'])) {
						$link = escape($_POST['link']);

						if (!empty($link)) {
							$update = $db->Update("offer","link='$link'","id='$banner_id'");
							if ($update) {
								echo "<div class='alert alert-success'>Successfull updated your link <a href='banner.php'>GO BACk</a></div>";
								exit();
							}else{
								echo "<div class='alert alert-danger'>Error in updating link</div>";
							}
						}else{
							echo "<div class='alert alert-danger'>Empty link not allowed</div>";
						}
					}
				?>
				<form action="edit_banner.php?id=<?php echo $banner_id; ?>" method="post">
					<div class="form-group">
						<label for="link">Edit Link</label>
						<input type="text" class="form-control" name="link" id="link" value="<?php echo $banner['link']; ?>" placeholder="http://hackerkernel.com/product.php?id=1">
					</div>	
					<input type="submit" class="btn btn-primary" name="add_link" value="Update Link">
				</form>
			</div> 
		</div>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
