<?php

$tong = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>Electro - HTML Ecommerce Template</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="css/slick.css" />
    <link type="text/css" rel="stylesheet" href="css/slick-theme.css" />
    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        .tb {
            border: 1px solid black;
        }

        .cart-btns1>a {
            display: inline-block;
            width: calc(70% - 0px);
            padding: 12px;
            background-color: #D10024;
            color: #FFF;
            text-align: center;
            font-weight: 700;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li><a href="bill.php"><i class="fa fa-dollar"></i> Bill </a></li>
                    <?php } ?>
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <li><a href="login.php"><i class="fa fa-user-o"></i> My Account</a></li>
                    <?php } else {
                    ?>
                        <li><a href="logout.php?user=1"><i class="fa fa-user-o"></i>Logout</a></li>
                    <?php
                    } ?>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="index.php" class="logo">
                                <img src="./images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form method="get" action="store.php">
                                <select class="input-select">
                                    <option value="0">All Categories</option>
                                </select>
                                <input class="input" placeholder="Search here" name="keyword">
                                <button value="submit" class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">0</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty"><?php echo sizeof($_SESSION['giohang']) ?></div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <?php
                                        for ($j = 0; $j < sizeof($_SESSION['giohang']); $j++) {
                                            for ($i = 0; $i < sizeof($array); $i++) {
                                                if ($array[$i]['ID'] == $_SESSION['giohang'][$j][0]) {
                                                    $value = $array[$i];
                                                    $tong += $value['price'] * $_SESSION['giohang'][$j][1];
                                        ?>
                                                    <div class="product-widget">
                                                        <div class="product-img">
                                                            <img src="./images/<?php echo $value['image'] ?>" alt="">
                                                        </div>
                                                        <div class="product-body">
                                                            <h3 class="product-name"><a href="details_product.php?product_id=<?php echo $value['ID'] ?>"><?php echo ($value['Name']) ?></a></h3>
                                                            <h4 class="product-price"><span class="qty"><?php echo $_SESSION['giohang'][$j][1] ?></span><?php echo number_format($value['price']) ?></h4>
                                                        </div>
                                                        <a href="<?php echo $url . "&delete=" . $j ?>">
                                                            <button class="delete"><i class="fa fa-close"></i></button>
                                                        </a>
                                                    </div>
                                        <?php }
                                            }
                                        } ?>

                                    </div>
                                    <div class="cart-summary">
                                        <small><?php echo sizeof($_SESSION['giohang']) ?> Item(s) selected</small>
                                        <h5>SUBTOTAL: <?php echo number_format($tong) ?></h5>
                                    </div>
                                    <?php if (sizeof($_SESSION['giohang']) > 0) { ?>
                                        <div class="cart-btns">
                                            <a href="blank.php">View Cart</a>
                                            <a href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->