<?php
require "config.php";
require "models/db.php";
require "models/product.php";
$product = new Product;
$ktranhap = 1;
if (isset($_POST['submit_product'])) {
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
        $id = $_POST['id'];
        $name = $_POST['name'];
        $name = str_replace('/\s+/', ' ', $name);
        $manu_id = $_POST['manu_id'];
        $type_id = $_POST['type_id'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $description = str_replace('/\s+/', ' ', $description);
        $feature = $_POST['feature'];
        $image = $product->getProductById($id)[0]['image'];
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name) || !preg_match("/^[a-zA-Z0-9 ]*$/", $description)) {
            $ktranhap = 0;
        }
        if (strlen($_FILES['fileupload']['name']) > 0) {
            $image = $_FILES['fileupload']['name'];
        }
        if ($ktranhap == 1) {
            $product->edit_product($name, $manu_id, $type_id, $price, $image, $description, $feature, $id);
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
if (isset($_POST['submit_prodtypes'])) {
    $type_id = $_POST['type_id'];
    $type_name = $_POST['type_name'];
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $ktranhap = 0;
    }
    if ($ktranhap == 1) {
        $product->edit_Protypes($type_id, $type_name);
        header("location:protypes.php");
    }else {
        echo "Không thể upload dữ liệu do nhập kiểu dữ liệu.<br>";
        echo '
            <form action="manufacture.php">
                <input type="submit" value="Thoát" >
            </form>';
    }
}
if (isset($_POST['submit_manufacture'])) {
    $manu_id = $_POST['manu_id'];
    $manu_name = $_POST['manu_name'];
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $ktranhap = 0;
    }
    if ($ktranhap == 1) {
        $product->edit_Manufactures($manu_id, $manu_name);
        header("location:manufacture.php");
    }else {
        echo "Không thể upload dữ liệu do nhập kiểu dữ liệu.<br>";
        echo '
            <form action="manufacture.php">
                <input type="submit" value="Thoát" >
            </form>';
    }
}
