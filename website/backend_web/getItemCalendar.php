<?php
session_start();

class getItemCalendar
{

    function getData($productID){
        $url = 'http://localhost:8000/api/calendar/item/histories/get';
// use key 'http' even if you send the request to https://...
        $data = array("productID" => $productID);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json \r\nAuthorization: " . $_SESSION['user']['token'],
                'method'  => 'POST',
                'content' => json_encode($data)
            )
        );
//send hrequest to api and get result
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */
            var_dump($result);
        }
        // send the outputted data as json format
        return $result;
    }

}