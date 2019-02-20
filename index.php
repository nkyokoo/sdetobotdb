<?php
	include 'auth.php';
	include 'includes/header.php';
	include 'includes/sidebar.php';
	include 'info.php';
	include 'includes/footer.php';
	echo 'returntag'. $_SESSION['returntag'];
	echo 'user'. $_SESSION['user_groupe'];
	
?>
