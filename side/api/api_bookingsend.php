<?php
include "../backend/bookingsend.php";

try {
    $class = new bookingsend();
    $class->sendBooking();
} catch (Exception $e) {
    die("Error: ".$e->getMessage());
}