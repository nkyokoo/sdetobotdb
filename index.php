<?php
	include 'auth.php';
	include 'includes/header.php';

	include 'info.php';
	include 'includes/footer.php';

	$class = new auth2test();

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

		include 'includes/sidebar.php';
		echo $_SESSION['returntag'];
?>
