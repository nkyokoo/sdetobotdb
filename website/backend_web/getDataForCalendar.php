<?php


class getDataForCalendar
{

    function getWishlists(){

        $url = 'http://localhost:8000/api/booking/bookingsend/wishlist/create';
// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                'method'  => 'GET'
            )
        );
//send request to api and get result
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */
            var_dump($result);
        }
        // send the outputted data as json format
        return $result;
    }
}