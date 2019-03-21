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

    function display($pid, $quantity){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $sql = "SELECT id,product_name,description,movable FROM school_products WHERE id =".$pid;
        $result = $mysql->query($sql);

        if ($result->num_rows > 0) {
            //Default Selection

            //Populate Selection box with data from DB
            while ($row = $result->fetch_assoc()) {
                echo "<div class='row'> <div class='col'>
                  <div class='card'>
                  <div class='card-body'>
                  <h5 class='card-title'>" .$row['product_name']."</h5>
                  <h6 class='card-subtitle mb-2 text-muted'>Moveable: ".$row['movable']."</h6>
                  <p class='card-text'>".$row['description'].".</p>
                  <label>Quantity: <input id='product-quantity-".$pid."' type='number' value='".$quantity."' name='product-quantity-".$pid."'></label><button id='button-remove".$pid."'>Remove</button>
                  </div>
                  </div>
                  </div>
                  </div>";

            }

        }else{
            echo "ERROR 404. No connection to Server. If you have Addblock on try to disable it or Contact Support. Thank you!";

        }
        $mysql->close();
    }

}

