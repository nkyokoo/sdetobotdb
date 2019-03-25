<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 25/03/2019
 * Time: 11.14
 */


class DropDownlistProducts_Function{

    function addProductsForSelection(){


        //Select products to Selection box which you haven't choosing yet
        // WHERE id NOT IN () is a feature of excluding specific IDs, can query without.
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-header'>Featured Products</h5>";

        $url = 'http://localhost:8000/api/booking/bookinglist/get';

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json",
                'method'  => 'GET',
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


                echo "<div class='row'> <div class='col'>
                          <div class='card'>
                          <div class='card-body'>
                          <h5 class='card-title'>" .$item['product_name']."</h5>
                          <h6 class='card-subtitle mb-2 text-muted'>Moveable: ".$item['movable']."</h6>
                          <p class='card-text'>".$item['description'].".</p>
                          <select id='product-unit-".$item['id']."'>".$quantity."</select><button id='btn-".$item['id']."')>Add to Cart</button></div>
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

            // echo '<option value="">Select Enheder</option>';
            //Fetch Units/Enhed Data from the Database.
                for ($i = 1; $i <= $quantity;$i++)
                {


                $string .= '<option value="' . $i . '">' . $i. '</option>';
                $enhedCounter += 1;
                // }
                }

        }else{
            $string = '<option value="">Ingen Enheder Ledige</option>';

        }





        return $string;

    }


}


