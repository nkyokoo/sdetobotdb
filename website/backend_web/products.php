<?php
session_start();

class Products
{

    function getProducts()
    {
        $url = 'http://localhost:8000/api/booking/products/get';
        $options = array(
            'http' => array(
                'method' => 'GET',
                'header' => 'Authorization: ' . $_SESSION['user']['token'],
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        echo $result;


    }
    function getUnits(){
           $url = 'http://localhost:8000/api/booking/products/units/get';
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
