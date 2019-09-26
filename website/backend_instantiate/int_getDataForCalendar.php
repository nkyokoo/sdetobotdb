<?php
include '../backend_web/getDataForCalendar.php';

try{
    $class = new getDataForCalendar();

    $class->getWishlists();

}
catch (Exception $e){

}
