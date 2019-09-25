<?php
include "../backend_web/user.php";

$usr = new user();

$email =  $_POST['email'];
$password = $_POST['password'];
$usr->login($email,$password);

echo $usr->getMessage();