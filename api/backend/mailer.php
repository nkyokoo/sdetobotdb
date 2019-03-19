<?php


class Mailer
{

 public function __constructMail($title, $content){
     $to      = 'jllabtec@gmail.com';
     $headers = 'From: bookingsystem' . "\r\n" .
         'Reply-To: ' . "\r\n" .
         'X-Mailer: PHP/' . phpversion();

     mail($to, $title,  $content, $headers);

 }
}