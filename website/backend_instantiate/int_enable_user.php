<?php

include_once("../backend_web/user.php");
$usr = new user();

$userid = $_POST['userid'];


$usr->enableUser($userid);
echo $usr->getMessage();