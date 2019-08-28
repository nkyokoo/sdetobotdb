<?php
session_start();
class DashBoard
{
   function __getInfo()
   {
       $url = 'http://localhost:8000/api/dashboard/get';
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