<?php
include "../backend/bookingsend.php";

try {
    $class = new bookingSend();

    if (!empty($_POST['item_1']))
        $class->sendBooking(1);

    if (!empty($_POST['item_11']))
        $class->sendBooking(2);

} catch (Exception $e) {
    die("Error: ".$e->getMessage());
}