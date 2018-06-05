<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	if (isset($_GET['id'])) {
		$product_id = escape($_GET['id']);

		$product = $db->Fetch("*","product","id='$product_id'");
	
		if (!$product) {
			redirect("404.php");
		}
	}else{
		redirect("404.php");
	}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-4 padding-10 box-sizing">
			<div class="product-img-area">
				<img src="<?php echo $product['image']; ?>">
			</div>
		</div>
		<div class="col-sm-8 padding-10 box-sizing">
			<div class="product-desc-container">
				<h1 class="text-upper text-25 text-bs-primary"><?php echo $product['name']; ?></h1>
				<p><?php echo $product['description']; ?></p>
				<?php
                    if ($product['stock'] > 0){
                        echo '<p class="text-20">Stock : <span class="text-red">'.$product['stock'].'</span>';
						echo '<p class="text-20">Market Price :  <span class="text-line-through text-red">$ '.$product['mp'].'</span> <span class="text-green">[%'.$product['off'].' OFF]</span></p>';
                        $saved = $product['mp'] - $product['sp'];
                        echo '<p class="text-orange">Save $'.$saved.'</p>';
                        echo '<p class="text-20">Price <span class="text-bs-primary text-bold">$ '.$product['sp'].'</span></p>';
                        echo '<input type="hidden" value="'.$product_id.'" id="p-id">
				            <button class="btn btn-primary text-20 margin-5" id="add-to-cart">Add To Cart</button>';
                    }
                    else{
                        echo '<p class="text-red">Out of Stock</p>';
                    }
                ?>
				<span id="add-to-cart-message" class="text-bold text-20"></span>
			</div>
		</div>
	</div>
	<?php require_once("inc/footer-nav.php"); ?>
</div>
<?php
	require_once("inc/footer.php");
?>