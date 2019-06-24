<?php

include_once("../backend_web/user.php");
 $usr = new user();

$name =$_POST['name'];
$email=$_POST['email'];
$user_type =$_POST['user_type'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];


$usr->createUser($name,$email,$password1,$password2,$user_type);
echo $usr->getMessage();