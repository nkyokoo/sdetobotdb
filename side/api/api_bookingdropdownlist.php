<?php
include "../backend/bookingdropdownlist.php";

try {
    $class = new bookingdropdownlist();
    $class->createOptionsForSelection();
} catch (Exception $e) {

}