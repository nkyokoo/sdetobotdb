<?php
session_start();
include_once "../includes/connect.php";

// submit = add to cart
// remove = remove product
// clear = clear cart

class Cart{
    //Declare global products variable
    var $products = array();
    //$PID = product id
    //$qts = quantity

    function add($PID, $qts){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $PID = mysqli_real_escape_string($mysql,$PID);
        $qts = mysqli_real_escape_string($mysql,$qts);
        try {
            $con = new DBConnection();
            $mysql = $con->getConnection();
            if ($qts > 0) {
                $PID = mysqli_real_escape_string($mysql,$PID);
                $qts = mysqli_real_escape_string($mysql,$qts);
                $unitsInStock = $this->productUnitsInStock($PID);

                $productInCart = false;
               $qts = intval($qts);
                if ($unitsInStock >= $qts and $unitsInStock > 0 ){
                if (isset($_SESSION["cart"])) {
                    //Get all Products in Cart
                    $productsInCart = $this->showSavedInCart();
                    //Get Total number of Untis in stock for specific Item

                    // Associative array
                    foreach ($productsInCart as $productID => $quantity) {
                        // Found the right product in cart
                        if ($PID == $productID) {
                            //Check if the Total input is more than Total units in stuck
                            if (($qts + $quantity) > $unitsInStock){
                                //Override quantity to Total units in stock.
                                $quantity = (int)$unitsInStock;
                            }
                            else{
                                //increase the quantity
                                $quantity = (int)$qts + $quantity;
                            }

                            //this product is in cart
                            $productInCart = true;
                        }
                        //override old quantity
                        $this->products[$productID] = $quantity;

                    }

                }

                //if product is not in cart / product is new
                if ($productInCart == false) {
                    //insert product into cart
                    $this->products[$PID] = $qts;
                }

                    //save
                    $this->save();
                }else{echo "We don't have enough in stock of chosen product. \r\nPlease Reduce the amount.";}

            }
            $mysql->close();
        } catch (Exception $e) {
        }


    }

    function onChangeQuantityInput($qts,$pid){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $pid = mysqli_real_escape_string($mysql,$pid);
        $qts = mysqli_real_escape_string($mysql,$qts);
        try {
            //if the quantity is over 0
            if ($qts > 0) {

                if (isset($_SESSION['cart'])) {
                    //get the products from cart
                    $productsInCart = $this->showSavedInCart();
                    //Get total Units in stock
                    $unitsInStock = $this->productUnitsInStock($pid);
                    foreach ($productsInCart as $productID => $quantity) {
                        //check if product is the right one
                        if ($productID == $pid)
                        {
                            // Check If the input qts is over Total units in stock
                            if ($qts > $unitsInStock){
                                //Become the Total units in stock
                                echo "You've chosen over the maximum amount in stock.";
                                $quantity = $unitsInStock;
                            }else{
                                //override quantity
                                $quantity = $qts;
                            }


                        }
                        //override old quantity
                        $this->products[$productID] = $quantity;

                    }
                }
            }
            // else remove the item
            else {
                //Remove Product
                $this->remove($pid);

            }
            //save
            $this->save();
            $mysql->close();

        } catch (Exception $e) {
        }

    }

    function remove($PID){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $PID = mysqli_real_escape_string($mysql,$PID);
        try {
            //check if cart exist
            if (isset($_SESSION["cart"])) {
                //get the products from cart

                $productsInCart = $this->showSavedInCart();

                foreach ($productsInCart as $productID => $quantity) {
                    if ($productID == $PID) {
                        //Unset element in array
                        unset($this->products[$productID]);

                    } else {
                        //override old quantity
                        $this->products[$productID] = $quantity;
                    }


                }

            }
            //save
            $this->save();
            $mysql->close();

        } catch (Exception $e) {
        }


    }
    //Get Total Units in stock and return it
    function productUnitsInStock($pid){
        $con = new DBConnection();
        $mysql = $con->getConnection();
        $pid = mysqli_real_escape_string($mysql,$pid);
        $sql = "SELECT COUNT(id) FROM `product_unit_e` WHERE products_id = ".$pid ." AND current_status_id = 1";

        $sql = $mysql->query($sql);

        //Get Total Unit in Stock
        $unitRecordsOfProduct = $sql->fetch_assoc();
        //Return the Result
        $mysql->close();

        return $unitRecordsOfProduct['COUNT(id)'];

    }
    //Clear Cart
    function clear(){
        $_SESSION["cart"] = array();
    }

    // Get all Products in cart
    function showSavedInCart(){
        //return the session in array format
        return (array)$_SESSION["cart"];

    }

    //Save current change in cart
    function save(){
        //override the global variable $products to $_SESSION['cart']
        $_SESSION["cart"] = $this->products;
    }
}

