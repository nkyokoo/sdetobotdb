<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 25/03/2019
 * Time: 11.14
 */
session_start();

class dropdownlist_products{

    function addProductsForSelection($sDate, $eDate){

        //Select products to Selection box which you haven't choosing yet
        // WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
        echo "<div class='catalog-container'>";
        echo "<h5>Featured Products</h5>";
        echo "<div class='Item-list'>";
        $newFormat = date("Y-m-d",strtotime($sDate));
        $newFormat2 = date("Y-m-d",strtotime($eDate));
        $_SESSION['sdate'] = $newFormat;
        $_SESSION['edate'] = $newFormat2;
        $data[] = array('sdate' => $newFormat,'edate' => $newFormat2);
        $format = json_encode($data);
        //Connect to API
        $url = 'http://localhost:8000/api/booking/products/catalog/get';
        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json \r\nAuthorization: ".$_SESSION['user']['token'],
                'method'  => 'POST',
                'content' => $format
            )
        );
        //send request to api and get result
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $json = json_decode($result,true);
        if ($result === FALSE) { /* Handle error */

            var_dump($result);
        }
            //Populate Selection box with data from DB
            foreach ($json as $item) {


                $quantity = $this->createOptionsForSelection($item['quantity']);


                echo "<div class='row'> <div class='col col-sm-4'>
                          <div class='card style='width: 30rem'>
                          <div class='card-body'>
                          <h5 class='card-title'>" .$item['product_name']."</h5>
                          <h6 class='card-subtitle mb-2 text-muted' style='color: #b7b7b7'>Moveable: ".$item['movable']."</h6>
                          <p class='card-text'>".$item['description'].".</p>
                          <label for=\"'product-unit-".$item['id']."'\" class=\"bmd-label-floating\">Vælg antal enheder</label>
                          <select class=\"form-control\" id='product-unit-".$item['id']."'>".$quantity."</select><button class='btn btn-raised btn-primary' id='btn-".$item['id']."')> Tilføj til kurv</button></div>
                          </div>
                          </div>
                          </div>";


            }

        echo "</div></div>";


    }

    //Populate Units/Enhed Selection box For the choosing Product
    function createOptionsForSelection($quantity)
    {

        //Check if the chosen Product is a Product.
        $string = '';
        $enhedCounter = 1;
        //Select all Units of specific Product where Status is 1 => Available

        //Check if there's any Units/Enhed available
        if ($quantity > 0){

            //Fetch Units/Enhed Data from the Database.
                for ($i = 1; $i <= $quantity;$i++)
                {

                $string .= '<option value="' . $i . '">' . $i. '</option>';
                $enhedCounter += 1;

                }

        }else{
            $string = '<option value="">Ingen Enheder Ledige</option>';

        }





        return $string;

    }


}


