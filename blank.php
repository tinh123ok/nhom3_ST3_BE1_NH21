<?php
require "config.php";
require "models/db.php";
require "models/product.php";
require "models/user.php";
$product = new Product;
$user = new user;
session_start();
$bill_id = isset($_GET['bill_id']) ? $_GET['bill_id'] : -1;
if (sizeof($_SESSION['giohang']) <= 0 && sizeof($user->getitembybillid($bill_id)) <= 0) {
	header('location:index.php');
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
if (isset($_POST['soluong']) && isset($_POST['id'])) {
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		if ($_SESSION['giohang'][$i][0] == $_POST['id']) {
			$_SESSION['giohang'][$i][1] = $_POST['soluong'];
			break;
		}
	}
}
$array = $product->getAllProducts();
$getallmenu = $product->getAllmenu();
if ($bill_id != -1) {
	$bill = $user->getbillbybill_id($bill_id)[0];
}
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
					<li class="active">Blank</li>
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->
<?php if ($bill_id == -1) { ?>
	<!-- SECTION -->
	<form id="form" action="" method="post">
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row tb" style="font-size: 18px;font-weight:bold;padding: 10px 0px;">
					<div class="col-md-2 col-xs-6">
						Ảnh đại diện
					</div>
					<div class="col-md-3 col-xs-6">
						Sản Phẩm
					</div>
					<div class="col-md-2 col-xs-6">
						Giá
					</div>
					<div class="col-md-2 col-xs-6">
						Số lượng
					</div>
					<div class="col-md-2 col-xs-6">
						Thao tác
					</div>
				</div>
				<?php for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
					$value = $product->getProductById($_SESSION['giohang'][$i][0])[0];
				?>
					<div class="row tb" style="padding-top: 7px;">
						<div class="col-md-2 col-xs-6 ">
							<img src="./images/<?php echo $value['image'] ?>" width="100px" height="100px">
						</div>
						<div class="col-md-3 col-xs-6 ">
							<?php echo $value['Name'] ?>
						</div>
						<div class="col-md-2 col-xs-6 ">
							<?php echo number_format($value['price']) . "đ" ?>
						</div>
						<div class="col-md-2 col-xs-6">
							<div style="width: 100px;">
								<input type="hidden" name="id" value="<?php echo $_SESSION['giohang'][$i][0] ?>">
								<input name="soluong" onchange="$('#form').submit();" value="<?php echo $_SESSION['giohang'][$i][1] ?>" type="number" style="width: 100%;" placeholder="number" id="numPeople" />
							</div>
						</div>
						<div style="padding-left: 30px;" class="col-md-2 col-xs-6 ">
							<div class="order-submit" style="margin-left: -30px;">
								<input class="primary-btn" name="Place_order" type="submit" value="Delete">
							</div>
						</div>
					</div>
					<!-- /row -->
				<?php } ?>
				<div class="row tb tt">
					<div class="col-md-5 col-xs-6"></div>
					<h4 class="col-md-2 col-xs-6" style="vertical-align: text-bottom;">Tổng Tiền:</h4>
					<div class="col-md-2 col-xs-6" style="font-size: 18px;font-weight:bold"><?php echo number_format($tong) . "đ" ?></div>
					<div class="col-md-2 col-xs-6 cart-btns1" style="margin-left: -10px;"> <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
	</form>
	<!-- /SECTION -->
<?php } else {
?>
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row" style="margin-bottom: 30px;font-size: 18px;font-weight:bold;padding: 10px 0px;">
				<div class="col-md-2 col-xs-6">
					Bill ID: <?php echo $bill['bill_id'] ?>
				</div>
				<div class="col-md-3 col-xs-6">
					Full Name: <?php echo $bill['fullname'] ?>
				</div>
				<div class="col-md-4 col-xs-6">
					Address: <?php echo $bill['address'] ?>
				</div>
				<div class="col-md-2 col-xs-6">
					Phone: <?php echo $bill['phone'] ?>
				</div>
			</div>
			<div class="row tb" style="font-size: 18px;font-weight:bold;padding: 10px 0px;">
				<div class="col-md-2 col-xs-6">
					Ảnh đại diện
				</div>
				<div class="col-md-3 col-xs-6">
					Sản Phẩm
				</div>
				<div class="col-md-2 col-xs-6">
					Giá
				</div>
				<div class="col-md-2 col-xs-6">
					Số lượng
				</div>
				<div class="col-md-2 col-xs-6">
					Thao tác
				</div>
			</div>
			<?php for ($i = 0; $i < sizeof($user->getitembybillid($bill_id)); $i++) {
				$value = $product->getProductById($user->getitembybillid($bill_id)[$i]['product_id'])[0];
			?>
				<div class="row tb" style="padding-top: 7px;">
					<div class="col-md-2 col-xs-6 ">
						<img src="./images/<?php echo $value['image'] ?>" width="100px" height="100px">
					</div>
					<div class="col-md-3 col-xs-6 ">
						<?php echo $value['Name'] ?>
					</div>
					<div class="col-md-2 col-xs-6 ">
						<?php echo number_format($value['price']) . "đ" ?>
					</div>
					<div class="col-md-2 col-xs-6">
						<div style="width: 100px;">
							<input disabled value="<?php echo $user->getitembybillid($bill_id)[$i]['quantily'] ?>" type="number" style="width: 100%;" placeholder="number" id="numPeople" />
						</div>
					</div>
					<div style="padding-left: 30px;" class="col-md-2 col-xs-6 ">
						<input disabled type="submit" value=" Xóa ">
					</div>
				</div>
				<!-- /row -->
			<?php } ?>

		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
<?php
} ?>
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