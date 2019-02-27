<?php
session_start();

include "includes/connect.php";
//call for the class of connect.php and the function getConnection.

$_SESSION['errors'] = array();
$_SESSION['returntag'] = 0;
$_SESSION['user_groupe'] = 0;
// call these variables with the global keyword to make them available in function
// variable declaration

$class = new auth2test();
// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {

  $class->register();
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

    $class->login($_POST["name"],$_POST["password"]);
  }

 class auth2test {

  //------------------------------------------------------------------------------------//

  // return user array from their id
  function getUserById($id){
    //makein connection to db.
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();

  	$query = "SELECT * FROM users WHERE id=" . $id;
  	$result = mysqli_query($db, $query);

  	$user = mysqli_fetch_assoc($result);
  	return $user;
  }

  // REGISTER USER
  function register(){
    $returntag = 22;

    //makein connection to db.
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();


  	// receive all input values from the form. Call the sqlinjection() function
      // defined below to escape form values
  	$name    =  mysqli_real_escape_string($db, $_POST['name']);
  	$email       =  mysqli_real_escape_string($db, $_POST['email']);
  	$password_1  =  mysqli_real_escape_string($db, $_POST['password_1']);
  	$password_2  =  mysqli_real_escape_string($db, $_POST['password_2']);

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
  	if (count($_SESSION['errors']) == 0) {
  		$password = md5($password_1);//encrypt the password before saving in the database

  		if (isset($_POST['user_group_id'])) {
  			$user_group_id = mysqli_real_escape_string($db, $_POST['user_group_id']);
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
          $logged_in_user = mysqli_insert_id($db);

          // check if id and group_id has matching values.
          $query = 'SELECT * FROM users WHERE id ='. $logged_in_user .' AND user_group_id = "3"';

          // execute $query.
          $results = mysqli_query($db, $query);
          //feth data to array
          $logged_in_user_val  = mysqli_fetch_assoc($results);

          if ($logged_in_user_val['user_group_id'] == '3') {
            $returntag = 3;
            $_SESSION['returntag'] = $returntag; //make the vaiable for $logged_in_user.

              if ($_SESSION['returntag'] == 3) {
                $_SESSION['success']  = "Du er nu logget ind. og returntag sættes videre ";
                header('location: index.php');

              }elseif ($_SESSION['returntag'] == 0) {
                $_SESSION['success']  = "Du er nu logget ind. men returntag sættes ikke videre ";
                echo 'success'. $_SESSION['success'];
              }else {
                $_SESSION['success']  = "Du er ikke logget ind, returntag ikke retuneret.";
                echo 'success'. $_SESSION['success'];
              }
  		}
  	}
  }
}
  //------------------------------------------------------------------------------------//



  function display_error() {
  	if (count($_SESSION['errors']) > 0){
  		echo '<div class="error">';
  			foreach ($_SESSION['errors'] as $error){
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
    //makein connection to db.
    $DBConnections = new DBConnection();
    $db = $DBConnections->getConnection();
    $returntag = 8;
    $errors = $_SESSION['errors'];


  	// make sure form is filled properly
  	if (empty($name)) {
  		array_push($_SESSION['errors'], "Navn er påkrævet");
  	}
  	if (empty($password)) {
  		array_push($_SESSION['errors'], "Password er påkrævet");
  	}
  	// attempt login if no errors on form
  	if (count($errors = $_SESSION['errors']) == 0) {
  		 $password = md5($password);
      $returntag = 5;

  		$query = "SELECT * FROM users WHERE name='$name' AND password='$password' LIMIT 1";
  		$results = mysqli_query($db, $query);


  		if (mysqli_num_rows($results) == 1) { // user found
  			// check if user is admin or user
        $logged_in_user = mysqli_fetch_assoc($results);
        $returntag = 4;

  			if ($logged_in_user['user_group_id'] == '1') {

            $returntag = 1;
            $_SESSION['success']  = "Du er nu logget ind som admin!";


				 $_SESSION['user'] = $logged_in_user;
  				 $_SESSION['success']  = "Du er nu logget ind!";
  				//header('location: admin/home.php');*/
  			}elseif ($logged_in_user['user_group_id'] == '2'){

            $returntag = 2;

 				 $_SESSION['user'] = $logged_in_user;
  				$_SESSION['success']  = "Du er nu logget ind som Superuser!";

                  //for statement $logged_in_user['user_group_id']
  			}elseif ($logged_in_user['user_group_id'] == '3') {

           $returntag = 3;
           $_SESSION['success']  = "Du er nu logget ind user!";

        }
  		}else {
  			array_push($errors, "Wrong name/password combination");
  		}
     $_SESSION['returntag'] = $returntag;
     $_SESSION['user_groupe_id'] = $logged_in_user['user_group_id'];
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
