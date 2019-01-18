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

    public function sendBooking(){

        try {
            echo "If You cant see the content then try disable ADDBLOCK";
            $con = new DBConnection();
            $mysqli = $con->getConnection();
            $length = 2;
            //Layer 1
            //Loop The Selections and send to Database if the Selection has Value
            for ($i = 1; $i < $length; $i++) {
                $enhedCounter = 0;
                //Get The Item IDs from Booking.php

                    //if item and its units aren't empty do something
                if (!empty($_POST['item_' . $i]) and !empty($_POST['enhed_' . $i])) {
                    $item = $_POST['item_' . $i];
                    $enheder = $_POST['enhed_' . $i];

                    //Find the connected Units/Enhed to the item ID and correct status(in stock) in the database and
                    $sql = "SELECT product_unit_e.id FROM product_unit_e INNER JOIN school_products ON product_unit_e.products_id = school_products.id WHERE school_products.id = " . $item .
                        " AND product_unit_e.current_status_id = 1";

                    $result = $mysqli->query($sql);

                    if ($result->num_rows >= $enheder) {
                        $length += 1;


                        while ($row = $result->fetch_assoc() AND $enhedCounter < $enheder) {
                            //Update the status of the reserved units/enhed from (3 = Available) to (1 = Reserved) and $row['id'] = unit ID for product.
                            $newSql = "UPDATE product_unit_e SET product_unit_e.current_status_id = 2 WHERE product_unit_e.id = " . $row['id'];
                            $mysqli->query($newSql);
                            $enhedCounter += 1;
                        }
                        // ########################################################
                        // ############ Change this Location To Match Real Path ###
                        // ########################################################

                    }
                }
                else {break;}

            }
            //Layer 2
            //Loop The Selections and send to Database if the Selection has Value
            $length = 12;
            for ($i = 11; $i < $length; $i++) {
                $enhedCounter = 0;

                if (!empty($_POST['item_' . $i]) and !empty($_POST['enhed_' . $i])) {
                    $item = $_POST['item_' . $i];
                    $enheder = $_POST['enhed_' . $i];
                    $sql = "SELECT product_unit_e.id FROM product_unit_e INNER JOIN school_products ON product_unit_e.products_id = school_products.id WHERE school_products.id = " . $item .
                        " AND product_unit_e.current_status_id = 1";

                    $result = $mysqli->query($sql);

                    if ($result->num_rows >= $enheder) {
                        $length += 1;


                        while ($row = $result->fetch_assoc() AND $enhedCounter < $enheder) {
                            //Update Status on the Unit/enhed and $row['id'] = unit ID for product.
                            $newSql = "UPDATE product_unit_e SET product_unit_e.current_status_id = 2 WHERE product_unit_e.id = " . $row['id'];
                            // echo "<div> <img class=card-img-top src=/Photo/".$row["image"]." alt=CopyRight  > </div>";
                            $mysqli->query($newSql);
                            $enhedCounter += 1;
                        }
                        // ########################################################
                        // ############ Change this Location To Match Real Path ###
                        // ########################################################

                    }
                } else{break;}

            }//redirect("../booking.php",false);
            $mysqli->close();
        } catch (Exception $e) {
        }
    }
}

