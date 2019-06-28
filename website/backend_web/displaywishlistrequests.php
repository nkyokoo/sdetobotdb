<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 27/06/2019
 * Time: 08.35
 */
session_start();
class displaywishlistrequests
{

    function getWishlistRequests(){


        $url = 'http://localhost:8000/api/request/get';
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Authorization: '.$_SESSION['user']['token'],
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        echo $result;


    }
}