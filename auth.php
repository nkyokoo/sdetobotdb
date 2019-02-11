<?php
session_start();

include "includes/connect.php";
//call for the class of connect.php and the function getConnection.
//makein connection to db.
$DBConnection = new DBConnection;
$db = $DBConnection->getConnection();
// variable declaration
$name = "";
$email    = "";
$errors   = array();
//------------------------------------------------------------------------------------//
// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $name, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$name    =  e($_POST['name']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($name)) {
		array_push($errors, "Navn er påkrævet");
	}
	if (empty($email)) {
		array_push($errors, "Email er påkrævet");
	}
	if (empty($password_1)) {
		array_push($errors, "Password er påkrævet");
	}
	if ($password_1 != $password_2) {
		array_push($errors, "passwords matcher ikke hinanden");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_group_id'])) {
			$user_group_id = e($_POST['user_group_id']);
			$query = "INSERT INTO users (name, email, password, user_group_id)
					  VALUES('$name', '$email','$password', '$user_group_id')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "Ny bruger er oprettet!";
			header('location: admin/home.php');
		}else{
			$query = "INSERT INTO users (name, email, password, user_group_id)
					  VALUES('$name', '$email', '$password', '3')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "Du er nu logget ind";
			header('location: user/index.php');
		}
	}
}
//------------------------------------------------------------------------------------//
// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}
//------------------------------------------------------------------------------------//
// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}
//------------------------------------------------------------------------------------//
// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $name, $errors;

	// grap form values
	$name = e($_POST['name']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($name)) {
		array_push($errors, "Navn er påkrævet");
	}
	if (empty($password)) {
		array_push($errors, "Password er påkrævet");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE name='$name' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_group_id'] == '1') {

				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Du er nu logget ind!";
				header('location: admin/home.php');
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "Du er nu logget ind!";

				header('location:  user/index.php');
			}
		}else {
			array_push($errors, "Wrong name/password combination");
		}
	}
}

//------------------------------------------------------------------------------------//
function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_group_id'] == '1' ) {
		return true;
	}else{
		return false;
	}
}
//------------------------------------------------------------------------------------//
class sidebarLogin {
	var $Rulestagsave = '0';
var $rulestag = '0';

	function LoginForSidebar() {
		if (isset($_POST['login_btn'])) {
			login2();

			$Rulestagsave = login2();
			return $Rulestagsave;

		}
	}
		// LOGIN USER
		function login2(){
			global $db, $name, $errors;

			// grap form values
			$name = e($_POST['name']);
			$password = e($_POST['password']);

			// make sure form is filled properly
			if (empty($name)) {
				array_push($errors, "Navn er påkrævet");
			}
			if (empty($password)) {
				array_push($errors, "Password er påkrævet");
			}

			// attempt login if no errors on form
			if (count($errors) == 0) {
				$password = md5($password);

				$query = "SELECT * FROM users WHERE name='$name' AND password='$password' LIMIT 1";
				$results = mysqli_query($db, $query);

				if (mysqli_num_rows($results) == 1) { // user found
					// check if user is admin or user
					$logged_in_user = mysqli_fetch_assoc($results);

					if ($logged_in_user['user_group_id'] == '1') {

						$rulestag = '1';


					}else if ($logged_in_user['user_group_id'] == '2'){
						$rulestag = '2';

					}else {
						$rulestag= '3';

					}
					return $rulestag;
				}else {
					array_push($errors, "Wrong name/password combination");
				}
			}
		}
	}
