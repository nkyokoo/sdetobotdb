<?php
/**
 * Created by PhpStorm.
 * User: valo0023
 * Date: 27-06-2019
 * Time: 08:59
 */

class DashBoard
{
   function __getInfo()
   {
       $url = 'http://localhost:8000/api/booking/dasboard/get';
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