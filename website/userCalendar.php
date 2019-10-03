<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['user_group_id'])) {
    header('location: ../index.php');
}
if ($_SESSION['user']['user_group_id'] < 1 || $_SESSION['user']['user_group_id'] > 3){
    header('location: ../index.php');

}
//include 'includes/connect.php';
include "includes/header.php";
include "includes/navbar.php";
include 'includes/sidebar.php';
?>

    <div class="container">

        <div style="background-color: white" id="userCalendar"></div>
    </div>

    <script src="assets/js/userCalendar.js"></script>
<?php
include "includes/footer.php";
?>