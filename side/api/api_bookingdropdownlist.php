<?php
include "../backend/bookingdropdownlist.php";

try {
    $class = new bookingSelectEnheder();
    $class->createOptionsForSelection();
} catch (Exception $e) {

}