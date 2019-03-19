<?php
include "../backend/bookingsend.php";

try {
    $class = new bookingSend();

    if (($_POST['choice']) == 0 and isset($_SESSION['cart'])){
        $class->sendBooking();
    }

    /*    if (!empty($_POST['item_11']))
            $class->sendBooking(2);
    */
} catch (Exception $e) {
    die("Error: ".$e->getMessage());
}