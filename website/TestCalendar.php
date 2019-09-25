<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../index.php');
}
//include 'includes/connect.php';
include "includes/header.php";
include "includes/navbar.php";
include 'includes/sidebar.php';
?>

<div class="container">

    <div style="background-color: white" id="calendar"></div>
</div>

<script src="assets/js/TestCalendar.js"></script>
<?php
include "includes/footer.php";
?>