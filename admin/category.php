<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Category</h1>
		<table class="table table-bordered table-striped">
			<th>Id</th>
			<th>Name</th>
			<th>Image</th>
			<th>No Of Products</th>
			<th>Edit</th>
			<th>Delete</th>
			<tr>
		<?php
			$categorys = $db->FetchAll("*","category",null,"`id` DESC");
			foreach ($categorys as $key => $category) {
				
				$category_id = $category['id'];
				$no_of_products = $db->GetNum("product","category_id='$category_id'");

				echo "<td>{$category['id']}</td>
					  <td>{$category['name']}</td>
					  <td><img src='../{$category['image']}' height='150'></td>
					  <td>{$no_of_products}</td>
					  <td><a href='edit_category.php?id={$category_id}'>Edit</a></td>
					  <td><a href='delete_category.php?id={$category_id}'>Delete</a></td>
					  <tr>";
			}
		?>
		</table>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
