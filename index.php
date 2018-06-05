<?php
	require_once("inc/header.php");
	require_once("inc/navbar.php");

	$offer = $db->FetchAll("image,link","offer",null," RAND()");
?>

	<div id="myCarousel" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">

        <div class="item active height-400px">
          <img class="first-slide" class="hk-feature-slider-img" src="<?php echo $offer[0]['image']; ?>" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-lg btn-primary" href="<?php echo $offer[0]['link']; ?>" role="button">Order Now</a></p>
            </div>
          </div>
        </div>

        <div class="item height-400px">
          <img class="second-slide" class="hk-feature-slider-img" src="<?php echo $offer[1]['image']; ?>" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-lg btn-primary" href="<?php echo $offer[1]['link']; ?>" role="button">Order Now</a></p>
            </div>
          </div>
        </div>

        <div class="item height-400px">
          <img class="third-slide" src="<?php echo $offer[2]['image']; ?>">
          <div class="container">
            <div class="carousel-caption">
              <p><a class="btn btn-lg btn-primary" href="<?php echo $offer[2]['link']; ?>" role="button">Order Now</a></p>
            </div>
          </div>
        </div>

      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

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
<?php require_once("inc/footer.php"); ?>