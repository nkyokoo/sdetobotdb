<?php
try {
    include "../backend/dropdownlistproducts_function.php";
    $class = new DropDownlistProducts_Function();
    $class->addProductsForSelection();
} catch (Exception $e) {
}