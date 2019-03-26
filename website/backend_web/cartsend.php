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
                $data = array();
                foreach ($cart as $pid => $quantity){
                    // $enhedCounter = 0;
                    //Check if items and its units aren't empty
                    if (!empty($pid) and !empty($quantity)) {
                        $item = $pid;
                        $unitQuantity = $quantity;

                        //Request to API
                        $data[] = array('item' => $item,'quantity' => $unitQuantity);


                    }
                    else {echo "ERROR 22";break;}

                }
                $url = 'http://localhost:8000/api/booking/bookingsend/create';
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

                    var_dump($result);
                }
                // use the output data
                $jsondata = json_decode($result,true);
               // var_dump($jsondata);
                foreach ($jsondata as $data){
                    $storeIDsFromItems .= ",".$data['item'];
                    $storeIDsFromUnitsQuantity .= ",".$data['quantity'];
                    if ($data['available'] == false){
                        $allProductsAreAvailable = $data['available'];
                    }
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

    private function sendToWishList(){
        $con = new DBConnection();
        $mysqli = $con->getConnection();

        // As tinyint is a 0 = false, 1 = true integer
        //user_id in LIVE Database needs to be taken from SESSION OF USER.
        $userID = 9;//$_SESSION['user']['id'];
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