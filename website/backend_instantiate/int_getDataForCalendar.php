<?php
include '../backend_web/getDataForCalendar.php';

try{
    $class = new getDataForCalendar();

    echo $class->getWishlists();

}
catch (Exception $e){

}
