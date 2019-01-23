<?php
include "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";

class dropDownlistProducts_Function{


    function addProductsForSelection(){

        try {
            $connection = new DBConnection();
            $mysqli = $connection->getConnection();

            //Current products in use
            $selectedSelections = $_POST['selectedProducts'];

            //To make sure the variable isn't null or NaN
            if (!isset($selectedSelections)){
                $selectedSelections = "0";
            }
            //Select products to Selection box which you haven't choosing yet
            // WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
            $sql = "SELECT id,product_name FROM school_products WHERE id NOT IN (".$selectedSelections.")";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {

                //Default Selection
                echo "<option value=''>Select Item</option>";

                //Populate Selection box with data from DB
                while ($row = $result->fetch_assoc()) {



                    echo "<option value=" . $row['id'] . ">" . $row['product_name'] . "</option>";


                }

            }

            $mysqli->close();
        } catch (Exception $e) {
        }
    }
}


