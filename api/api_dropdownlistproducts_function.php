<?php
try {
    include ("C:\Users\aznzl\Desktop\Github\sdetobotdb\side\backend\dropdownlistproducts_function.php");
    $class = new dropDownlistProducts_Function();
    $class->addProductsForSelection();
} catch (Exception $e) {
}