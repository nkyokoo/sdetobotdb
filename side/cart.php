<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 31/01/2019
 * Time: 09.03
 */
include ("includes/header.php");
include ("includes/navbar.php");
?>
    <script type="text/javascript" src="assets/js/cart.js"></script>

<?php
include_once "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";
session_start();
$connection = new DBConnection();
$mysqli = $connection->getConnection();
$incart = $_SESSION["cart"];
echo "<div class='card'>";
echo "<div class='card-body'>";
echo "<button onclick='clearCart()'>Clear Cart</button>";
echo "<h5 class='card-header'>Products In Cart</h5>";

//  echo "product = ".$key. " quantity = ".$quantity." || ";
foreach ($incart as $key => $quantity){

//Select products to Selection box which you haven't choosing yet
// WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
    $sql = "SELECT id,product_name,description,movable FROM school_products WHERE id =".$key;
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        //Default Selection


        //Populate Selection box with data from DB
        while ($row = $result->fetch_assoc()) {

            echo "<div class='row'> <div class='col'>
                  <div class='card'>
                  <div class='card-body'>
                  <h5 class='card-title'>" .$row['product_name']."</h5>
                  <h6 class='card-subtitle mb-2 text-muted'>Moveable: ".$row['movable']."</h6>
                  <p class='card-text'>".$row['description'].".</p>
                  <p>Quantity:  <input id='product-quantity-".$key."' type='tel' value='".$quantity."' name='product-quantity-".$key."' onchange='onChangeQuantity(this.value,".$key.")'></p><button onclick='removeProduct(".$key.")'>Remove</button></div>
                  </div>
                  </div>
                  </div>";


        }
    }
}
echo "</div></div>";

$mysqli->close();
include "includes/footer.php";
