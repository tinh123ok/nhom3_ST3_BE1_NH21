<?php
class admin extends Db
{
    function checkLogin($adminname, $password)
    {
        $sql = self::$connection->prepare("SELECT * from admin where `adminname` =? and 
        `password` =?");
        $password = md5($password);
        $sql->bind_param("ss", $adminname, $password);
        $sql->execute();
        $items = array();
        $items = $sql->get_result()->num_rows;
        if ($items == 1) {
            return true;
        } else {
            return false;
        }
    }
}
