<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php
echo "<script src=../assets/js/logout.js> </script>";
if(!isset($_SESSION))
{
    session_start();
}
//we call the session start and the we use $_SESSION['user_group_id' for making sure of the user-group-id have any post. Then we use this vaiable to mannage the sidebar. 
//Admin
echo $_SESSION['user']['user_group_id'];

if (isset($_SESSION['user']['user_group_id'])){

    if ($_SESSION['user']['user_group_id'] == 1){
        echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-content">
					<div class="sidebar">
					<ul class="nav flex-column">
						<li class="nav-item"><a href="../index.php">Hejsa Admin</a></li>
						<li class="nav-item"><a href="">opret user</a></li>
						<li class="nav-item"><a href="">accepter ønskeliste booking</a></li>
						<li class="nav-item"><a href="">accept book</a></li>
						<li class="nav-item"><a href="">book</a></li>
						<li class="nav-item"><a href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"><a id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
				</content>

			';
    }
//Superuser
    else if ($_SESSION['user']['user_group_id'] == 2) {

        echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-content">
					<div class="sidebar">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../index.php">Hejsa Superuser</a></button></li>
						<li class="nav-item"><a class="nav-link" href="">Control users</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="">Log ud</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>

			';
    }
//User
    else if ($_SESSION['user']['user_group_id'] == 3) {
        echo '
		<link rel="stylesheet" href="../assets/css/sidebar.css">

				<content class="border-conten">
					<div class="sidebar">
					<ul class="nav flex-column">
						<li class="nav-item"> <a class="nav-link" href="../index.php">Hejsa user</a></li>
						<li class="nav-item"> <a class="nav-link" href="Home">Ønskeliste</a></li>
						<li class="nav-item"> <a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						<li class="nav-item"> <a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
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

				<content class="border-content">
					<div class="sidebar">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="">Contact</a></li>
						<li class="nav-item"><a class="nav-link" href="../login.php">Log på</a></li>
						<li class="nav-item"><a class="nav-link" href="../register.php">Register</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						</ul>
					</div>
				</content>

			';
}

?>
