<?php
class DBConnection
{


    public function getConnection()
    {

        $con = new mysqli("localhost", "root", "", "booking", 3306);


        if (mysqli_connect_errno()) {
            return null;
        } else {
            return $con;
        }
    }
}

?>

