<?php
require "config.php";
require "models/db.php";
require "models/product.php";
require "models/user.php";
$product = new Product;
$user = new user;
session_start();
if (sizeof($_SESSION['giohang']) <= 0) {
	//header('location:index.php');
}
$getallmenu = $product->getAllmenu();
$addcart_id = isset($_GET['addcart_ma']) ? $_GET['addcart_ma'] : null;
$url = $_SERVER['PHP_SELF'] . '?';
if (isset($_GET['email'])) {
	echo '<html><script>alert("Các hot deal sẽ được gỡi về email bạn hằn tuần...");</script></html>';
	header("Refresh:0; $url");
}
if (isset($_GET['delete'])) {
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		array_splice($_SESSION['giohang'], $_GET['delete'], 1);
		header("Refresh:0; $url");
		break;
	}
}
if (isset($_GET['deletebill_id'])) {
	$user->deletebill($_GET['deletebill_id']);
	$user->deletedetailsbill($_GET['deletebill_id']);
	header("Refresh:0; $url");
}
$array = $product->getAllProducts();
$getallmenu = $product->getAllmenu();

include "header.php"
?>
<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
				<?php
				foreach ($getallmenu as $value) {
				?>
					<li>
						<a href="store.php?manu_id=<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></a>
					</li>
				<?php } ?>
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
				<h3 class="breadcrumb-header">Regular Page</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Home</a></li>
					<li class="active">Bill</li>
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
		<form action="" method="post">
			<!-- row -->
			<div class="row tb" style="font-size: 18px;font-weight:bold;padding: 10px 0px;">
				<div class="col-md-2 col-xs-6">
					Bill ID
				</div>
				<div class="col-md-2 col-xs-6">
					Full Name
				</div>
				<div class="col-md-2 col-xs-6">
					Address
				</div>
				<div class="col-md-2 col-xs-6">
					Phone
				</div>
				<div class="col-md-3 col-xs-6">
					Operation
				</div>
			</div>
			<?php for ($i = 0; $i < sizeof($user->getbillbyusername($_SESSION['user'])); $i++) {
				$value = $user->getbillbyusername($_SESSION['user'])[$i];
			?>
				<div class="row tb" style="padding-top: 7px;">
					<div class="col-md-2 col-xs-6 ">
						<?php echo $value['bill_id'] ?>
					</div>
					<div class="col-md-2 col-xs-6 ">
						<?php echo $value['fullname'] ?>
					</div>
					<div class="col-md-2 col-xs-6 ">
						<?php echo $value['address'] ?>
					</div>
					<div class="col-md-2 col-xs-6">
						<?php echo $value['phone'] ?>
					</div>
					<div style="margin-top: -25px;padding-left: 110px;" class="col-md-6 col-xs-6 tt">
						<div style="margin-right: -50px;" class="col-md-5 cart-btns1"> <a href="blank.php?bill_id=<?php echo $value['bill_id'] ?>">Checkbill <i class="fa fa-arrow-circle-right"></i></a>
						</div>
						<div class="col-md-5 cart-btns1"> <a href="bill.php?deletebill_id=<?php echo $value['bill_id'] ?>">Deletebill <i class="fa fa-arrow-circle-right"></i></a>
						</div>
					</div>

					<!-- /row -->
				</div>
			<?php } ?>
		</form>
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="newsletter">
					<p>Sign Up for the <strong>NEWSLETTER</strong></p>
					<form id="form">
						<input name="email" class="input" type="email" placeholder="Enter Your Email" required>
						<button onchange="$('#form').submit();" class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
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

<?php
include "footer.php";
?>