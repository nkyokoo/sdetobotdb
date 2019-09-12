<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 25/03/2019
 * Time: 14.24
 */
include "../backend_web/dropdownlist_products.php";

$class = new dropdownlist_products();

$search = isset($_POST['search']) ? true:false;
if ($search){
    $class->addProductsForSelection($_POST['sdate'],$_POST['edate'],$_POST['search']);

}
else{

    $class->addProductsForSelection($_POST['sdate'],$_POST['edate']);
}
