<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once '../_mysqli.php';

session_start();
if($_SESSION['auth']) 
{
	$sql = "SELECT email, password, user_group_id
			FROM users
			WHERE id = '".$_SESSION['user']."'";
	$result = $connection -> query($sql);
	$row = $result -> fetch_object();	
}

if ($row -> user_group_id == '1') {
	include 'includes/admin.php';
}

if ($row -> user_group_id == '2') {
	include 'includes/superuser.php';
}

if ($row -> user_group_id == '3') {
	include 'includes/user.php';
}


?>