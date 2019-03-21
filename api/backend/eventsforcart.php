<?php
session_start();
include_once "connect.php";

// submit = add to cart
// remove = remove product
// clear = clear cart

class API_Cart{
    //Declare global products variable

    //Get Total Units in stock and return it
    function productUnitsInStock($pid){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $pid = $mysql->real_escape_string($pid);
        $sql = "SELECT COUNT(id) FROM `product_unit_e` WHERE products_id = ".$pid ." AND current_status_id = 1";

        $sql = $mysql->query($sql);

        //Get Total Unit in Stock
        $unitRecordsOfProduct = $sql->fetch_assoc();
        //Return the Result
        $mysql->close();

        return $unitRecordsOfProduct['COUNT(id)'];

    }

}

