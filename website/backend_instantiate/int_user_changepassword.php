<?php
include_once("../backend_web/user.php");

$usr = new user();

$name =$_POST['currentpassword'];
$email=$_POST['newpassword'];


$usr->changePassword($name,$email);
echo $usr->getMessage();