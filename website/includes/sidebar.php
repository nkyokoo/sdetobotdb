<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php
echo "<script src=../assets/js/logout.js> </script>";
echo "<script src=\"../assets/js/sidebar.js\"></script>";
if(!isset($_SESSION))
{
    session_start();
}
//we call the session start and the we use $_SESSION['user_group_id' for making sure of the user-group-id have any post. Then we use this vaiable to mannage the sidebar. 
//Admin

if (isset($_SESSION['user']['user_group_id'])){
    if ($_SESSION['user']['user_group_id'] == 1){
        echo '

            <div>
				<content class="border-content">
					<div class="sidebar" id="sideBar">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../index.php">Hejsa Admin</a></li>
						<li class="nav-item"><a class="nav-link" href="">opret user</a></li>
						<li class="nav-item"><a class="nav-link" href="">accepter ønskeliste booking</a></li>
						<li class="nav-item"><a class="nav-link" href="">accept book</a></li>
						<li class="nav-item"><a class="nav-link" href="">book</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
				</content>
				</div>

			';
    }
//Superuser
    else if ($_SESSION['user']['user_group_id'] == 2) {

        echo '
            <div >
				<content class="border-content">
					<div class="sidebar" id="sideBar">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../index.php">Hejsa Superuser</a></button></li>
						<li class="nav-item"><a class="nav-link" href="">Control users</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="">Log ud</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
				</content>
            </div>
			';
    }
//User
    else if ($_SESSION['user']['user_group_id'] == 3) {
        echo '
           <div >
				<content class="border-conten" id="sideBar">
					<div class="sidebar">
					<ul class="nav flex-column">
						<li class="nav-item"> <a class="nav-link" href="../index.php">Hejsa user</a></li>
						<li class="nav-item"> <a class="nav-link" href="Home">Ønskeliste</a></li>
						<li class="nav-item"> <a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						<li class="nav-item"> <a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						</ul>
					</div>
				</content>
            </div>

			';

    }

}
//No login



?>
