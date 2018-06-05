<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");


	if (!isset($_SESSION['id'])){
		echo "<h1 class='text-center text-upper text-bs-primary'>please login to view your cart <a class='text-black' href='login.php'>login</a></h1>";
		exit();
	}
	else{
		$user_id = $_SESSION['id'];
	} 

	$carts = $db->FetchAll("*","cart","user_id='$user_id' AND active='y'","`id` DESC");

	if (empty($carts)) {
		echo "<h1 class='text-center text-bs-primary text-25 text-upper'>your cart is empty <a class='text-black' href='products.php'>Go Shop</a></h1>";
		exit();
	}
?>
<div class="container padding-10">
	<div id="cart-container-main">
	<div class="text-center text-20 text-bold" id="cart-message"></div>
		<table class="table">
		<th>Product image</th>
		<th>Product detail</th>
		<th>Price</th>
		<th>Delivery Charge</th>
		<th>Subtotal</th>
		<th>Remove</th>
		<tr>
	<?php
		$main_subtotal = 0;
		$main_shipping_charge = 0;
		$product_id_stack = "";
		
		foreach ($carts as $key => $cart) {
			$cart_id = $cart['id'];
			$cart_product_id = $cart['product_id'];
			$product_id_stack .= $cart_product_id.",";

			$product = $db->Fetch("*","product","id='$cart_product_id'");

			if ($product['shipping'] == 0) {
				$shipping_text = "<span class='text-bold text-green'>FREE</span>";
				$shipping_price = 0;
			}else{
				$shipping_text = "$ ".$product['shipping'];
				$shipping_price = $product['shipping'];
			}

			$subtotal = $product['sp'] + $shipping_price;
			echo "
			<td><img src='{$product['image']}' class='cart-image'></td>
			<td>{$product['name']}</td>
			<td>$ {$product['sp']}</td>
			<td>{$shipping_text}</td>
			<td>$ {$subtotal}</td>
			<td><button class='remove-from-cart btn btn-primary text-18' id='{$cart_id}'><i class='fa fa-trash-o'></i></button></td>
			<tr>";

			$main_shipping_charge = $main_shipping_charge + $shipping_price;
			$main_subtotal = $main_subtotal + $product['sp'];
		}
	?>
		</table>
		<hr/>
		<div style="width:280px;" class="float-right">
			<div class="row">
				<input type="hidden" value="<?php echo encryption("encrypt", $product_id_stack);?>" id="product-id-stack">
				<div class="col-sm-6 text-left text-muted">Total</div>
				<div class="col-sm-6 text-right">$ <?php echo $main_subtotal; ?></div>
				<div class="col-sm-6 text-left text-muted">Delivery Charge</div>
				<div class="col-sm-6 text-right"><?php echo $main_shipping_charge ?></div>
				<div class="col-sm-6 text-left text-20 text-muted">You Pay</div>
				<div class="col-sm-6 text-20 text-right">$ <?php echo $main_shipping_charge + $main_subtotal ?></div>
				<div class="col-sm-12 text-25">
					<a data-toggle="modal" data-target="#myModal" href="#" class="btn btn-primary text-upper btn-block">continue</a>
				</div>
			</div>
		</div>
		<div class="float-clear"></div>
	</div> 
	<?php require_once("inc/footer-nav.php"); ?>
</div> 

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Place Your Order</h4>
			</div>
			<div class="modal-body">
        		<form action="cart.php" method="post" id="place_order_form">
        			<div class="form-group">
        				<label for="order_name">Fullname</label>
        				<input type="text" class="form-control order_input" name="order_name" id="order_name" placeholder="Enter fullname.">
        			</div>
        			<div class="form-group">
        				<label for="order_email">Email Address</label>
        				<input type="text" class="form-control order_input" name="order_email" id="order_email" placeholder="Enter your email address.">
        			</div>
        			<div class="form-group">
        				<label for="order_mobile">Mobile Number</label>
        				<input type="text" class="form-control order_input" name="order_mobile" id="order_mobile" placeholder="Enter your 10 digit mobile number">
        			</div>
        			<div class="form-group">
        				<label for="order_city">City</label>
        				<input type="text" class="form-control order_input" name="order_city" id="order_city" placeholder="Enter your city.">
        			</div>
        			<div class="form-group">
        				<label for="order_pincode">Pincode</label>
        				<input type="text" class="form-control order_input" name="order_pincode" id="order_pincode" placeholder="Enter 6 digit pincode number.">
        			</div>
        			<div class="form-group">
        				<label for="order_address">Address</label>
        				<textarea class="form-control order_input" name="order_address" id="order_address" placeholder="Enter Your full address."></textarea>
        			</div>
        		
      		</div>
      		<div class="modal-footer">
      			<div id="order_message" class="float-left text-20 text-bold"></div>
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-primary">Place Order</button>
      		</div> 
      		</form> 
		</div> 
	</div> 
</div> 
<?php
	require_once("inc/footer.php");
?>