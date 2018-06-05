<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");


	if (!isset($_GET['search'])) {
		redirect("404.php");
	}
?>
<div class="container padding-10">
	<div id="search-container">
		<div class='row'>
		<?php
			if (!empty($_GET['search'])) {
				
				$search = escape($_GET['search']);
				
				if (strlen($search) < 3) {
					echo "<h1 class='text-center text-red'>Search term should be more then 2 characters long</h1>";
					exit();
				}

				$search_term = explode(" ", $search);
				$term_count = 0;
				$q = "SELECT * FROM `product` WHERE ";

				foreach ($search_term as $key => $term) {
					$term_count++;
					if ($term_count == 1) {
						$q .= "`tags` LIKE '%$term%' ";
					}else{
						$q .= "AND `tags` LIKE '%$term%' ";
					}
				}

	
				$result_q = $db->Query($q);
				$result_num = mysqli_num_rows($result_q);
				if ($result_num > 0) {
				
					echo "<h2 class='text-center text-bs-primary'>`<span class='text-black'>{$result_num}</span>` Result Found</h2>";
					while ($product = mysqli_fetch_assoc($result_q)) {
						?>
						<div class="col-sm-3 col-md-3">
							<a href="product.php?id=<?php echo $product['id']; ?>" class="thumbnail">
								<img src="<?php echo $product['image']; ?>">
								<p class="text-bs-primary text-center"><?php echo $product['name']; ?></p>
								<p class="text-bold">$ <?php echo $product['sp']; ?></p>
								<span class="text-line-through">$ <?php echo $product['mp']; ?></span> <span class="text-red">[<?php echo $product['off']; ?> Off]</span>
							</a>
						</div>
						<?php
					}
				}else{
					echo "<h1 class='text-center text-red'>No results found for `<span class='text-black'>{$search}</span>`</h1>";
				}
			}else{
				echo "<h1 class='text-center text-bs-primary'>Sorry! No Search Term Given</h1>";
			}
		?>
		</div>
	</div>
<?php require_once("inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>