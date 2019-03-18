<?php
/*we use this file for connection to db. we want the code in object oriented*/
class DBConnection
{
    public function getConnection()
    {
        try {
            $con = new mysqli("localhost", "root", "", "sdebookingsystem");
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
                return null;
            } else {
                $con->set_charset("utf8");
                return $con;
            }
        } catch (Exception $e) {
        }
    }
}
