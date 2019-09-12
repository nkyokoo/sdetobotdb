<?php
session_start();

    if($_GET['type'] == "product"){
        $url = 'http://localhost:8000/api/booking/products/search?q='.$_GET['q'];
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