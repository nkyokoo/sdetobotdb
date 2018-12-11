<?php
class DBConnection
{
    public function getConnection()
    {
        $con = new mysqli("localhost", "root", "", "booking", 3306);
        if (mysqli_connect_errno()) {
            return null;
        } else {
            $con->set_charset("utf8");
            return $con;
        }
    }
}

