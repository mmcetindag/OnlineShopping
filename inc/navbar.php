<nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand text-bold" href="index.php">THKU STORE</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

              <div class="col-sm-6 col-md-6 pull-left">
                  <form class="navbar-form" role="search" action="search.php" method="get">
                  <div class="input-group width-100">
                      <input required type="text" class="form-control" placeholder="Search" name="search" id="search" value="<?php if(isset($_GET['search'])) echo escape($_GET['search']) ?>">
                      <div class="input-group-btn">
                          <button class="btn btn-primary" type="submit"><i class="fa fa-search text-18"></i></button>
                      </div>
                  </div>
                  </form>
              </div>

              <ul class="nav navbar-nav pull-left">
              <?php
             
                session_start();
       
                if (isset($_SESSION['id'])) {
      
                  $user_id = escape($_SESSION['id']);
                  $user = $db->Fetch("*","user","id='$user_id'");
         
                  $cart_count = $db->GetNum("cart","user_id='$user_id' AND active='y'");
                  ?>
                  <li title="Home"><a href='cart.php'><i class="fa fa-shopping-cart icon-small"> <span class="badge" id="cart-count"><?php echo $cart_count; ?></span></i></a></li>
                  <li title="Products"><a href='products.php'><i class="fa fa-black-tie icon-small"></i></a></li>
                  <li><a href="user.php"><i class="fa fa-user icon-small"></i> <span class="text-20"><?php echo $user['fullname']; ?></span></a></li>
                  <li title="logout"><a href="logout.php"><i class="fa fa-sign-out icon-small"></i></a></li>
                  <?php
                }else{
                  ?>
                  <li title="Home"><a href='index.php'><i class="fa fa-home icon-small"></i></a></li>
                  <li title="Products"><a href='products.php'><i class="fa fa-black-tie icon-small"></i></a></li>
                  <li title="Login / Register"><a href='login.php'><i class="fa fa-sign-in icon-small"></i></a></li>
                  <?php
                }
              ?>
              </ul>

            </div>
          </div>
        </nav>
<div style="height:60px;"></div>
