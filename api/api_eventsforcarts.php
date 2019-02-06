<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 30/01/2019
 * Time: 13.03
 */
include_once "C:/Users/aznzl/Desktop/Github/sdetobotdb/side/backend/eventsforcart.php";
try {
    $cart = new Cart();
    //Check which of the three buttons you've clicked on

    // Add product to cart
    if (isset($_POST['submit'])){
        $cart->add($_POST['PID'],$_POST['quantity']);
    }
    // Remove product
    if (isset($_POST['remove'])){
        $cart->remove($_POST['PID']);
    }
    // Clear Cart
    if (isset($_POST['clear'])){
        $cart->clear();
    }
    //Change quantity value
    if (isset($_POST['onChangeQuantity']) and isset($_POST['PID'])){
        $cart->onChangeQuantityInput($_POST['onChangeQuantity'],$_POST['PID']);
    }


} catch (Exception $e) {
}
