<?php
include "../backend_web/user.php";

$userid = $_POST['id'];

$usr = new user();

$usr->verifyUser($userid);