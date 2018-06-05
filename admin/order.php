<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");
	require_once("../classes/Upload.php");
	not_login($_SESSION['admin_id'], "login.php");

	$allowed_type = array("1","2","3","4","5","6");
	if (isset($_GET['status']) && in_array($_GET['status'], $allowed_type)) {
		$status_no = escape($_GET['status']);
		switch ($status_no) {
			case '1':
				$status_name = "Processing";
				break;
			case "2":
				$status_name = "Processed";
				break;
			case "3":
				$status_name = "Shipped";
				break;
			case "4":
				$status_name = "Deliverd";
				break;
			case "5":
				$status_name = "Canceled";
				break;
			case '6':
				$status_name = "Returned";
				break;
		}
	}else{
		echo "<h1 class='text-center text-bs-primary text-upper'>Invalid Url</h1>";
		exit();
	}
?>
<div class="container padding-10">
	<div id="search-container">
	<center>
	<div class="btn-group">
		<a href="order.php?status=1" class="btn btn-primary">Processing Orders</a>
		<a href="order.php?status=2" class="btn btn-primary">Processed Orders</a>
		<a href="order.php?status=3" class="btn btn-primary">Shipped Orders</a>
		<a href="order.php?status=4" class="btn btn-primary">Deliverd Orders</a>
		<a href="order.php?status=5" class="btn btn-primary">Canceled Orders</a>
		<a href="order.php?status=6" class="btn btn-primary">Returned Orders</a>
	</div>
	</center>
		<h1 class="text-center text-bs-primary text-upper"><?php echo $status_name ?> orders</h1>
		<?php
        $orders = $db->FetchAll("*","buy","status_code='$status_no'","id='ASC'");
        if (empty($orders)) {
        	echo "<h3 class='text-center text-upper'>No Orders</h3>";
        	exit();
        }
        foreach ($orders as $key => $order) {
          echo "<div class='order-container'><div class='table-responsive'>"; //product order container
          echo "<table class='table table-condensed'>"; //table
          echo "
              <th>Order Id</th>
              <th>User Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Status</th>
              <th>Booked Time</th>
              <th>Dispatch Time</th><tr>";

          $address = $order['address']. " ".$order['city']. " ".$order['pincode'];
          $booked_time = time_ago($order['booked_time']);
          if ($order['dispatch_time'] != 0) {
            $dispatch_time = time_ago($order['dispatch_time']);
          }else{
            $dispatch_time = "Not Yet";
          }

          echo "<td>{$order['id']}</td>
                <td>{$order['user_id']}</td>
                <td>{$order['name']}</td>
                <td>{$order['email']}</td>
                <td>{$order['mobile']}</td>
                <td>{$address}</td>
                <td>{$order['status']}</td>
                <td>{$booked_time}</td>
                <td>{$dispatch_time}</td>
          ";



          echo "</table>";
          $product_stack = $order['product_stack'];
          $explode = explode(",", $product_stack);
          $key = count($explode) - 1;
          unset($explode[$key]);
          echo "<table class='table'>
                <th>Product Id</th>
                <th>Name</th>
                <th>Shipping charges</th>
                <th>Subtotal</th>
                <th>Total</th>
                <tr>
          ";
          $grand_total = 0;
          foreach ($explode as $key => $product_id) {
            $product = $db->Fetch("id,name,sp,shipping","product","id='$product_id'");
            $total = $product['shipping'] + $product['sp'];
            echo "
            <td>{$product['id']}</td>
            <td>{$product['name']}</td>
            <td>{$product['shipping']}</td>
            <td>{$product['sp']}</td>
            <td>{$total}</td><tr>";
            $grand_total += $total;
          }
          echo "<td><a href='change_order_status.php?id={$order['id']}'>Change Status</a></td><td></td><td></td><td><strong>Grand Total</strong></td><td>{$grand_total}</td>"; //grand total
          echo "</table>
          </div></div>"; 
        }
		?>
	</div>
	<?php require_once("../inc/footer-nav.php"); ?>
</div>
<?php require_once("inc/footer.php"); ?>
