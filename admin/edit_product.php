<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");

	if (isset($_GET['id'])) {
		$product_id = escape($_GET['id']);
		$product = $db->Fetch("*","product","id='$product_id'");
		$category_id = $product['category_id'];
		$category = $db->Fetch("name","category","id='$category_id'");

		if (empty($product)) {
			die("<center>Invalid product id</center>");
		}
	}else{
		die("<center>Invalid Page</center>");
	}
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper"><?php echo $product['name'] ?></h1>
		<?php
			if (isset($_POST['update'])) {
				$name = escape($_POST['pname']);
				$desc = escape($_POST['pdescription']);
                $stock = escape($_POST['pstock']);
				$mp = escape($_POST['pmp']);
				$sp = escape($_POST['psp']);
				$off = escape($_POST['poff']);
				$shipping = escape($_POST['pshipping']);
				$tags = escape($_POST['ptags']);
				$category = escape($_POST['pcategory']);
				
				if (empty($name) || empty($desc) || empty($stock) || empty($mp) || empty($sp) || empty($off) || $shipping == "" || empty($tags) || empty($category)) {
					echo "<div class='alert alert-danger'>Fill in all the fields.</div>";
				}else{
					$update = $db->Update("product","category_id='$category',name='$name',description='$desc',stock='$stock',mp='$mp',sp='$sp',off='$off',shipping='$shipping',tags='$tags'","id='$product_id'");
					if ($update) {
						echo "<div class='alert alert-success'>Product Information has been updated <a href='product.php'>Go BACK</a></div>";
						exit();
					}else{
						echo "<div class='alert alert-danger'>Oops! failed to update product.</div>";
					}
				}
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']."?id=".$product_id;?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="pname">Product Name</label>
				<input type="text" class="form-control" id="pname" name="pname" placeholder="Enter your product name"  value="<?php echo $product['name']; ?>">
			</div>
			<div class="form-group">
				<label for="pdescription">Product Description</label>
				<textarea placeholder="Enter products description" class="form-control" id="pdescription" name="pdescription"><?php echo $product['description']; ?></textarea>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2">
						<label for="pmp">Market Price</label>
						<input type="text" name="pmp" id="pmp" class="form-control" placeholder="Ex: 45000 (NOTE:no rs)" value="<?php echo $product['mp']; ?>">
					</div>
					<div class="col-sm-2">
						<label for="psp">Selling Price</label>
						<input type="text" name="psp" id="psp" class="form-control" placeholder="Ex: 40000 (NOTE:no rs)" value="<?php echo $product['sp']; ?>">
					</div>
					<div class="col-sm-2">
						<label for="poff">Discount Percentage</label>
						<input type="text" name="poff" id="poff" class="form-control" placeholder="Ex: 25% (NOTE:followed by %)" value="<?php echo $product['off']; ?>">
					</div>
					<div class="col-sm-2">
						<label for="pshipping">Shipping Charges</label>
						<input type="text" name="pshipping" id="pshipping" class="form-control" placeholder="Ex	: 40 (NOTE:no rs)" value="<?php echo $product['shipping']; ?>">
					</div>
                    <div class="col-sm-2">
						<label for="pstock">Stock Amount</label>
						<input type="text" name="pstock" id="pstock" class="form-control" placeholder="Ex	: 146" value="<?php echo $product['stock']; ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="ptags">Search Tags</label>
				<textarea id="ptags" name="ptags" class="form-control" placeholder="Seprate tage by comma (EXAMPLE: laptop,apple,macbook,mac book air)"><?php echo $product['tags'] ?></textarea>
			</div>
			<div class="form-group">
				<label for="pcategory">Select Product Category</label>
				<select name="pcategory" id="pcategory" class="form-control">
				<option value="<?php echo  $category_id;?>"><?php echo $category['name']; ?></option>
					<?php
						$categorys = $db->FetchAll("id,name","category","id!='$category_id'","`id` ASC");
						foreach ($categorys as $key => $category) {
							echo "<option value='{$category['id']}'>{$category['name']}</option>";
						}
					?>
				</select>
			</div>
			<input type="submit" class="btn btn-primary" name="update" value="Update Product">
			<a href="edit_product_image.php?id=<?php echo $product_id; ?>" class='btn btn-success'>Change Image</a>
		</form>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
