<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	not_login($_SESSION['admin_id'], "login.php");
	if (isset($_GET['id'])) {
		$id = escape($_GET['id']);
		$category = $db->Fetch("*","category","id='$id'");
		if(empty($category)){
			echo "<h1 class='text-center text-red'>Invalid category id</h1>";
			exit();
		}
	}else{
		echo "<h1 class='text-center text-red'>invalid url</h1>";
		exit();
	}
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-upper text-bs-primary">Edit `<span class='text-black'><?php echo $category['name']; ?></span>` category</h1>
		<?php
			if(isset($_POST['update'])){
				$name = escape($_POST['name']);
				if (!empty($name)) {
					$update = $db->Update("category", "name='$name'", "id='$id'");
					if ($update) {
						echo "<div class='alert alert-success'>Updated Successfull <a href='category.php'>Go Back</a><</div>";
						exit();
					}else{
						echo "<div class='alert alert-danger'>OOPS failed in updating name</div>";
					}
				}else{
					echo "<div class='alert alert-danger'>Name cannot be empty</div>";
				}
			}
		?>
		<form action="edit_category.php?id=<?php echo $id; ?>" method="post">
			<div class="form-group">
				<label for="cname">Name</label>
				<input type="text" class="form-control" name="name" value='<?php echo $category['name']; ?>'>				
			</div>
			<div class="form-group">
				
				<input type="submit" value="update" name="update" class="btn btn-primary">
				<a href="edit_category_image.php?id=<?php echo $category['id']; ?>" class='btn btn-success'>Change Category Image</a>
			</div>
		</form>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php
	require_once("inc/footer.php");
?>