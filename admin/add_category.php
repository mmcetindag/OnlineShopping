<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Add Category</h1>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
		<?php
			if (isset($_POST['name']) && isset($_FILES['image'])) {
				$name = escape($_POST['name']);
				if (!empty($_POST['name']) && !empty($_FILES['image'])) {
					$allowed = array("jpg","jpeg","png");
					$dir = md5(random_password().rand().$_FILES['image']['tmp_name']);
					mkdir("../images/{$dir}/");
					$upload = new Upload($_FILES['image'],"../images/{$dir}/", 2000000, $allowed);

					$results = $upload->GetResult();
					if ($results['type'] == "success") {
						$file_name = $_FILES['image']['name'];
						$insert = $db->Insert("category", "'','$name','images/{$dir}/$file_name'");
						if ($insert) {
							echo "<div class='alert alert-success'>Category has been Added</div>";
						}else{
							echo "<div class='alert alert-danger'>Error in adding category try again</div>";
						}
					}else{
						echo "<div class='alert alert-danger'>{$results['message']}</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>Fill In all the Fields</div>";
				}
			}
		?>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name">
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control" id="image" name="image">
			</div>
			<input type="submit" class="btn btn-primary" name="add" value="Add Category">
		</form>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
