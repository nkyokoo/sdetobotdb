<?php
include "../backend_web/user.php";

$usr = new user();

$name =  $_POST['name'];
$email =  $_POST['email'];
$password = $_POST['password'];
$usr->register($name,$email,$password);

echo $usr->getMessage();