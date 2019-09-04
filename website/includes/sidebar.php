<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php

//we call the session start and the we use $_SESSION['user_group_id' for making sure of the user-group-id have any post. Then we use this vaiable to mannage the sidebar. 
//Admin

if (isset($_SESSION['user']['user_group_id'])){
    if ($_SESSION['user']['user_group_id'] == 1){
        echo '

            <div>
				<content class="border-content">
					<div class="sidebar" id="sideBar">
					<div id="sidebarcontent">
					<ul class="nav flex-column">
				    	<li class="nav-item"><a class="nav-link" href="../admin">Admin Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="../booking.php">book</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
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
				    <div id="sidebarcontent">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../teachers/products.php">Product</a></li>
						<li class="nav-item"><a class="nav-link" href="../booking.php">book</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="">Log ud</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact informatrion</a></li>
						</ul>
					</div>
					</div>
				</content>
            </div>
			';
    }
//User
    else if ($_SESSION['user']['user_group_id'] == 3) {
        echo '
           <div>
				<content class="border-content">
					<div class="sidebar"  id="sideBar">
					<div id="sidebarcontent">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../booking.php">book</a></li>
						<li class="nav-item"> <a class="nav-link" href="">Historik</a></li>
						<li class="nav-item"> <a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						<li class="nav-item"> <a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						</ul>
					</div>
					</div>
				</content>
            </div>

			';

    }

}



?>
