<?php
include_once("../backend_web/user.php");

$usr = new user();

$currentpassword =$_POST['currentpassword'];
$newpassword =$_POST['newpassword'];



$usr->changePassword($currentpassword,$newpassword);
echo $usr->getMessage();