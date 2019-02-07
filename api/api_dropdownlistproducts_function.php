<?php
try {
    include ("../backend/dropdownlistproducts_function.php");
    $class = new dropDownlistProducts_Function();
    $class->addProductsForSelection();
} catch (Exception $e) {
}
