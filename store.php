<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
$manu_cb = isset($_POST['manu']) ? $_POST['manu'] : [];
$type_cb = isset($_POST['type']) ? $_POST['type'] : [];
$price_max = isset($_POST['price_max']) ? $_POST['price_max'] : 999;
$price_min = isset($_POST['price_min']) ? $_POST['price_min'] : 1;
function ktracb_manu($manu_cb, $manu_id)
{
	foreach ($manu_cb as $value) {
		if ($value == $manu_id) {
			echo "checked";
		}
	}
}

function ktracb_type($type_cb, $type_id)
{
	foreach ($type_cb as $value) {
		if ($value == $type_id) {
			echo "checked";
		}
	}
}
$allproducts = $product->getAllProducts();
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
$array = $product->search($keyword);
$manu_id = isset($_GET['manu_id']) ? $_GET['manu_id'] : null;
$manu_id = $manu_id != null && ($manu_id < 0 || $manu_id > sizeof($product->getAllmenu())) ? 0 : $manu_id;
$type_id = isset($_GET['type_id']) ? $_GET['type_id'] : null;
$getallmenu = $product->getAllmenu();

//hàm lấy sản phẩm
$getmanu = [];
if ($keyword != null && strlen(trim($keyword)) != 0) {
	if ($manu_id != null) {
		if ($type_id != null) {
			$getmanu = $product->search_manu_type($keyword, $manu_id, $type_id);
		} else {
			$getmanu = $product->search_manu($keyword, $manu_id);
		}
	} else {
		$getmanu = $product->search($keyword);
	}
} else {
	if ($manu_id != null) {
		if ($type_id != null) {
			$getmanu = $product->getProduct_menuid_typeid($menu_id, $type_id);
		} else {
			$getmanu = $product->getProductBymenuid($manu_id);
		}
	} else {
		if ($type_id != null) {
			$getmanu = $product->getProductBytypeid($type_id);
		} else {
			$getmanu = $product->getAllProducts();
		}
	}
}
function getsp_checkbox($array, $checkbox, $select)
{
	if (sizeof($checkbox) > 0) {
		$newarray = array();
		foreach ($array as $value) {
			foreach ($checkbox as $cb) {
				if ($select == 0) {
					if ($value['manu_id'] == $cb) {
						$newarray[] = $value;
					}
				} else {
					if ($value['type_id'] == $cb) {
						$newarray[] = $value;
					}
				}
			}
		}
		return $newarray;
	}
	return $array;
}
function getsp_price($array, $price_min, $price_max)
{
	$newarray = array();
	foreach ($array as $value) {
		if ($value['price'] <= $price_max * 100000 && $value['price'] > $price_min * 100000) {
			$newarray[] = $value;
		}
	}
	return $newarray;
}
$getmanu = getsp_checkbox($getmanu, $manu_cb, 0);
$getmanu = getsp_checkbox($getmanu, $type_cb, 1);
$getmanu = getsp_price($getmanu,$price_min,$price_max);

// hiển thị 5 sản phẩm trên 1 trang
$perPage = 9;
// Lấy số trang trên thanh địa chỉ
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// Tính tổng số dòng, ví dụ kết quả là 18
$total = count($getmanu);
// lấy đường dẫn đến file hiện hành
$url = $_SERVER['PHP_SELF'] . "?";
if ($manu_id != null) {
	$url = $url . "&manu_id=" . $manu_id;
}
if ($type_id != null) {
	$url = $url . "&type_id=" . $type_id;
}
if ($keyword != null && strlen($keyword) > 0) {
	$url = $url . "&keyword=" . $keyword;
}

function array_sortpage($array, $page, $perPage)
{
	$newarray = [];
	$i = ($page - 1) * $perPage;
	$dem = $perPage;
	for ($j = $i; $j < sizeof($array); $j++) {
		$newarray[] = $array[$j];
		$dem--;
		if ($dem == 0) {
			break;
		}
	}
	return $newarray;
}
$aget3ProductByManuId = array_sortpage($getmanu, $page, $perPage);
function xuatten($s)
{
	if (strlen($s) <= 27) {
?>
		<p style="margin-top: 12px;"></p>
		<?php echo $s ?>
		<p style="margin-bottom: 23.399px;"></p>
	<?php
	} else {
		if (strlen($s) > 50) {
			echo substr($s, 0, 30) . "...";
		} else {
			echo $s;
		}
	}
	?>
<?php
}


session_start();
$addcart_id = isset($_GET['addcart_ma']) ? $_GET['addcart_ma'] : null;
if (!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
$f0 = 0;
if (isset($_GET['addcart_ma'])) {
	for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
		if ($_SESSION['giohang'][$i][0] == $addcart_id) {
			$_SESSION['giohang'][$i][1] += 1;
			$f0 = 1;
			break;
		}
	}
	if ($f0 == 0) {
		$sp = [$addcart_id, 1];
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
function getsl_protype($getmanu, $type_id)
{
	$dem = 0;
	foreach ($getmanu as $value) {
		if ($value['type_id'] == $type_id) {
			$dem++;
		}
	}
	return $dem;
}
function getsl_manu($getmanu, $manu_id)
{
	$dem = 0;
	foreach ($getmanu as $value) {
		if ($value['manu_id'] == $manu_id) {
			$dem++;
		}
	}
	return $dem;
}


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
				if ($manu_id != 0) {
					foreach ($getallmenu as $value) {

						if ($getallmenu[$manu_id - 1]['manu_id'] == $value['manu_id']) {
				?>
							<li class="active">
								<a href="store.php?manu_id=<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></a>
							</li>

						<?php } else {
						?> <li>
								<a href="store.php?manu_id=<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></a>
							</li>
						<?php }
					}
				} else {
					foreach ($getallmenu as $value) {
						?>
						<li>
							<a href="store.php?manu_id=<?php echo $value['manu_id'] ?>"><?php echo $value['manu_name'] ?></a>
						</li>
				<?php
					}
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
					<li><a href="index.php">Home</a></li>
					<li><a href="store.php">All Categories</a></li>
					<?php
					if ($manu_id != 0) {
					?>
						<li><a href="#"><?php echo $getallmenu[$manu_id - 1]['manu_name'] ?></a></li>
					<?php } ?>
					<li class="active">Device (<?php echo count($aget3ProductByManuId) ?> Results)</li>
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
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<form id="form" action="<?php echo $url ?>" method="post">
					<div class="aside">
						<h3 class="aside-title">Categories</h3>

						<div class="checkbox-filter">
							<?php $dem = 1;
							foreach ($product->getAllmenu() as $value) {
								if (getsl_manu($getmanu, $value['manu_id']) > 0) { ?>
									<div class="input-checkbox">
										<input name="manu[]" value="<?php echo $value['manu_id'] ?>" type="checkbox" onchange="$('#form').submit();" id="category-<?php echo $dem ?>" <?php ktracb_manu($manu_cb, $value['manu_id']) ?>>
										<label for="category-<?php echo $dem++ ?>">
											<span></span>
											<?php echo $value['manu_name'] ?>
											<small>(<?php echo getsl_manu($getmanu, $value['manu_id']) ?>)</small>
										</label>

									</div>
							<?php }
							} ?>

						</div>

					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Price</h3>
						<div class="price-filter" onchange="$('#form').submit();">
							<div id="price-slider"></div>
							<div class="input-number price-min">
								<input value="<?php echo $price_max ?>" name="price_min" id="price-min" type="number" onchange="$('#form').submit();">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input value="<?php echo $price_max ?>" name="price_max" id="price-max" type="number" onchange="$('#form').submit();">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Brand</h3>
						<div class="checkbox-filter">
							<?php $dem = 1;
							foreach ($product->getAllprotypes() as $value) {
								if (getsl_protype($getmanu, $value['type_id']) > 0) { ?>
									<div class="input-checkbox">
										<input name="type[]" value="<?php echo $value['type_id'] ?>" type="checkbox" onchange="$('#form').submit();" id="brand-<?php echo $dem ?>" <?php ktracb_type($type_cb, $value['type_id']) ?>>

										<label for="brand-<?php echo $dem++ ?>">
											<span></span>
											<?php echo $value['type_name'] ?>
											<small>(<?php echo getsl_protype($getmanu, $value['type_id']) ?>)</small>
										</label>
									</div>
							<?php }
							} ?>
						</div>

					</div>
					<!-- /aside Widget -->
				</form>

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Top selling</h3>
					<?php for ($i = 0; $i < 3; $i++) {
						$value = $allproducts[$i]; ?>
						<div class="product-widget">
							<div class="product-img">
								<img src="./images/<?php echo $value['image']; ?>" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#"><?php echo $value['Name']; ?></a></h3>
								<h4 class="product-price"><?php echo number_format($value['price']) ?> <del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3) ?></del></h4>
							</div>
						</div>
					<?php } ?>

				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<div class="store-sort">
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row">
					<?php foreach ($aget3ProductByManuId as $value) { ?>
						<!-- product -->
						<div class="col-md-4 col-xs-6">
							<div class="product">
								<div class="product-img">
									<a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
										<img src="./images/<?php echo $value['image'] ?>" alt="" width="262px" height="262px">

									</a>
									<!-- <div class="product-label">
											<span class="sale">-30%</span>
											<span class="new">NEW</span>
										</div> -->
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>

									<h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a></h3>
									<h4 class="product-price"><?php echo number_format($value['price']) ?> <del class="product-old-price">$990.00</del></h4>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<div class="product-btns">
										<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
										<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
										<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
									</div>
								</div>
								<div class="add-to-cart">
									<a href="<?php echo $url . "&addcart_ma=" . $value['ID'] ?>">
										<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>add to cart</button>
									</a>
								</div>
							</div>
						</div>
						<!-- /product -->
						<div class="clearfix visible-sm visible-xs"></div>
					<?php } ?>

				</div>
				<!-- /store products -->

				<!-- store bottom filter -->
				<div class="store-filter clearfix">
					<span class="store-qty">Showing 20-100 products</span>
					<ul class="store-pagination">
						<?php
						echo ($product->paginate($url, $total, $perPage));
						?>
					</ul>
				</div>
				<!-- /store bottom filter -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
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
					<form>
						<input class="input" type="email" placeholder="Enter Your Email" required>
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
<script>
	$(document).ready(function() {
		$("#formname").on("change", "input:checkbox", function() {
			$("#formname").submit();
		});
	});
</script>