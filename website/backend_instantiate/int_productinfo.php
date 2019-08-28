<?php
include_once '../backend_web/productinfo.php';

try{
    $class = new Productinfo();

    $class->getProductInfo();

}
catch (Exception $e){
}