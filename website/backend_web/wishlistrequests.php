<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 22/03/2019
 * Time: 08.36
 */
include "../admin/adminprotection.php";

class WishListRequest{

    function acceptRequest($wishlistID){
        $url = 'http://localhost:8000/api/request/get';
        $data = array('wishlistID' => $wishlistID);

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
    }

    function denyRequest($wishlistID){
        $url = 'http://localhost:8000/api/admin/denyrequest';
        $data = array('wishlistID' => $wishlistID);

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
    }
}