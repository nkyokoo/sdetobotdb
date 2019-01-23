<?php
include "../includes/connect.php";
class bookingSelectEnheder{

    //Populate Units/Enhed Selection box For the choosing Product
    public function createOptionsForSelection(){

        try {
            $con = new DBConnection();
            $mysqli = $con->getConnection();
            $selectedItem = $_POST['item_id'];

            //Check if the chosen Product is a Product.
            if (!empty($_POST['item_id'])) {
                $enhedCounter = 1;
                    //Select all Units of specific Product where Status is 1 => Available
                $sql = "SELECT id FROM product_unit_e where products_id = " . $selectedItem . " AND current_status_id = 1";
                $result = $mysqli->query($sql);

                //Check if there's any Units/Enhed available
                if ($result->num_rows > 0) {
                    echo '<option value="">Select Enheder</option>';
                    //Fetch Units/Enhed Data from the Database.
                    while ($row = $result->fetch_assoc()) {


                        echo '<option value="' . $enhedCounter . '">' . $enhedCounter . '</option>';
                        $enhedCounter += 1;
                        // }

                    }
                }
                // if none Units/Enhed available
                else {
                    echo '<option value="">Ingen Enheder Ledige</option>';

                }


            }
            $mysqli->close();
        } catch (Exception $e) {
        }
    }
}

