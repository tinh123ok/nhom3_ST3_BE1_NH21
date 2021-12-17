<?php
session_start();
if (isset($_GET['user'])) {
    unset($_SESSION['user']);
    header('location:index.php');
}
if(isset($_GET['admin'])){
    unset($_SESSION['admin']);
    header('location:index.php');
}

