<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
?>
<div class="container padding-10">
	<h1 class="text-bs-primary text-center text-upper">Category</h1>
	<div class="row">
	<?php
		$categorys = $db->FetchAll("*","category",null,"`id` DESC");
		foreach ($categorys as $key => $category) {
			$category_name = $category['name'];
			$category_id = $category['id'];
			$category_image = $category['image'];

			?>
				<div class="col-sm-3 col-md-3">
					<a href="category.php?id=<?php echo $category_id; ?>" class="thumbnail text-center">
						<img src="<?php echo $category_image;?>">
						<p class="text-center text-bold text-20"><?php echo $category_name;?></p>
					</a>
				</div>
			<?php
		}
	?>
	</div> 
	<?php require_once("inc/footer-nav.php"); ?>
</div>
<?php
	require_once("inc/footer.php");
?>