<?php
session_start();
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
    //Get Total Units in stock and return it
    function productUnitsInStock($pid){

        //Request to API
        $url = 'http://localhost:8000/api/booking/eventsforcart/productunitsinstock';
        $data = array('pid' => $pid);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json",
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
//send request to api and get result
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */

            var_dump($result);
        }
        return $result;


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
    function displayCart()
    {

        echo "<form><div class='card'>";
        echo "<div class='card-body'>";
        echo "<button id='button-clear'>Clear Cart</button>";
        echo "<h5 class='card-header'>Products In Cart</h5>";

//  echo "product = ".$key. " quantity = ".$quantity." || ";
        if (isset( $_SESSION['cart']) and !empty($_SESSION['cart'])){
            $incart = $_SESSION["cart"];
            foreach ($incart as $pid => $quantity){
                //Request to API

                $url = 'http://localhost:8000/api/booking/eventsforcart/display';
                $data = array('pid' => $pid,'quantity' => $quantity);

// use key 'http' even if you send the request to https://...
                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json",
                        'method'  => 'POST',
                        'content' => json_encode($data)
                    )
                );
//send request to api and get result
                $context  = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                echo $result;
                if ($result === FALSE) { /* Handle error */

                    var_dump($result);
                }
            }

            echo "<button id='button-booking'>Buy EVERYTHING ON THIS LIST</button></div></div> ";

        }
        echo "</div></div></form>";
    }
}

