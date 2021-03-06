<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;

if (isset($_POST['submit_manufacture'])) {
    $name = $_POST['name'];
    $ktranhap =1;
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $ktranhap = 0;
    }
    if ($ktranhap == 1) {
        $product->addManufactures($name);
        header("location:manufacture.php");
    }else {
        echo "Không thể upload dữ liệu do nhập kiểu dữ liệu.<br>";
        echo '
            <form action="manufacture.php">
                <input type="submit" value="Thoát" >
            </form>';
    }
}
if (isset($_POST['submit_protypes'])) {
    $ktranhap = 1;
    $name = $_POST['name'];
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $ktranhap = 0;
    }
    if ($ktranhap == 1) {
        $product->addProtypes($name);
        header("location:protypes.php");
    } else {
        echo "Không thể upload dữ liệu do nhập kiểu dữ liệu.<br>";
        echo '
            <form action="protypes.php">
                <input type="submit" value="Thoát" >
            </form>';
    }
}
if (isset($_POST['submit_product'])) {
    $ktranhap = 1;
    $target_dir;
    $target_file;
    $uploadOk = 1;
    $imageFileType;
    if (isset($_FILES['fileupload']['name']) && strlen($_FILES['fileupload']['name']) > 0) {
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["fileupload"]["size"] > 500000) {
            echo $_FILES["fileupload"]["size"];
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 0 && strlen($_FILES['fileupload']['name']) > 0) {
        echo "Sorry, your file was not uploaded.<br>";
        echo '
    <form action="products.php">
        <input type="submit" value="Thoát" >
    </form>';
    } else {
        $name = trim($_POST['name']);
        $manu_id = $_POST['manu_id'];
        $type_id = $_POST['type_id'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $feature = $_POST['feature'];
        $image = $_FILES['fileupload']['name'];
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name) || !preg_match("/^[a-zA-Z0-9 ]*$/", $description)) {
            $ktranhap = 0;
        }
        if ($ktranhap == 1) {
            $product->addProduct($name, $manu_id, $type_id, $price, $image, $description, $feature);
            if (!file_exists($target_file) && strlen($_FILES['fileupload']['name']) > 0) {
                move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file);
            }
            header("location:products.php");
        } else {
            echo "Không thể upload dữ liệu do nhập kiểu dữ liệu.<br>";
            echo '
                <form action="products.php">
                    <input type="submit" value="Thoát" >
                </form>';
        }
    }
}
// if (isset($_POST['submit_product'])) {
//     $name = $_POST['name'];
//     $manu_id = $_POST['manu_id'];
//     $type_id = $_POST['type_id'];
//     $price = $_POST['price'];
//     $description = $_POST['description'];
//     $feature = $_POST['feature'];
//     $image = $_FILES['fileupload']['name'];
//     $product->addProduct($name, $manu_id, $type_id, $price, $image, $description, $feature);
    
//     $target_dir = "../images/";
//     $target_file = $target_dir . basename($_FILES["fileupload"]["name"]);
//     move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file);
//     header('location:products.php');
// }
