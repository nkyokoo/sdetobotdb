<?php
session_start();
include_once "connect.php";
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
            $con = new DBConnection();
            $mysqli = $con->getConnection();
            $allProductsAreAvailable = true;
            //   $storeIDsFromUnits = "";
            $storeIDsFromUnitsQuantity = "";
            $storeIDsFromItems = "";
            // Length is a Upper Limit Counter for Outer Loop. It'll increase
            // Length => Next Product in line to be checked in db along with $i => Current Product
            //Change depend on Layer
            //$length = $layer == 1 ? 2:12;
            //Layer 1 or 2
            //Loop The Selections and send to Database if the Selection has Value
            // for ($i = $layer == 1 ? 1:11; $i < $length; $i++) {
            if (isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                foreach ($cart as $pid => $quantity){
                    // $enhedCounter = 0;
                    //Check if items and its units aren't empty
                    if (!empty($pid) and !empty($quantity)) {
                        $item = $pid;
                        $unitQuantity = $quantity;

                        //Find the connected Units/Enhed to the item ID and correct status(in stock) in the database and
                        $sql = "SELECT product_unit_e.id FROM product_unit_e INNER JOIN school_products ON product_unit_e.products_id = school_products.id WHERE school_products.id = " . $item .
                            " AND product_unit_e.current_status_id = 1";

                        $result = $mysqli->query($sql);

                        if ($result->num_rows >= $unitQuantity) {

                            //Increase Upper Limit if there's more Enheder/Units available.
                            // $length += 1;
                            $storeIDsFromItems .= (string)$item.",";
                            $storeIDsFromUnitsQuantity .= (string)$unitQuantity.",";

                            /*
                            while ($row = $result->fetch_assoc() AND $enhedCounter < $unitQuantity) {
                                //insert rows into a string instead of array
                               $storeIDsFromUnits .= $row['id'].",";
                                $enhedCounter += 1;
                            }*/
                            // ########################################################
                            // ############ Change this Location To Match Real Path ###
                            // ########################################################

                        }
                        else
                        {
                            $allProductsAreAvailable = false;
                        }
                    }
                    else {break;}

                }
            }
            if ($allProductsAreAvailable){
                // $this->updateStatus($storeIDsFromUnits);
                //Make a wish list in DB and return ID
                $wishListID = $this->sendToWishList();
                //Get ID and products,quantity in a form of string array.
                $this->connectProductsToWishList($storeIDsFromItems,$storeIDsFromUnitsQuantity,$wishListID);

                //This is a test to run the whole Cycle and should not be here.
                $this->sendToRentalTest($wishListID);
            }
            else{
                //Products Unavailable Message
                echo "Some of the Products are Unavailable!";
            }
            $mysqli->close();
        } catch (Exception $e) {
        }
    }
    /*
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
    */
    private function sendToWishList(){
        $con = new DBConnection();
        $mysqli = $con->getConnection();

        // As tinyint is a 0 = false, 1 = true integer
        //user_id in LIVE Database needs to be taken from SESSION OF USER.
        $userID = $_SESSION['user']['id'];
        $stmt = $mysqli->prepare("INSERT INTO wish_list(`godkendt`, `user_id`) VALUES (0,?)");
        $stmt->bind_param("i",$userID);
        $stmt->execute();
        $idFromWishList = $stmt->insert_id;
        $mysqli->close();
        return $idFromWishList;
    }
    private function connectProductsToWishList($productID,$unitQuantity,$wishListID){
        $productID = explode(",",$productID);
        $unitQuantity = explode(",",$unitQuantity);
        $con = new DBConnection();
        $mysqli = $con->getConnection();

        for ($i = 0; $i < count($productID); $i++){

            $stmt = $mysqli->prepare("INSERT INTO `connection_product_wishlist`(`wish_list_id`, `school_products_id`, `quantity`) VALUES (?,?,?)");
            $stmt->bind_param("iii",$wishListID,$productID[$i],$unitQuantity[$i]);
            $stmt->execute();
        }

        $mysqli->close();
        //$this->sendToRentalTest($wishListID);
    }
    private function sendToRentalTest($wishListID){
        $con = new  DBConnection();
        $mysqli = $con->getConnection();

        //Change when Calendar is finished.
        $reservedDate = "2001-11-01"; //Current date
        $startDate = "2003-11-03"; // When to loan date
        $endDate = "2003-12-02"; //End Loan date
        $reminderDate = "2001-12-01"; // 2 days before end date.
        $stmt = $mysqli->prepare("INSERT INTO `product_rentals`(`reserved_date`, `start_date`, `end_date`, `reminder_date`, `wish_list_id`,`available`) VALUES (?,?,?,?,?,1)");
        $stmt->bind_param("ssssi",$reservedDate,$startDate,$endDate,$reminderDate,$wishListID);
        $stmt->execute();
        $rentalID = $stmt->insert_id;
        $mysqli->close();
        $this->connectUnitsAndRental($rentalID,$wishListID);
    }
    private function connectUnitsAndRental($rentalID,$wishListID){
        $con = new  DBConnection();
        $mysqli = $con->getConnection();

        //Find Product and its Quantity
        $sql = $mysqli->query("SELECT school_products_id, quantity FROM connection_product_wishlist
                            INNER JOIN wish_list ON connection_product_wishlist.wish_list_id = wish_list.id
                            INNER JOIN product_rentals ON wish_list.id = product_rentals.wish_list_id
                            WHERE product_rentals.wish_list_id = ".$wishListID." AND product_rentals.id =".$rentalID);
        if ($sql->num_rows > 0){
            //Fetch the specific product and quantity a.k.a Start with one row at time.
            while ($row = $sql->fetch_assoc()){
                //Use the product and quantity to find its Units
                $newSql = $mysqli->query("SELECT * FROM `product_unit_e` WHERE product_unit_e.products_id = ".$row['school_products_id']);
                //Check if there's enough Units
                if ($newSql->num_rows >= $row['quantity']){

                    //Variables to Compare current and max Quantity
                    $maxQuantity = $row['quantity'];
                    $currentQuantity = 0;
                    //Get the Specific Units and TOTAL of Product with a loop a.k.a Use the data in specific row
                    while ($newRow = $newSql->fetch_assoc() AND $maxQuantity > $currentQuantity){
                        $currentQuantity++;

                        //Check if the Unit is available on this Date

                        //Insert UNITS and Rental ID to DB, To make a Sorted List on specific items you've loaned.
                        $stmt = $mysqli->prepare("INSERT INTO `connection_product_rentals`(`product_rentals_id`, `product_unit_e_id`) VALUES (?,?)");
                        $stmt->bind_param("ii",$rentalID,$newRow['id']);
                        $stmt->execute();

                    }
                }
            }
        }
        //In the End Create a View of items this user has rented in the given date.
        /*  $mysqli->query("CREATE VIEW view_RentalList AS
                                         SELECT product_rentals.id AS orderID, users.id as userID, product_unit_e.id AS unitID,product_rentals.start_date,product_rentals.end_date
                                         FROM connection_product_rentals
                                         INNER JOIN product_unit_e ON connection_product_rentals.product_unit_e_id = product_unit_e.id
                                         INNER JOIN product_rentals ON connection_product_rentals.product_rentals_id = product_rentals.id
                                         INNER JOIN wish_list ON product_rentals.wish_list_id = wish_list.id
                                         INNER JOIN users ON wish_list.user_id = users.id
                                         WHERE connection_product_rentals.product_rentals_id = ".$rentalID);


         */

    }
}

