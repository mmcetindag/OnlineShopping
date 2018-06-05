<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<div class="container">
<?php
	require_once("inc/init.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");
	if (isset($_GET['id'])) {
		$id = escape($_GET['id']);

		$product = $db->Fetch("*","product", "id='$id'");
		if (empty($product)) {
			die("Invalid Product id");
		}
	}else{
		die("Invalid Page");
	}

	if (isset($_FILES['image'])) {
		$allowed = array("jpg","png","jpeg");
		$dir = md5(rand().random_password());
		mkdir("../images/{$dir}/");
		$upload = new Upload($_FILES['image'],"../images/{$dir}/", 2000000, $allowed);

		$result = $upload->GetResult();

		if ($result['type'] == "success") {

			$image = $_FILES['image']['name'];
			$insert = $db->Update("product","image='images/{$dir}/$image'","id='$id'");
			if ($insert) {
				echo "<div class='alert alert-success'>Image Updated <a href='edit_product.php?id={$id}'>Go Back</a></div>";
			}else{
				echo "<div class='alert alert-danger'>Failed to update file</div>";
			}
		}else{
			echo "<div class='alert alert-danger'>{$result['message']}</div>";
		}
	}
?>

<form action="edit_product_image.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<input type="file" name="image">
	</div>
	<input type="submit">
	</form>
	<a href="category.php">Go Back</a>
</div>