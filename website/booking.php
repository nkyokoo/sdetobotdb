
<?php


//include 'includes/connect.php';
include "includes/header.php";
include 'includes/sidebar.php';
include "includes/navbar.php";




?>
<script type="text/javascript" src="assets/js/booking.js"></script>
<script type="text/javascript" src="assets/js/bookingtimer.js"></script>

<!-- Tags to test if Timer works -->
<!-- <div><p>Timer</p> <p id="test">0</p></div> -->

<div id="layer_1" class="layer1" style="display: block" >

    <div id="select_list_1">
        <!-- Via Ajax, get products data and send them in between this div. "Booking.js(getProductsFromDB)" -->
    </div>

</div>

<?php
include "includes/footer.php";

?>