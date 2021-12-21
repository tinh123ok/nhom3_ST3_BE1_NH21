<?php
class user extends Db
{
    function checkLogin($username, $password)
    {
        $sql = self::$connection->prepare("SELECT * from user where `username` =? and 
        `password` =?");
        $password = md5($password);
        $sql->bind_param("ss", $username, $password);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->num_rows;
        if ($items == 1) {
            return true;
        } else {
            return false;
        }
    }
    function createuser($fullname, $phone, $username, $password)
    {
        $sql = self::$connection->prepare("INSERT INTO `user`(`fullname` , `phone`, `username`, `password`)
         VALUES (?,?,?,?)");
        $password = md5($password);
        $sql->bind_param("ssss", $fullname, $phone, $username, $password);
        return $sql->execute();
    }
    function checkregisgter($username)
    {
        $sql = self::$connection->prepare("SELECT * from user where `username` = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->num_rows;
        if ($items == 1) {
            return false;
        } else {
            return true;
        }
    }

    function check_Barcode($Barcode)
    {
        $sql = self::$connection->prepare("SELECT * FROM `bill` WHERE `Barcode` = ?;");
        $sql->bind_param("s", $Barcode);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->num_rows;
        if ($items == 1) {
            return false;
        } else {
            return true;
        }
    }
    function random_Barcode($user)
    {
        $x = rand(0, 100000);
        while ($user->check_Barcode($x) == false) {
            $x = rand(0, 100000);
        }
        return $x;
    }
    function createbill($Barcode, $fullname, $username, $address, $phone, $ordernotes)
    {
        $sql = self::$connection->prepare("INSERT INTO `bill`(`Barcode`, `fullname`, `username`, `address`, `phone`,`ordernotes`)
         VALUES (?,?,?,?,?,?)");
        $sql->bind_param("ssssss", $Barcode, $fullname, $username, $address, $phone, $ordernotes);
        return $sql->execute();
    }
    function addbill($bill_id, $product_id, $quantily)
    {
        $sql = self::$connection->prepare("INSERT INTO `detailsbill`(`bill_id`, `product_id`, `quantily`) VALUES (?,?,?)");
        $sql->bind_param("iii", $bill_id, $product_id, $quantily);
        return $sql->execute();
    }
    function getbill_id($Barcode)
    {
        $sql = self::$connection->prepare("SELECT * FROM `bill` WHERE `Barcode` = ?");
        $sql->bind_param("s", $Barcode);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        if (sizeof($items) > 0) {
            return $items[0]['bill_id'];
        } else {
            return -1;
        }
    }
    function getbillbyusername($username){
        $sql = self::$connection->prepare("SELECT * FROM `bill` WHERE `username` = ?");
        $sql->bind_param("s", $username);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;
    }
    function getitembybillid($bill_id){
        $sql = self::$connection->prepare("SELECT * FROM `detailsbill` WHERE `bill_id` = ?");
        $sql->bind_param("i", $bill_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;  
    }
    function getbillbybill_id($bill_id){
        $sql = self::$connection->prepare("SELECT * FROM `bill` WHERE `bill_id` = ?");
        $sql->bind_param("i", $bill_id);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
        return $items;  
    }
    function deletebill($bill_id){
        $sql = self::$connection->prepare("DELETE FROM `bill` WHERE `bill_id` = ?;");
        $sql->bind_param("i", $bill_id);
        return $sql->execute();
    }function deletedetailsbill($bill_id){
        $sql = self::$connection->prepare("DELETE FROM `detailsbill` WHERE `bill_id` = ?;");
        $sql->bind_param("i", $bill_id);
        return $sql->execute();
    }
}
