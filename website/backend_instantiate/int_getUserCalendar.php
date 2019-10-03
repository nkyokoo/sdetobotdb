<?php
include '../backend_web/getUserCalendar.php';
try{
        $class = new getUserCalendar();
        echo $class->getUserWishlistData();

}catch (Exception $e){

}