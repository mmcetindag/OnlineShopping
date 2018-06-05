<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
            <a class="navbar-brand" href="index.php">THKU STORE ADMIN PANEL</a>
        </div>
        <div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
					  <li><a href="index.php">Dashboard</a></li>
                    <li><a href="order.php?status=1">Order</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="category.php">Category <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="category.php">View Category</a></li>
                            <li><a href="add_category.php">Add Category</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="product.php">Product <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="product.php">View Product</a></li>
                            <li><a href="add_product.php">Add Product</a></li>
                        </ul>
                    </li>
                    <li><a href="banner.php">Banner</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <li><a href="/shopping/index.php">Preview Site</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
</nav>
