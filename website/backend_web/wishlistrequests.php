<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 22/03/2019
 * Time: 08.36
 */
include_once '../admin/admin_includes/adminprotection.php';
class WishListRequest{

    function acceptRequest($wishlistID){
        $url = 'http://localhost:8000/api/request/accept';
        $data = array('wishlistID' => $wishlistID);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: ".$_SESSION['user']['token'],
                'method'  => 'PUT',
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
        $url = 'http://localhost:8000/api/request/deny';
        $data = array('wishlistID' => $wishlistID);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: ".$_SESSION['user']['token'],
                'method'  => 'PUT',
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