<?php

try {
    include '../backend_web/getItemCalendar.php';
    $class = new getItemCalendar();
    echo $class->getData($_POST['productID']);
}
catch (Exception $e) {
}