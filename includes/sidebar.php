<!-- Skal ændre content efter man er logget ind. Navbar skal ændres med session.  -->
<?php
include('../auth.php');
function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
    echo"
    <link rel='stylesheet' href='../assets/css/sidebar.css'>
    <content class='border-content'>
      <div class='sidebar'>
      <ul>

        <li><a href='index.php'>Home</a></li>

        <li><a href=''>Contact</a></li>
        <li><a href='./login.php'>Log på</a></li>
        </ul>
      </div>
    </content>";
	}else{
		return false;
    echo"
    <link rel='stylesheet' href='../assets/css/sidebar.css'>
    <content class='border-content'>
      <div class='sidebar'>
      <ul>

        <li><a href='index.php'>Home</a></li>

        <li><a href=''>Contact</a></li>
        <li><a href='./login.php
        '>Log på</a></li>
        </ul>
      </div>
    </content>";
	}
}
?>
