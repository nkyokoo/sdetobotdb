<?php
session_start();

include "includes/connect.php";
//call for the class of connect.php and the function getConnection.
//makein connection to db.
/**
 *
 */
$_SESSION['errors'] = array();
$_SESSION['returntag'] = 0;
 class auth2test {


   // call these variables with the global keyword to make them available in function
   // variable declaration
  /*public $errorss = array();*/

  //------------------------------------------------------------------------------------//
  // call the register() function if register_btn is clicked


  // REGISTER USER
  function register(){
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();



  	// receive all input values from the form. Call the sqlinjection() function
      // defined below to escape form values
  	$name    =  sqlinjection($_POST['name']);
  	$email       =  sqlinjection($_POST['email']);
  	$password_1  =  sqlinjection($_POST['password_1']);
  	$password_2  =  sqlinjection($_POST['password_2']);

  	// form validation: ensure that the form is correctly filled
  	if (empty($name)) {
  		array_push($_SESSION['errors'], "Navn er påkrævet");
  	}
  	if (empty($email)) {
  		array_push($_SESSION['errors'], "Email er påkrævet");
  	}
  	if (empty($password_1)) {
  		array_push($_SESSION['errors'], "Password er påkrævet");
  	}
  	if ($password_1 != $password_2) {
  		array_push($_SESSION['errors'], "passwords matcher ikke hinanden");
  	}

  	// register user if there are no errors in the form
  	if (count($errors) == 0) {
  		$password = md5($password_1);//encrypt the password before saving in the database

  		if (isset($_POST['user_group_id'])) {
  			$user_group_id = sqlinjection($_POST['user_group_id']);
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
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();

  	$query = "SELECT * FROM users WHERE id=" . $id;
  	$result = mysqli_query($db, $query);

  	$user = mysqli_fetch_assoc($result);
  	return $user;
  }

  // escape string
  function sqlinjection($val){

  	return mysqli_real_escape_string($db, trim($val));
  }

  function display_error() {
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


  // LOGIN USER
  function login($name, $password){
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();
    $returntag = 0;


    $errorss = array();
  	// make sure form is filled properly
  	if (empty($name)) {
  		array_push($_SESSION['errors'], "Navn er påkrævet");
  	}
  	if (empty($password)) {
  		array_push($_SESSION['errors'], "Password er påkrævet");
  	}
    $errors = $_SESSION['errors'];
  	// attempt login if no errors on form
  	if (count($errors) == 0) {
  		$password = md5($password);

  		$query = "SELECT * FROM users WHERE name='$name' AND password='$password' LIMIT 1";
  		$results = mysqli_query($db, $query);

  		if (mysqli_num_rows($results) == 1) { // user found
  			// check if user is admin or user
  			$logged_in_user = mysqli_fetch_assoc($results);
  			if ($logged_in_user['user_group_id'] == '1') {

            $returntag = 1;

/*  				$_SESSION['user'] = $logged_in_user;
  				$_SESSION['success']  = "Du er nu logget ind!";*/
  				/*header('location: admin/home.php');*/
  			}else if ($logged_in_user['user_group_id'] == '2') {

            $returntag = 2;

/*  				$_SESSION['user'] = $logged_in_user;
  				$_SESSION['success']  = "Du er nu logget ind!";*/


  			}else if ($logged_in_user['user_group_id'] == '3') {

           $returntag = 3;

        }
  		}else {
  			array_push($errors, "Wrong name/password combination");
  		}
     $_SESSION['returntag'] = $returntag;
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
}
//------------------------------------------------------------------------------------//
