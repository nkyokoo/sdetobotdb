<?php

try {
    include "../backend/displaycart.php";
    $class = new DisplayCart();
    $class->cartItems();
} catch (Exception $e) {
}