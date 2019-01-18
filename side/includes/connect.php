<?php
class DBConnection
{
    public function getConnection()
    {
        try {
            $con = new mysqli("localhost", "root", "", "sdebookingsystem", 3306);
            if (mysqli_connect_errno()) {
                return null;
            } else {
                $con->set_charset("utf8");
                return $con;
            }
        } catch (Exception $e) {
        }
    }
}

