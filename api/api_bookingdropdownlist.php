<?php
include "../backend/bookingdropdownlist.php";

try {
    $class = new bookingSelectEnheder();
    $class->createOptionsForSelection($item);
} catch (Exception $e) {

}