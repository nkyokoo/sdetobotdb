<?php
require_once "C:\Users\aznzl\Desktop\Github\sdetobotdb\side\includes\connect.php";
class bookingSelectEnheder{

    //Populate Units/Enhed Selection box For the choosing Product
    public function createOptionsForSelection($item){

        try {
            $con = new DBConnection();
            $mysqli = $con->getConnection();
          //  $selectedItem = $_POST['item_id'];
            $item = mysqli_real_escape_string($mysqli,$item);
            //Check if the chosen Product is a Product.
                $string = '';
                $enhedCounter = 1;
                    //Select all Units of specific Product where Status is 1 => Available
                $sql = "SELECT id FROM product_unit_e where products_id = " . $item . " AND current_status_id = 1";
                $result = $mysqli->query($sql);

                //Check if there's any Units/Enhed available
                if ($result->num_rows > 0) {
                   // echo '<option value="">Select Enheder</option>';
                    //Fetch Units/Enhed Data from the Database.
                    while ($row = $result->fetch_assoc()) {

                        $string .= '<option value="' . $enhedCounter . '">' . $enhedCounter . '</option>';
                        $enhedCounter += 1;
                        // }

                    }
                    $mysqli->close();

                    return $string;
                }
                // if none Units/Enhed available
                else {
                    $mysqli->close();
                    return $string = '<option value="">Ingen Enheder Ledige</option>';

                }



        } catch (Exception $e) {
        }
    }
}

