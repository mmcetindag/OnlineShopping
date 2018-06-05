<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Products</h1>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-condensed">
			<th>Id</th>
			<th>Name</th>
			<th>Image</th>
			<th>Description</th>
            <th>Stock</th>
			<th>Market Price</th>
			<th>Selling Price</th>
			<th>Discout %</th>
			<th>Shipping Charges</th>
			<th>Tags</th>
			<th>Category</th>
			<th>Edit</th>
			<th>Delete</th>
			<tr>
		<?php
			$products = $db->Query("
					SELECT 
					product.id,product.name,product.image,product.description,product.stock,
					product.mp,product.sp,product.off,product.shipping,product.tags,category.name as category_name 
					FROM product 
					INNER JOIN category 
					on product.category_id = category.id
					ORDER BY product.id DESC
					");
			
			foreach ($products as $key => $product) {
				echo "
				<td>{$product['id']}</td>
				<td>{$product['name']}</td>
				<td><img src='../{$product['image']}' width='100'></td>
				<td>{$product['description']}</td>
                <td>{$product['stock']}</td>
				<td>{$product['mp']}</td>
				<td>{$product['sp']}</td>
				<td>{$product['off']}</td>
				<td>{$product['shipping']}</td>
				<td>{$product['tags']}</td>
				<td>{$product['category_name']}</td>
				<td><a href='edit_product.php?id={$product['id']}'>Edit</a></td>
				<td><a href='delete_product.php?id={$product['id']}'>Delete</a></td>
				<tr>
				";
			}
		?>
		</table>
		</div>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
