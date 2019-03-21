<?php



require_once "connect.php";
class DropDownlistProducts_Function{

    function addProductsForSelection(){



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
                    $item = $this->createOptionsForSelection($row['id']);


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
            }else{

                echo "ERROR 404. No connection to server.  Your firewall may have been blocking our request. Contact Support. Thank you!";
            }
            echo "</div></div>";

            $mysqli->close();
        }

    //Populate Units/Enhed Selection box For the choosing Product
    function createOptionsForSelection($item)
    {


        $con = new DBConnection();
        $mysqli = $con->getConnection();
        //  $selectedItem = $_POST['item_id'];
        $item = $mysqli->real_escape_string($item);
        //Check if the chosen Product is a Product.
        $string = '';
        $enhedCounter = 1;
        //Select all Units of specific Product where Status is 1 => Available
        $sql = "SELECT id FROM product_unit_e where products_id = " . $item . " AND current_status_id = 1";
        $result = $mysqli->query($sql);

        //Check if there's any Units/Enhed available
        if ($result->num_rows > 0)
        {
            // echo '<option value="">Select Enheder</option>';
            //Fetch Units/Enhed Data from the Database.
            while ($row = $result->fetch_assoc())
            {

                $string .= '<option value="' . $enhedCounter . '">' . $enhedCounter . '</option>';
                $enhedCounter += 1;
                // }

            }
            $mysqli->close();


        } // if none Units/Enhed available
        else
            {
            $mysqli->close();
            $string = '<option value="">Ingen Enheder Ledige</option>';

        }

        return $string;

    }


}


