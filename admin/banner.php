<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
	<div id="search-container">
		<h1 class="text-center text-bs-primary text-upper">Banner</h1>
		<table class="table table-bordered table-striped">
			<th>Id</th>
			<th>Images</th>
			<th>Link</th>
			<th>Edit</th>
			<tr>
		<?php
			$banners = $db->FetchAll("*","offer",null,"`id` ASC");
			foreach ($banners as $key => $banner) {
				echo "<td>{$banner['id']}</td>
					<td><img src='../{$banner['image']}' width='500'></td>
					<td>{$banner['link']}</td>
					<td><a href='edit_banner.php?id={$banner['id']}'>Edit</a></td><tr>";
			}
		?>
		</table>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
