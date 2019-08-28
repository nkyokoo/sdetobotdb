<?php
include_once("../backend_web/user.php");

$usr = new user();

$name =$_POST['name'];


$usr->changeName($name);
echo $usr->getMessage();
