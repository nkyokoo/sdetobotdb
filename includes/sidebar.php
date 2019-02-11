<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->

<?php
 	$sidebarLogin = new sidebarLogin;
	$LoginUser = $sidebarLogin->LoginForSidebar();
	if ($LoginUser == '1'){
		echo '<link rel="stylesheet" href="../assets/css/sidebar.css">
			<content class="border-conten">
				<div class="sidebar">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="">accept user</a></li>
					<li><a href="./login.php">Log på</a></li>
					</ul>
				</div>
			</content>
			';
	}else if ($LoginUser == '2') {
		echo '<link rel="stylesheet" href="../assets/css/sidebar.css">
			<content class="border-conten">
				<div class="sidebar">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="">Control users</a></li>
					<li><a href="./login.php">Log på</a></li>
					</ul>
				</div>
			</content>
			';
	}else if ($LoginUser == '3') {
		echo '<link rel="stylesheet" href="../assets/css/sidebar.css">
			<content class="border-conten">
				<div class="sidebar">
				<ul>
					<li><a href="index.php">MIN STORE PIK!!!</a></li>
					<li><a href="">Book</a></li>
					<li><a href="./login.php">Log på</a></li>
					</ul>
				</div>
			</content>
			';
	}else {
		echo '<link rel="stylesheet" href="../assets/css/sidebar.css">
			<content class="border-conten">
				<div class="sidebar">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="">Contact</a></li>
					<li><a href="./login.php">Log på</a></li>
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
