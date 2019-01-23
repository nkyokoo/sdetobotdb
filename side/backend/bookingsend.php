<?php
//include('session.php');
include_once "../includes/connect.php";
class bookingSend{
    //Mangler at sendes til faktura og gennem gå hele processen.
    //Redirect to site if needed.
    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public function sendBooking($layer){

        try {
            $con = new DBConnection();
            $mysqli = $con->getConnection();
            $allProductsAreAvailable = true;
            $storeIDsFromUnits = "";

            // Length is a Upper Limit Counter for Outer Loop. It'll increase
            // Length => Next Product in line to be checked in db along with $i => Current Product
            //Change depend on Layer
            $length = $layer == 1 ? 2:12;
            //Layer 1 or 2
            //Loop The Selections and send to Database if the Selection has Value
            for ($i = $layer == 1 ? 1:11; $i < $length; $i++) {
                $enhedCounter = 0;
                    //Check if items and its units aren't empty
                if (!empty($_POST['item_' . $i]) and !empty($_POST['enhed_' . $i])) {
                    $item = $_POST['item_' . $i];
                    $enheder = $_POST['enhed_' . $i];

                    //Find the connected Units/Enhed to the item ID and correct status(in stock) in the database and
                    $sql = "SELECT product_unit_e.id FROM product_unit_e INNER JOIN school_products ON product_unit_e.products_id = school_products.id WHERE school_products.id = " . $item .
                        " AND product_unit_e.current_status_id = 1";

                    $result = $mysqli->query($sql);

                    if ($result->num_rows >= $enheder) {
                        //Increase Upper Limit if there's more Enheder/Units available.
                        $length += 1;

                        while ($row = $result->fetch_assoc() AND $enhedCounter < $enheder) {
                            //insert rows into a string instead of array
                           $storeIDsFromUnits .= $row['id'].",";
                            $enhedCounter += 1;
                        }
                        // ########################################################
                        // ############ Change this Location To Match Real Path ###
                        // ########################################################

                    }
                    else{$allProductsAreAvailable = false;}
                }
                else {break;}

            }
            if ($allProductsAreAvailable){
                $this->updateStatus($storeIDsFromUnits);
            }
            else{
                //Products Unavailable Message
                echo "alert('Some of the Products are Unavailable! Please Reload Site')";
            }

            $mysqli->close();
        } catch (Exception $e) {
        }
    }
    private function updateStatus($storedIDS){
        $con = new DBConnection();
        $mysqli = $con->getConnection();

            $storedIDS = explode(",",$storedIDS);
            for ($i = 0; $i < count($storedIDS); $i++){
                //Making sure the variable is int
              $storedIDSToInt = (int)$storedIDS[$i];
                //Update the status of the reserved units/enhed from (1 = Available) to (2 = Reserved) and $row['id'] = unit ID for product.
                $newSql = "UPDATE product_unit_e SET product_unit_e.current_status_id = 2 WHERE product_unit_e.id = ?";
               $stmt = $mysqli->prepare($newSql);
               $stmt->bind_param("i",$storedIDSToInt);
               $stmt->execute();
            }

        }
}

