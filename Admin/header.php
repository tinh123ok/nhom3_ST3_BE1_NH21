<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
function active($sp)
{
  $url = $_SERVER['PHP_SELF'];
  if (strpos($url, $sp)) {
    echo "active";
  }
}
function menu_open($sp)
{
  $url = $_SERVER['PHP_SELF'];
  if (strpos($url, $sp)) {
    echo "menu-open";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="products.php" class="nav-link">Products</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="manufacture.php" class="nav-link">manufactures</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="protypes.php" class="nav-link">Protypes</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Nhóm 3</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item <?php menu_open("products") ?>">
              <a href="#" class="nav-link <?php active("products") ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Products
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./products_add.php" class="nav-link <?php active("products_add") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Product</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./products.php" class="nav-link <?php active("products.php") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit Product</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item <?php menu_open("manufacture") ?>">
              <a href="#" class="nav-link <?php active("manufacture") ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Manufacture
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview ">
                <li class="nav-item">
                  <a href="./manufacture_add.php" class="nav-link <?php active("manufacture_add") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Manufacture</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./manufacture.php" class="nav-link <?php active("manufacture.php") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit Manufacture</p>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item <?php menu_open("protypes") ?>">
              <a href="#" class="nav-link <?php active("protypes") ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Protypes
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./protypes_add.php" class="nav-link <?php active("protypes_add.php") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Protype</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./protypes.php" class="nav-link <?php active("protypes.php") ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edit Protype</p>
                  </a>
                </li>

              </ul>
            </li>
            <li class="nav-item">
              <a href="../logout.php" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p>
                  Log Out
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
            </li>



            

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>