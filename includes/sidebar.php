<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->

<?php
	include './assets/js/logout.js';

		if (isset($_SESSION['returntag']) AND $_SESSION['returntag'] == 1){
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">
			<form method="post" action="auth.php">
				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="index.php">Hejsa Admin</a></li>
						<li><a href="">accept user</a></li>
						<li><a onclick="callPhpFunction()" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
				</content>
			</form>
			';
	}else if (isset($_SESSION['returntag']) AND $_SESSION['returntag'] == 2) {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">
			<form method="post" action="auth.php">
				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="index.php">Hejsa Superuser</a></li>
						<li><a href="">Control users</a></li>
						<li><a onclick="callPhpFunction()" name="logout_btn" "href="#">Log ud</a></li>
						</ul>
					</div>
				</content>
			</form>
			';
	}else if (isset($_SESSION['returntag']) AND $_SESSION['returntag'] == 3) {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">
			<form method="post" action="auth.php">
				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="index.php">Hejsa user</a></li>
						<li><a href="">Book</a></li>
						<li><a onclick="callPhpFunction()" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
				</content>
			</form>
			';
	}elseif (!isset($_SESSION['return']) AND empty($_SESSION['returntag']) AND $_SESSION['returntag'] == 3) {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">
			<form>
				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="">Contact11111</a></li>
						<li><a href="./login.php">Log på</a></li>
						<li><a href="./register.php">Register</a></li>
						</ul>
					</div>
				</content>
			</form>
			';
	}else {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">
			<form>
				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="">Contact11111</a></li>
						<li><a href="./login.php">Log på</a></li>
						<li><a href="./register.php">Register</a></li>
						</ul>
					</div>
				</content>
			</form>
			';
	}


?>
<!-- <link rel="stylesheet" href="../assets/css/sidebar.css">
	<content class="border-conten">
		<div class="sidebar">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="">Contact</a></li>
			<li><a href="./login.php">Log på</a></li>
			</ul>
		</div>
	</content> -->
