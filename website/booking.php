
<?php
session_start();

//include 'includes/connect.php';
include "includes/header.php";
include "includes/navbar.php";
include 'includes/sidebar.php';





?>

<div class="container">
<!-- Tags to test if Timer works -->
<!-- <div><p>Timer</p> <p id="test">0</p></div> -->
<div id="display">

    <?php
    $currentDate = date('Y-m-d');
    if (!isset($_SESSION['sdate']) || empty($_SESSION['sdate'])){
        echo "hello";
    echo "<input type='date' id='sdate' min='".  $currentDate ."' value='".  $currentDate ."'>     <input type='date' id='edate' min='".  $currentDate ."' >     <input type='button' value='GO' id='dateButton'>";
    }
    else{
        $startDate = date('Y-m-d',strtotime($_SESSION['sdate']));
        echo $startDate;
        echo "<input type='date' id='sdate' min='".$currentDate."' value='". $startDate ."'>     <input type='date' id='edate' min='".  $currentDate ." value='". $_SESSION['edate']."'>     <input type='button' value='GO' id='dateButton'>";

    }

     ?>

</div>


    <div id="layer_1" class="layer1" style="display: block" >

    <div id="select_list_1">
        <!-- Via Ajax, get products data and send them in between this div. "Booking.js(getProductsFromDB)" -->
    </div>

</div>
</div>
<?php
echo "<script type=\"text/javascript\" src=\"assets/js/booking.js\"></script>
<script type=\"text/javascript\" src=\"assets/js/bookingtimer.js\"></script>";
include "includes/footer.php";

?>