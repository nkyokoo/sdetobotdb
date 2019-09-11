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
        <!-- Tags to test if Timer works -->
        <!-- <div><p>Timer</p> <p id="test">0</p></div> -->
        <div class='catalog-container'>
            <h5>Produkter</h5>
            <p class="card-subtitle" style="font-size: .8rem">Vælg dato du vil låne produkter og klik på knappen for at se ledige produkter.</p>
            <div id="display" style="display: inline">
                <?php
                $date_raw = date('Y-m-d');
                $currentDate = date('Y-m-d', strtotime('-1 day', strtotime($date_raw)));
                if (!isset($_SESSION['sdate']) || empty($_SESSION['sdate'])) {
                    echo "<input style='width: 10rem; display: inline' type='date' class='form-control' id='date_s' min='" . $currentDate . "' value='" . $currentDate . "' required>    
             <input  style='width: 10rem; display: inline' class='form-control' type='date' id='date_e' min='" . $currentDate . "' required >    
              <button style='display: inline' type='button'id='dateButton'><i class='material-icons'>send</i></button>";
                } else {
                    $startDate = date('Y-m-d', strtotime($_SESSION['sdate']));
                    $endDate = date('Y-m-d', strtotime($_SESSION['edate']));
                    echo "<input style='width: 10rem; display: inline' class='form-control' type='date' id='date_s' min='" . $currentDate . "' value='" . $startDate . "' required>   
             <input style='width: 10rem; display: inline' class='form-control' type='date' id='date_e' min='" . $currentDate . "' value='" . $endDate . "' required>    
             <button  style='display: inline' class='btn btn-raised btn-primary' type='button'id='dateButton'><i class='material-icons'>send</i></button>";

                }
                ?>
            </div>


            <div id="layer_1" class="layer1" style="display: block">

                <div id="select_list_1">
                    <!-- Via Ajax, get products data and send them in between this div. "Booking.js(getProductsFromDB)" -->
                </div>

            </div>
        </div>
    </div>
<?php
echo "<script type=\"text/javascript\" src=\"assets/js/booking.js\"></script>
<script type=\"text/javascript\" src=\"assets/js/bookingtimer.js\"></script>";
include "includes/footer.php";

?>