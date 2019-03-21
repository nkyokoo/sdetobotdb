<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php
if(!isset($_SESSION))
{
    session_start();
}
//we call the session start and the we use $_SESSION['user_group_id' for making sure of the user-group-id have any post. Then we use this vaiable to mannage the sidebar. 
//Admin
if (isset($_SESSION['user_group_id'])){

    if ($_SESSION['user_group_id'] == 1){
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
    }
//Superuser
    else if ($_SESSION['user_group_id'] == 2) {
        echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Hejsa Superuser</a></li>
						<li><a href="">Control users</a></li>
						<li><a id="callPhplogout" name="logout_btn" href="">Log ud</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

			';
    }
//User
    else if ($_SESSION['user_group_id'] == 3) {
        echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul>
						<li><a href="../index.php">Hejsa user</a></li>
						<li><a href="Home">Ønskelist "booking.php"</a></li>
						<li><a id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						<li><a href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

			';

    }

}
//No login
else {
    echo '

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
