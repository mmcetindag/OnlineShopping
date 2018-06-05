<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Add Product</h1>
		<?php
			if (isset($_POST['add']) && isset($_FILES['pimage'])) {
				$name = escape($_POST['pname']);
				$desc = escape($_POST['pdescription']);
				$mp = escape($_POST['pmp']);
				$sp = escape($_POST['psp']);
				$stock = escape($_POST['pstock']);
				$off = escape($_POST['poff']);
				$shipping = escape($_POST['pshipping']);
				$tags = escape($_POST['ptags']);
				$category = escape($_POST['pcategory']);
				$image = $_FILES['pimage']['name'];

				$isEmptyArray = array();
				foreach ($_POST as $key => $post) {
					$post = trim($post);
					if ($post == "") {
						$isEmptyArray[$key] = "isEmpty";
					}else{
						$isEmptyArray[$key] = "notEmpty";
					}
				}				
				if (in_array("isEmpty", $isEmptyArray)) {
					echo "<div class='alert alert-danger'>Fill in all the fields</div>";
				}else{
					if (!empty($_FILES['pimage']['name'])) {
						$allowedImage = array("jpg","png","jpeg");
						$dir = md5(rand().random_password());
						mkdir("../images/{$dir}/");
						$upload = new Upload($_FILES['pimage'],"../images/{$dir}/",2000000,$allowedImage);
						$results = $upload->GetResult();

						if ($results['type'] == "success") {
							
							$insert = $db->Insert("product", "'','$category','$name','images/{$dir}/$image','$desc','$mp','$sp','$off','$shipping','$tags','$stock'");

							if($insert){
								echo "<div class='alert alert-success'>Product has been added <a href='product.php'>GO BACK</a></div>";
								exit();
							}else{
								echo "<div class='alert alert-danger'>Unable to Insert Product Try again</div>";
							}
						}else{
							echo "<div class='alert alert-danger'>{$result['message']}</div>";
						}
					}else{
						echo "<div class='alert alert-danger'>Select an image for product</div>";
					}
				}
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="pname">Product Name</label>
				<input type="text" class="form-control" id="pname" name="pname" placeholder="Enter your product name"  value="<?php echo @$name; ?>">
			</div>
			<div class="form-group">
				<label for="pimage">Product Image</label>
				<input type="file" class="form-control" id="pimage" name="pimage">
			</div>
			<div class="form-group">
				<label for="pdescription">Product Description</label>
				<textarea placeholder="Enter products description" class="form-control" id="pdescription" name="pdescription"><?php echo @$desc; ?></textarea>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-3">
						<label for="pmp">Market Price</label>
						<input type="number" name="pmp" id="pmp" class="form-control" placeholder="Ex: 45000 (NOTE:no $)" value="<?php echo @$mp; ?>">
					</div>
					<div class="col-sm-3">
						<label for="psp">Selling Price</label>
						<input type="number" name="psp" id="psp" class="form-control" placeholder="Ex: 40000 (NOTE:no $)" value="<?php echo @$sp; ?>">
					</div>
					<div class="col-sm-3">
						<label for="poff">Discount Percentage</label>
						<input type="text" name="poff" id="poff" class="form-control" placeholder="Ex: 25% (NOTE:followed by %)" value="<?php echo @$off; ?>">
					</div>
					<div class="col-sm-3">
						<label for="pshipping">Shipping Charges</label>
						<input type="number" name="pshipping" id="pshipping" class="form-control" placeholder="Ex	: 40 (NOTE:no $)" value="<?php echo @$shipping; ?>">
					</div>
					
					<div class="col-sm-3">
						<label for="pstock">Stock</label>
						<input type="number" name="pstock" id="pstock" class="form-control" placeholder="Ex	: 40 (NOTE:no $)" value="<?php echo @$stock; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="ptags">Search Tags</label>
				<textarea id="ptags" name="ptags" class="form-control" placeholder="Seprate tage by comma (EXAMPLE: laptop,apple,macbook,mac book air)"><?php echo @$tags ?></textarea>
			</div>
			<div class="form-group">
				<label for="pcategory">Select Product Category</label>
				<select name="pcategory" id="pcategory" class="form-control">
					<?php
						$categorys = $db->FetchAll("id,name","category",null,"`id` ASC");
						foreach ($categorys as $key => $category) {
							echo "<option value='{$category['id']}'>{$category['name']}</option>";
						}
					?>
				</select>
			</div>
			<input type="submit" class="btn btn-primary" name="add" value="Add Product">
		</form>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
