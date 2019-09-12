<?php
include_once '../backend_web/products.php';

try{
    $class = new Products();

    $class->getProducts();

}
catch (Exception $e){

}