<?php
include "../backend/bookingsend.php";

try {
    $class = new bookingSend();
    $class->sendBooking();
} catch (Exception $e) {
    die("Error: ".$e->getMessage());
}