<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
if (isset($_GET['id'])) {
    $file = "../images/" . $product->getProductById($_GET['id'])[0]['image'];
    unlink($file);
    $product->delete_product($_GET['id']);
    header("location:products.php");
}
if (isset($_GET['manu_id'])) {
    $product->delete_manufactures($_GET['manu_id']);
    header("location:manufacture.php");
}
if (isset($_GET['type_id'])) {
    $product->delete_protypes($_GET['type_id']);
    header("location:protypes.php");
}
