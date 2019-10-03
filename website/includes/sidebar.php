<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php

//we call the session start and the we use $_SESSION['user_group_id' for making sure of the user-group-id have any post. Then we use this vaiable to mannage the sidebar. 
//Admin

if (isset($_SESSION['user']['user_group_id'])){
    if ($_SESSION['user']['user_group_id'] == 1){
        echo '

            <div>
				<div class="border-content">
					<div class="sidebar" id="sideBar">
					<div id="sidebarcontent">
					<ul class="nav flex-column">
				    	<li class="nav-item"><a class="nav-link" href="../admin">Admin Dashboard</a></li>
						<li class="nav-item"><a class="nav-link" href="../booking">book</a></li>
						<li class="nav-item"> <a class="nav-link" href="../admin/adminCalendar">Alle Historik</a></li>
					    <li class="nav-item"> <a class="nav-link" href="../userCalendar">Historik</a></li>
						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
					</div>
				</div>
				</div>

			';
    }
//Superuser
    else if ($_SESSION['user']['user_group_id'] == 2) {

        echo '
            <div>
				<div class="border-content">
					<div class="sidebar" id="sideBar">
				    <div id="sidebarcontent">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../teachers/products">Produkter</a></li>
						<li class="nav-item"><a class="nav-link" href="../teachers/acceptrequests">Låne Anmodninger<</a></li>
						<li class="nav-item"><a class="nav-link" href="../booking">Lån</a></li>
						<li class="nav-item"> <a class="nav-link" href="../admin/adminCalendar">Alle Historik</a></li>
						<li class="nav-item"> <a class="nav-link" href="../userCalendar">Min Historik</a></li>

						<li class="nav-item"><a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"><a class="nav-link" id="callPhplogout" name="logout_btn" href="">Log ud</a></li>
						</ul>
					</div>
					</div>
				</div>
            </div>
			';
    }
//User
    else if ($_SESSION['user']['user_group_id'] == 3) {
        echo '
           <div>
				<slot class="border-content">
					<div class="sidebar"  id="sideBar">
					<div id="sidebarcontent">
					<ul class="nav flex-column">
						<li class="nav-item"><a class="nav-link" href="../booking">book</a></li>
						<li class="nav-item"> <a class="nav-link" href="../userCalendar">Min Historik</a></li>
						<li class="nav-item"> <a class="nav-link" href="https://www.sde.dk/kontakt/kontakt/?">contact information</a></li>
						<li class="nav-item"> <a class="nav-link" id="callPhplogout" name="logout_btn" href="#">Log ud</a></li>
						</ul>
					</div>
					</div>
				</slot>
            </div>

			';

    }

}



?>
