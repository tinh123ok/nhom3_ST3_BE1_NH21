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
}
