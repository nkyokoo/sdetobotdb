<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 31/01/2019
 * Time: 09.03
 */

include "includes/header.php";
include "includes/navbar.php";
include 'includes/sidebar.php';

?>
    <script type="text/javascript" src="assets/js/cart.js"></script>

<?php
session_start();
include_once "includes\connect.php";
$connection = new DBConnection();
$mysqli = $connection->getConnection();
echo "<form><div class='card'>";
echo "<div class='card-body'>";
echo "<button id='button-clear'>Clear Cart</button>";
echo "<h5 class='card-header'>Products In Cart</h5>";

//  echo "product = ".$key. " quantity = ".$quantity." || ";
if (isset( $_SESSION['cart']) and !empty($_SESSION['cart'])){
    $incart = $_SESSION["cart"];
    $error = false;
    foreach ($incart as $pid => $quantity){
//Select products to Selection box which you haven't choosing yet
// WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
        $sql = "SELECT id,product_name,description,movable FROM school_products WHERE id =".$pid;
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
                  <label>Quantity: <input id='product-quantity-".$pid."' type='number' value='".$quantity."' name='product-quantity-".$pid."'></label><button id='button-remove".$pid."'>Remove</button>
                  </div>
                  </div>
                  </div>
                  </div>";

            }

        }else{
            $error = true;
        }
    }
    if ($error){
        echo "ERROR 404. No connection to Server. If you have Addblock on try to disable it or Contact Support. Thank you!";

    }
    echo "<button id='button-booking'>Buy EVERYTHING ON THIS LIST</button></div></div> ";

}
echo "</div></div></form>";
$mysqli->close();
include "includes/footer.php";
