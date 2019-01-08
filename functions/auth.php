<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

include_once '../_mysqli.php';

$email = $_POST['email'];
$password = $_POST['password'];
$user_group_id = $_POST['admin'];

$sql = "SELECT id, password, email, user_group_id
		FROM users
		WHERE email = '$email' and password = '$password'";

$result = $connection -> query($sql);

$row = $result -> fetch_object();

if ($email = $row -> email && $password = $row -> password && $row -> user_group_id == 'admin') 
{
	//Login correct
	$_SESSION['auth'] = $row -> user_group_id;
	$_SESSION['user'] = $row -> id;
	header('location:../backend/dashboard.php');
} else {
	//Login Failed, back to login site
	header('location:../index.php');
}

?>