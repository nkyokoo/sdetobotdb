<?php
include ('C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\session.php');


// submit = add to cart
// remove = remove product
// clear = clear cart

class Cart{
    //Declare global products variable
    var $products = array();
    //$PID = product id
    //$qts = quantity
    function add($PID, $qts){

        try {
            if ($qts > 0) {
                $productInCart = false;

                if (isset($_SESSION["cart"])) {
                    $productsInCart = $this->showSavedInCart();

                    // Associative array
                    foreach ($productsInCart as $productID => $quantity) {
                        // Found the right product in cart
                        if ($PID == $productID) {
                            //increase the quantity
                            $quantity = (int)$qts + $quantity;
                            //override old quantity

                            //this product is in cart
                            $productInCart = true;
                        }
                        //override old quantity
                        $this->products[$productID] = $quantity;

                    }

                }

                //if product is new
                if ($productInCart == false) {
                    //insert into cart
                    $this->products[$PID] = $qts;
                }
                //save
                $this->save();
            }
        } catch (Exception $e) {
        }


    }

    function onChangeQuantityInput($qts,$pid){

        try {
            //if the quantity is over 0
            if ($qts > 0) {
                if (isset($_SESSION['cart'])) {
                    //get the products from cart
                    $productsInCart = $this->showSavedInCart();

                    foreach ($productsInCart as $productID => $quantity) {
                        //check if product is the right one
                        if ($productID == $pid) {
                            //override quantity
                            $quantity = $qts;
                        }
                        //override old quantity
                        $this->products[$productID] = $quantity;

                    }
                }
            }
            // else remove the item
            else {

                $this->remove($pid);

            }
            //save
            $this->save();

        } catch (Exception $e) {
        }

    }

    function remove($PID){
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
        } catch (Exception $e) {
        }


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

