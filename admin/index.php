<?php
  require_once("inc/header.php");
  require_once("inc/navbar.php");
  not_login($_SESSION['admin_id'], "login.php");
?>
<div class="container padding-10">
  <div id="search-container">
      <h1 class="text-center text-upper text-bs-primary">Welcome <?php echo $_SESSION['admin_username']; ?></h1>
      <?php
      $user_count = $db->GetNum("user",null);
      $order_count = $db->GetNum("buy", null);
      $product_count = $db->GetNum('product', null);
      $category_count = $db->GetNum("category", null);
      ?>
      <div class="row">
        <div class="col-sm-3">
          <a href="users.php" class="a">
          <div class="tile-container bg-red">
            <i class='fa fa-users icon-medium'></i>
            <p><?php echo $user_count; ?></p>
            <h3>Users</h3>
          </div>
          </a>
        </div>

        <div class="col-sm-3">
        <a href="order.php?status=1" class="a">
          <div class="tile-container bg-green">
            <i class='fa fa-money icon-medium'></i>
            <p><?php echo $order_count; ?></p>
            <h3>Orders</h3>
          </div>
          </a>
        </div>
       
        <div class="col-sm-3">
          <a href="category.php" class="a">
          <div class="tile-container bg-orange">
            <i class='fa fa-files-o icon-medium'></i>
            <p><?php echo $category_count; ?></p>
            <h3>Category</h3>
          </div>
          </a>
        </div>
 
        <div class="col-sm-3">
          <a href="product.php" class="a">
          <div class="tile-container bg-blue">
            <i class='fa fa-black-tie icon-medium'></i>
            <p><?php echo $product_count; ?></p>
            <h3>Products</h3>
          </div>
          </a>
        </div>

      </div>


      <h1 class="text-center text-upper text-bs-primary">new orders</h1>
      <?php
      
        $orders = $db->FetchAll("*","buy","status_code='1'","id='ASC'");
        foreach ($orders as $key => $order) {
          echo "<div class='order-container'><div class='table-responsive'>";
          echo "<table class='table table-condensed'>"; 
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
</div>
<?php
  require_once("inc/footer.php");
?>
