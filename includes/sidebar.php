<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<script type="text/javascript" src="../assets/js/logout.js" ></script>
<?php


		if (isset($_SESSION['user_groupe_id']) AND $_SESSION['user_groupe_id'] == 1){
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Hejsa Admin</a></li>
						<li><a href="">opret user</a></li>
						<li><a href="">accepter ønskeliste booking</a></li>
						<li><a href="">accept book</a></li>
						<li><a href="">book</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						<li><a id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
				</content>

			';
	}else if (isset($_SESSION['user_groupe_id']) AND $_SESSION['user_groupe_id'] == 2) {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Hejsa Superuser</a></li>
						<li><a href="">Control users</a></li>
						<li><a id="callPhplogout" name="logout_btn" "href="#">Log ud</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

			';
	}else if (isset($_SESSION['user_groupe_id']) AND $_SESSION['user_groupe_id'] == 3) {
		echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Hejsa user</a></li>
						<li><a href="">Ønskelist "booking.php"</a></li>
						<li><a id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

			';
<<<<<<< HEAD
	}else {
		echo '
=======
}
//No login
else {
    echo '
>>>>>>> e6b5e49edaa573117ce7c722079e1cf465ae73d2
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Home</a></li>
						<li><a href="">Contact11111</a></li>
						<li><a href="../login.php">Log på</a></li>
						<li><a href="../register.php">Register</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

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
