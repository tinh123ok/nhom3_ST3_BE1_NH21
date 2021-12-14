<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
$getallmenu = $product->getAllmenu();
$getAllProducts = $product->getAllProducts();
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : -1;
if ($product_id == -1) {
	header('location:store.php');
}
$theproduct = $product->gettheproduct($product_id)[0];
$url = $_SERVER['PHP_SELF'] . "?product_id=" . $product_id;
if (isset($_GET['email'])) {
	echo '<html><script>alert("Các hot deal sẽ được gỡi về email bạn hằn tuần...");</script></html>';
	header("Refresh:0; $url");
}


session_start();
$addcart_id = null;
if (isset($_POST['addcart_ma'])) {
	$addcart_id = $_POST['addcart_ma'];
}
if(isset($_GET['addcart_ma'])){
	$addcart_id = $_GET['addcart_ma'];
}
if (!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
$f0 = 0;
if ($addcart_id != null) {
	$slhang = isset($_POST['slhang']) ? $_POST['slhang'] : 1;
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		if ($_SESSION['giohang'][$i][0] == $addcart_id) {
			$_SESSION['giohang'][$i][1] += $slhang;
			$f0 = 1;
			break;
		}
	}
	if ($f0 == 0) {
		$sp = [$addcart_id, $slhang];
		$_SESSION['giohang'][] = $sp;
	}
	header("Refresh:0; $url");
}
if (isset($_GET['delete'])) {
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		array_splice($_SESSION['giohang'], $_GET['delete'], 1);
		header("Refresh:0; $url");
		break;
	}
}
$array = $product->getAllProducts();
include "header.php";
?>


<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<?php
				foreach ($getallmenu as $manu) {
				?>
					<li>
						<a href="store.php?manu_id=<?php echo $manu['manu_id'] ?>"><?php echo $manu['manu_name'] ?></a>
					</li>
				<?php
				} ?>
			</ul>
			<!-- /NAV -->
		</div>
		<!-- /responsive-nav -->
	</div>
	<!-- /container -->
</nav>
<!-- /NAVIGATION -->

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="#">Home</a></li>
					<li><a href="store.php?manu_id=0">All Categories</a></li>
					<li><a href="store.php?manu_id=<?php echo $theproduct['manu_id'] ?>"><?php echo $product->getmanufacturesbyid($theproduct['manu_id'])[0]['manu_name'] ?></a></li>
					<li><?php echo $theproduct['Name'] ?></li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="./images/<?php echo $theproduct['image']; ?>" alt="">
					</div>


				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<div class="product-preview">
						<img src="./images/<?php echo $theproduct['image']; ?>" alt="">
					</div>


				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name"><?php echo $theproduct['Name']; ?></h2>
					<div>
						<div class="product-rating">
							<?php $rd = rand(4, 5);
							for ($i = 0; $i < $rd; $i++) { ?>
								<i class="fa fa-star"></i>
							<?php }
							if ($rd == 4) { ?>
								<i class="fa fa-star-o"></i>
							<?php } ?>
						</div>
						<!-- <a class="review-link" href="#">10 Review(s) | Add your review</a> -->
					</div>
					<div>
						<h3 class="product-price"><?php echo number_format($theproduct['price']) ?> <del class="product-old-price"><?php echo number_format($theproduct['price'] + $theproduct['price'] * 0.3) ?></del></h3>
						<span class="product-available">In Stock</span>
					</div>
					<p><?php echo substr($theproduct['description'], 0, 100) . " ..." ?></p>

					<!-- <div class="product-options">
						<label>
							Size
							<select class="input-select">
								<option value="0">X</option>
							</select>
						</label>
						<label>
							Color
							<select class="input-select">
								<option value="0">Red</option>
							</select>
						</label>
					</div> -->
					<form id="form" action="<?php echo $url ?>" method="post">
						<div class="add-to-cart">
							<div class="qty-label">
								Qty
								<div class="input-number">
									<input name="slhang" value="1" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							<input type="hidden" name="addcart_ma" value="<?php echo $theproduct['ID'] ?>">
							<button name="addcart_ma" value="<?php echo $theproduct['ID'] ?>" onchange="$('#form').submit();" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
						</div>
					</form>

					<ul class="product-btns">
						<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
						<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
					</ul>

					<ul class="product-links">
						<li>Category:</li>
						<li><a href="store.php?type_id=<?php echo $theproduct['type_id'] ?>"><?php echo $product->getprotypebyid($theproduct['type_id'])[0]['type_name'] ?></a></li>
					</ul>

					<ul class="product-links">
						<li>Share:</li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					</ul>

				</div>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab2">Details</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php echo $theproduct['description'] ?></p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<p><?php echo $theproduct['description'] ?></p>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<span>4.5</span>
											<div class="rating-stars">
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star"></i>
												<i class="fa fa-star-o"></i>
											</div>
										</div>
										<ul class="rating">
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 80%;"></div>
												</div>
												<span class="sum">3</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div style="width: 60%;"></div>
												</div>
												<span class="sum">2</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
											<li>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<div class="rating-progress">
													<div></div>
												</div>
												<span class="sum">0</span>
											</li>
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
											<li>
												<div class="review-heading">
													<h5 class="name">John</h5>
													<p class="date">27 DEC 2018, 8:0 PM</p>
													<div class="review-rating">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o empty"></i>
													</div>
												</div>
												<div class="review-body">
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
												</div>
											</li>
										</ul>
										<ul class="reviews-pagination">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- /Reviews -->

								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form">
											<input class="input" type="text" placeholder="Your Name">
											<input class="input" type="email" placeholder="Your Email">
											<textarea class="input" placeholder="Your Review"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
												</div>
											</div>
											<button class="primary-btn">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>

			<?php for ($i = 0; $i < sizeof($product->getProductBymenuid($theproduct['manu_id'])); $i++) {
				$value = $product->getProductBymenuid($theproduct['manu_id'])[$i]; ?>
				<!-- product -->
				<div class="col-md-3 col-xs-6">
					<div class="product">
						<div class="product-img">
							<img src="../Project/images/<?php echo $value['image'] ?>" alt="">
							<div class="product-label">
								<?php $rd = rand(0, 1);
								if ($rd == 0) { ?>
									<span class="sale">-30%</span>
								<?php } else { ?>
									<span class="new">NEW</span>
								<?php } ?>
							</div>
						</div>
						<div class="product-body">
							<p class="product-category">Category</p>
							<h3 class="product-name"><a href="#"><?php echo $value['Name'] ?></a></h3>
							<h4 class="product-price"><?php echo number_format($value['price'])  ?> <?php if ($rd == 0) { ?><del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3)  ?></del><?php } ?></h4>
							<div class="product-rating">
							</div>
							<div class="product-btns">
								<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
								<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
								<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
							</div>
						</div>
						<div class="add-to-cart">
							<button onclick="window.location.href='<?php echo $url . '&addcart_ma=' . $theproduct['ID'] ?>'" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
						</div>
					</div>
				</div>
				<!-- /product -->

				<div class="clearfix visible-sm visible-xs"></div>
			<?php } ?>

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form>
						<input type="hidden" name="product_id" value="<?php echo $product_id ?>">
						<input class="input" type="email" name="email" placeholder="Enter Your Email" required>
						<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
					</form>
					<ul class="newsletter-follow">
						<li>
							<a href="#"><i class="fa fa-facebook"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-twitter"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-instagram"></i></a>
						</li>
						<li>
							<a href="#"><i class="fa fa-pinterest"></i></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /NEWSLETTER -->

<!-- FOOTER -->
<?php include "footer.php" ?>