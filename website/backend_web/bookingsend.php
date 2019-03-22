<?php
session_start();
class DBConnection
{
    public function getConnection()
    {
        try {
            $con = new mysqli("localhost", "root", "", "sdebookingsystem");
            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
                return null;
            } else {
                $con->set_charset("utf8");
                return $con;
            }
        } catch (Exception $e) {
        }
    }
}
class BookingSend
{
    public function sendBooking(){

        try {

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

                        //Request to API
                        $url = 'http://localhost:8000/api/booking/bookingsend';
                        $data = array('item' => $item,'unitQuantity' => $unitQuantity);

// use key 'http' even if you send the request to https://...
                        $options = array(
                                'http' => array(
                                'header'  => "Content-type: application/json",
                                'method'  => 'POST',
                                'content' => json_encode($data)
                            )
                        );
//send request to api and get result
                        $context  = stream_context_create($options);
                        $result = file_get_contents($url, false, $context);

                        if ($result === FALSE) { /* Handle error */
                            $allProductsAreAvailable = false;

                            var_dump($result);
                        }
                        $jsondata = json_decode($result,true);
                        foreach ($jsondata as $data){
                                $storeIDsFromItems .= $data['storeIDsFromItems'];
                                $storeIDsFromUnitsQuantity .= $data['storeIDsFromUnitsQuantity'];

                        }
                    }
                    else {echo "ERROR 22";break;}

                }

            }else{echo "ERROR 21";}
            if ($allProductsAreAvailable){
                // $this->updateStatus($storeIDsFromUnits);
                //Make a wish list in DB and return ID
                $wishListID = $this->sendToWishList();
                //Get ID and products,quantity in a form of string array.
                $this->connectProductsToWishList($storeIDsFromItems,$storeIDsFromUnitsQuantity,$wishListID);

                //This is a test to run the whole Cycle and should not be here.
            }
            else{
                //Products Unavailable Message
                echo "Some of the Products are Unavailable!";
            }
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
}