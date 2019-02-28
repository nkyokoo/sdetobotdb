<?php
require_once "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";
require_once "bookingdropdownlist.php";
class dropDownlistProducts_Function{


    function addProductsForSelection(){

        try {
            $class = new  bookingSelectEnheder();
            $connection = new DBConnection();
            $mysqli = $connection->getConnection();

            //Select products to Selection box which you haven't choosing yet
            // WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
            $sql = "SELECT id,product_name,description,movable FROM school_products";
            $result = $mysqli->query($sql);
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-header'>Featured Products</h5>";
            if ($result->num_rows > 0) {
                //Default Selection


                //Populate Selection box with data from DB
                while ($row = $result->fetch_assoc()) {
                    $item = $class->createOptionsForSelection($row['id']);


                    echo "<div class='row'> <div class='col'>
                          <div class='card'>
                          <div class='card-body'>
                          <h5 class='card-title'>" .$row['product_name']."</h5>
                          <h6 class='card-subtitle mb-2 text-muted'>Moveable: ".$row['movable']."</h6>
                          <p class='card-text'>".$row['description'].".</p>
                          <select id='product-unit-".$row['id']."'>".$item."</select><button id='btn-".$row['id']."')>Add to Cart</button></div>
                          </div>
                          </div>
                          </div>";


                }
            }
            echo "</div></div>";

            $mysqli->close();
        } catch (Exception $e) {
        }
    }
}


