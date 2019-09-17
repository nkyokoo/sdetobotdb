<?php
session_start();

class BookingSend
{
    public function sendBooking(){

        try {

            $allProductsAreAvailable = false;
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
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $data = array();
                $sdate = date('Y-m-d',strtotime($_SESSION['sdate']));
                $edate = date('Y-m-d',strtotime($_SESSION['edate']));

                foreach ($cart as $pid => $quantity){
                    // $enhedCounter = 0;
                    //Check if items and its units aren't empty
                    if (!empty($pid) and !empty($quantity)) {
                        $item = $pid;
                        $unitQuantity = $quantity;

                        //Request to API
                        $data[] = array('item' => $item,'quantity' => $unitQuantity, 'sdate' => $edate,'edate' => $sdate);


                    }
                    else {echo "ERROR 22";break;}

                }
                var_dump(json_encode($data));
                // Check if products are available
                $url = 'http://localhost:8000/api/booking/bookingsend/create';
// use key 'http' even if you send the request to https://...
                $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
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
                    $storeIDsFromItems .= $data['item'].",";
                    $storeIDsFromUnitsQuantity .= $data['quantity'].",";

                    if ($data['available'] === true){
                        $allProductsAreAvailable = $data['available'];

                    }

                }


                if ($allProductsAreAvailable){
                    // $this->updateStatus($storeIDsFromUnits);
                    //Create a new wish list in DB and return ID
                    $wishListID = $this->sendToWishList();
                    //Get ID and products,quantity in a form of string array.
                    $this->connectProductsToWishList($storeIDsFromItems,$storeIDsFromUnitsQuantity,$wishListID);

                    //This is a test to run the whole Cycle and should not be here.
                }
                else{
                    //Products Unavailable Message
                    echo "Some of the Products are Unavailable!";
                }
            //echo $allProductsAreAvailable;
            }else{echo "ERROR 21 : You don't have products to make a wish list";}
            //if all products are available do the following

        } catch (Exception $e) {
        }
    }

    private function sendToWishList(){
        $resdate = date('Y-m-d');
        $sdate = date('Y-m-d',strtotime($_SESSION['sdate']));
        $edate = date('Y-m-d',strtotime($_SESSION['edate']));
        $remdate = "";
        if ($edate > $resdate){

            $remdate = date('Y-m-d', strtotime('yesterday', strtotime($edate)));
        }
        else{
            $remdate = $resdate;
        }
        // As tinyint is a 0 = false, 1 = true integer
        //user_id in LIVE Database needs to be taken from SESSION OF USER.
 // `rerserved_date`, `start_date`, `end_date`, `reminder_date`, `godkendt`, `user_id`
        //Connect to API
        $data  = array(
            'rerserved_date' => $resdate,
            'start_date' => $sdate,
            'end_date' => $edate,
            'reminder_date' => $remdate,
            'userid' => $_SESSION['user']['id']

        );
        //var_dump($data);
        $url = 'http://localhost:8000/api/booking/bookingsend/wishlist/create';
// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
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
        // use the output data and decode from json format
        $idFromWishList = json_decode($result,true);

        return $idFromWishList;


    }
    private function connectProductsToWishList($productID,$unitQuantity,$wishListID){
        $productID = explode(",",$productID);
        $unitQuantity = explode(",",$unitQuantity);
        $data = array();
        for ($i = 0; $i < count($productID) - 1; $i++){

            $data[] = array('productid' => $productID[$i], 'quantity' => $unitQuantity[$i], 'wishlistid' => $wishListID);
        }
        $url = 'http://localhost:8000/api/booking/bookingsend/connection/create';
// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
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


        //$this->sendToRentalTest($wishListID);
    }
}