<?php
require "config.php";
require "models/db.php";
require "models/product.php";
session_start();
$product = new Product;
$url = $_SERVER['PHP_SELF'] . '?';
if (isset($_GET['email'])) {
    echo '<html><script>alert("Các hot deal sẽ được gỡi về email bạn hằn tuần...");</script></html>';
    header("Refresh:0; $url");
}
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
$array = $product->getAllProducts();
function xuatten($s)
{
    if (strlen($s) <= 27) {
?>
        <p style="margin-top: 12px;"></p>
        <?php echo $s ?>
        <p style="margin-bottom: 24px;"></p>
    <?php
    } else {
        echo $s;
    }
    ?>
<?php
}
$getallmenu = $product->getAllmenu();

$tap2  = isset($_GET['tap2']) ? $_GET['tap2'] : 0;
if($tap2>3||$tap2<0){
    $tap2 = 0;
}
function classacctive($x, $tap2)
{
    if ($x == $tap2) {
        echo "active";
    }
}
function sstap2($tap2, $type_id)
{
    if ($tap2 ==0 && $type_id>=$tap2 ){
        return true;
    }
    if ($tap2 == 1 && $type_id == $tap2) {
        return true;
    }
    if ($tap2 == 2 && $type_id == $tap2) {
        return true;
    }
    if ($tap2 == 3 && $type_id >= $tap2) {
        return true;
    }
    return false;
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

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="images/acer-nitro-5-an515-57-54af-i5-11400h-16gb-512gb-600x600.jpg" width="360px" height="240px" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Laptop<br>Collection</h3>
                        <a href="store.php?type_id=2" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="images/xiaomi-mi-11-xanhduong-1-org.jpg" width="360px" height="240px" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Phone<br>Collection</h3>
                        <a href="store.php?type_id=1" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->

            <!-- shop -->
            <div class="col-md-4 col-xs-6">
                <div class="shop">
                    <div class="shop-img">
                        <img src="images/3d2d1c331e6247a5a224b20331050de7.png" width="360px" height="240px" alt="">
                    </div>
                    <div class="shop-body">
                        <h3>Accessories<br>Collection</h3>
                        <a href="store.php?type_id=5" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <!--

                            <div class="section-nav">
                                <ul class="section-tab-nav tab-nav">
                                    <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                    <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                                </ul>
                            </div>
                        -->
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <?php
                                $dem = 0;
                                for ($i = count($array) - 1; $i >= 0; $i--) {
                                    $value = $array[$i];
                                    $dem++;
                                ?>

                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            <a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
                                                <img src="./images/<?php echo $value['image'] ?>" width="100%" height="263px">
                                            </a>
                                            <!--
												<div class="product-label">
													<span class="sale">-30%</span>
													<span class="new">NEW</span>
												</div>
												-->
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Category</p>
                                            <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a>
                                            </h3>
                                            <h4 class="product-price"><?php echo number_format($value['price']) ?>
                                                <!-- <del class="product-old-price">$990.00</del>-->
                                            </h4>
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
                                            <form>
                                                <input type="hidden" name="addcart_ma" value="<?php echo $value['ID'] ?>">
                                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart" name="addcart"></i> add to cart</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /product -->

                                <?php if ($dem == 10) break;
                                } ?>

                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->
<div id="hot-deal" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="hot-deal">
                    <ul class="hot-deal-countdown">
                        <li>
                            <div>
                                <h3>02</h3>
                                <span>Days</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>10</h3>
                                <span>Hours</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>34</h3>
                                <span>Mins</span>
                            </div>
                        </li>
                        <li>
                            <div>
                                <h3>60</h3>
                                <span>Secs</span>
                            </div>
                        </li>
                    </ul>
                    <h2 class="text-uppercase">hot deal this week</h2>
                    <p>New Collection Up to 50% OFF</p>
                    <a class="primary-btn cta-btn" href="store.php">Shop now</a>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /HOT DEAL SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Top selling</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class=" <?php classacctive(0, $tap2) ?>"> <a href="index.php">All</a></li>
                            <li class=" <?php classacctive(2, $tap2) ?>"> <a href="index.php?tap2=2">Laptops</a></li>
                            <li class=" <?php classacctive(1, $tap2) ?>"><a href="index.php?tap2=1">Smartphones</a></li>
                            <li class=" <?php classacctive(3, $tap2) ?>"><a href="index.php?tap2=3">Accessories</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->
                                <?php
                                $dem = 0;
                                for ($i = 0; $i < count($array); $i++) {
                                    $dem++;
                                    $value = $array[$i];
                                    $random = rand(0, 3);
                                    if (sstap2($tap2, $value['type_id']) === true) {
                                ?>
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
                                                    <img src="./images/<?php echo $value['image'] ?>" width="100%" height="263px" alt="">
                                                </a>
                                                <div class="product-label">
                                                    <?php if ($random == 1 || $random == 3) { ?>
                                                        <span class="sale">-30%</span>
                                                    <?php }
                                                    if ($random == 2 || $random == 3) { ?>
                                                        <span class="new">NEW</span>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">Category</p>
                                                <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a></h3>
                                                <h4 class="product-price"><?php echo number_format($value['price']) ?> <?php if ($random == 1 || $random == 3) { ?>
                                                        <del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3) ?></del>
                                                    <?php } ?>
                                                </h4>
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
                                                <button onclick="location.href='<?php echo $url . '&addcart_ma=' . $value['ID'] ?>';" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                    cart</button>
                                            </div>
                                        </div>

                                <?php
                                        if ($dem == 10) break;
                                    }
                                } ?>
                                <!-- /product -->

                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    <?php
                    $dem = 0;
                    for ($i = 0; $i < 2; $i++) {
                        $j = 3 * $i;
                    ?>
                        <div>
                            <?php for ($j; $j < count($array); $j++) {
                                $random = rand(0, 5);
                                $dem++;
                                $value = $array[$j]; ?>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
                                        <div class="product-img">
                                            <img src="./images/<?php echo $value['image'] ?>" alt="">
                                        </div>
                                    </a>
                                    <div class="product-body">
                                        <p class="product-category">Category</p>
                                        <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a></h3>
                                        <h4 class="product-price"><?php echo number_format($value['price']);
                                                                    if ($random == 0) { ?> <del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3) ?></del><?php } ?></h4>
                                    </div>
                                </div>
                            <?php if ($dem == 3) {
                                    $dem = 0;
                                    break;
                                }
                            } ?>
                            <!-- /product widget -->
                        </div>
                    <?php } ?>

                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <?php
                    $dem = 0;
                    for ($i = 0; $i < 2; $i++) {
                        $j = 3 * ($i + 2);
                    ?>
                        <div>
                            <?php for ($j; $j < count($array); $j++) {
                                $random = rand(0, 5);
                                $dem++;
                                $value = $array[$j]; ?>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
                                        <div class="product-img">
                                            <img src="./images/<?php echo $value['image'] ?>" alt="">
                                        </div>
                                    </a>
                                    <div class="product-body">
                                        <p class="product-category">Category</p>
                                        <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a></h3>
                                        <h4 class="product-price"><?php echo number_format($value['price']);
                                                                    if ($random == 0) { ?> <del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3) ?></del><?php } ?></h4>
                                    </div>
                                </div>
                            <?php if ($dem == 3) {
                                    $dem = 0;
                                    break;
                                }
                            } ?>
                            <!-- /product widget -->
                        </div>
                    <?php } ?>


                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <?php
                    $dem = 0;
                    for ($i = 0; $i < 2; $i++) {
                        $j = 3 * ($i + 4);
                    ?>
                        <div>
                            <?php for ($j; $j < count($array); $j++) {
                                $random = rand(0, 5);
                                $dem++;
                                $value = $array[$j]; ?>
                                <!-- product widget -->
                                <div class="product-widget">
                                    <a href="details_product.php?product_id=<?php echo $value['ID'] ?>">
                                        <div class="product-img">
                                            <img src="./images/<?php echo $value['image'] ?>" alt="">
                                        </div>
                                    </a>
                                    <div class="product-body">
                                        <p class="product-category">Category</p>
                                        <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php xuatten($value['Name']) ?></a></h3>
                                        <h4 class="product-price"><?php echo number_format($value['price']);
                                                                    if ($random == 0) { ?> <del class="product-old-price"><?php echo number_format($value['price'] + $value['price'] * 0.3) ?></del><?php } ?></h4>
                                    </div>
                                </div>
                            <?php if ($dem == 3) {
                                    $dem = 0;
                                    break;
                                }
                            } ?>
                            <!-- /product widget -->
                        </div>
                    <?php } ?>
                </div>
            </div>

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