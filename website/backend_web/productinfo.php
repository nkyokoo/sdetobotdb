<?php
/**
 * Created by PhpStorm.
 * User: aznzl
 * Date: 24/06/2019
 * Time: 14.45
 */
session_start();

class Productinfo
{

    function getProductInfo()
    {
        $url = 'http://localhost:8000/api/booking/category/get';
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