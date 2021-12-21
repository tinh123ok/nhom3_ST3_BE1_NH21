<?php
require "config.php";
require "models/db.php";
require "models/product.php";
require "models/user.php";
$user = new user;
$product = new Product;
$url = $_SERVER['PHP_SELF'] . '?';
session_start();
if (sizeof($_SESSION['giohang']) <= 0) {
	header('location:index.php');
}
if (isset($_GET['email'])) {
	echo '<html><script>alert("Các hot deal sẽ được gỡi về email bạn hằn tuần...");</script></html>';
	header("Refresh:0; $url");
}
if (isset($_POST['Place_order']) && isset($_SESSION['user'])) {
	$name = $_POST['last-name'] . $_POST['first-name'];
	$address = $_POST['address'] . "-" . $_POST['city'] . "-" . $_POST['country'] . "-" . "(" . $_POST['zip-code'] . ")";
	$phone = $_POST['tel'];
	$ordernotes = $_POST['ordernotes'];
	$Barcode = $user->random_Barcode($user);
	$user->createbill($Barcode, $name, $_SESSION['user'], $address, $phone, $ordernotes);
	$bill_id = $user->getbill_id($Barcode);
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		$user->addbill($bill_id, $_SESSION['giohang'][$i][0], $_SESSION['giohang'][$i][1]);
	}
	unset($_SESSION['giohang']);
	echo '<html><script>alert("Order Success. Orders will be delivered in the next 3-4 days");</script></html>';
	header("Refresh:0; index.php");
} else {
	if (isset($_POST['Place_order'])&& !isset($_SESSION['user'])) {
		$name = $_POST['last-name'] . $_POST['first-name'];
		$address = $_POST['address'] . "-" . $_POST['city'] . "-" . $_POST['country'] . "-" . "(" . $_POST['zip-code'] . ")";
		$phone = $_POST['tel'];
		$ordernotes = $_POST['ordernotes'];
		$Barcode = $user->random_Barcode($user);
		$user->createbill($Barcode, $name, "", $address, $phone, $ordernotes);
		$bill_id = $user->getbill_id($Barcode);
		for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
			$user->addbill($bill_id, $_SESSION['giohang'][$i][0], $_SESSION['giohang'][$i][1]);
		}
		unset($_SESSION['giohang']);
		echo '<html><script>alert("Order Success. Orders will be delivered in the next 3-4 days");</script></html>';
		header("Refresh:0; index.php");
	}
}
$array = $product->getAllProducts();
include "header.php";
?>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
	<!-- container -->
	<div class="container">
		<!-- responsive-nav -->
		<div id="responsive-nav">
			<!-- NAV -->
			<ul class="main-nav nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>
				<?php foreach ($product->getAllmenu() as $value) {
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
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="index.php">Home</a></li>
					<li class="active">Checkout</li>
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
	<form action="" id="form" method="post">

		<div class="container">
			<!-- row -->
			<div class="row">

				<div class="col-md-7">
					<!-- Billing Details -->
					<div class="billing-details">
						<div class="section-title">
							<h3 class="title">order Information</h3>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="first-name" placeholder="First Name" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="last-name" placeholder="Last Name" required>
						</div>
						<div class="form-group">
							<input class="input" type="email" name="email" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="address" placeholder="Address" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="city" placeholder="City" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="country" placeholder="Country" required>
						</div>
						<div class="form-group">
							<input class="input" type="text" name="zip-code" placeholder="ZIP Code" required>
						</div>
						<div class="form-group">
							<input class="input" type="tel" name="tel" placeholder="Telephone" required>
						</div>

					</div>
					<!-- /Billing Details -->

					<!-- Order notes -->
					<div class="order-notes">
						<textarea name="ordernotes" class="input" placeholder="Order Notes"></textarea>
					</div>
					<!-- /Order notes -->
				</div>

				<!-- Order Details -->
				<div class="col-md-5 order-details">
					<div class="section-title text-center">
						<h3 class="title">Your Order</h3>
					</div>
					<div class="order-summary">
						<div class="order-col">
							<div><strong>PRODUCT</strong></div>
							<div><strong>TOTAL</strong></div>
						</div>
						<div class="order-products">
							<?php $tong = 0;
							for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
								$value = $product->getProductById($_SESSION['giohang'][$i][0])[0];
								$tong += $value['price'] * $_SESSION['giohang'][$i][1];
							?>

								<div class="order-col">
									<div><?php echo $_SESSION['giohang'][$i][1] . 'x' . $value['Name'] ?></div>
									<div><?php echo number_format($value['price']) ?>đ</div>
								</div>
							<?php } ?>
						</div>
						<div class="order-col">
							<div>Shiping</div>
							<div><strong>FREE</strong></div>
						</div>
						<div class="order-col">
							<div><strong>TOTAL</strong></div>
							<div><strong class="order-total"><?php echo number_format($tong) ?>đ</strong></div>
						</div>
					</div>
					<div class="payment-method">
						<div class="input-radio">
							<input type="radio" name="payment" id="payment-1" checked>
							<label for="payment-1">
								<span></span>
								Direct Bank Transfer
							</label>
							<div class="caption">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>
						<div class="input-radio">
							<input type="radio" name="payment" id="payment-2">
							<label for="payment-2">
								<span></span>
								Cheque Payment
							</label>
							<div class="caption">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>
						<div class="input-radio">
							<input type="radio" name="payment" id="payment-3">
							<label for="payment-3">
								<span></span>
								Paypal System
							</label>
							<div class="caption">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
						</div>
					</div>
					<div class="input-checkbox">
						<input type="checkbox" id="terms" required>
						<label for="terms">
							<span></span>
							I've read and accept the <a href="#">terms & conditions</a>
						</label>
					</div>
					<div class="order-submit" style="width: 100%;">
						<input class="primary-btn" style="width: 100%;" name="Place_order" type="submit" value="Place order">
					</div>

				</div>
				<!-- /Order Details -->
			</div>
			<!-- /row -->
		</div>
	</form>

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
					<form>
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
<?php include "footer.php"; ?>