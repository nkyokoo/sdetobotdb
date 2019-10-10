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
                <form style="display: inline; margin-left: 1rem" class="form-group">
                    <div style="display: inline" class="form-group">

                    <?php
                $currentDate = date('Y-m-d');
                $threeYearFromNow = date('Y-m-d',strtotime('+3 year',strtotime($currentDate)));
                if (!isset($_SESSION['sdate']) || empty($_SESSION['sdate'])) {
                    //If you haven't chosen a date yet
                    echo "<input style='width: 10rem; display: inline' type='date' class='form-control' id='date_s' min='" . $currentDate . "' value='" . $currentDate . "' max='".$threeYearFromNow."' required>    
                          <input  style='width: 10rem; display: inline' class='form-control' type='date' id='date_e' min='" . $currentDate . "' required >    
                          <button style='display: inline'  class='btn btn-raised btn-primary' type='button'id='dateButton'><i class='material-icons'>send</i></button>";
                } else {
                    // If you've chosen a date before
                    $startDate = date('Y-m-d', strtotime($_SESSION['sdate']));
                    $endDate = date('Y-m-d', strtotime($_SESSION['edate']));
                    echo "<input style='width: 10rem; display: inline' class='form-control' type='date' id='date_s' min='".$currentDate."' value='" . $startDate . "'  required max='".$threeYearFromNow."'>   
                          <input style='width: 10rem; display: inline' class='form-control' type='date' id='date_e' min='". $currentDate ."' value='" . $endDate . "' required>    
                          <button  style='display: inline' class='btn btn-raised btn-primary' type='button'id='dateButton'><i class='material-icons'>send</i></button>";
                }
                    ?></div>
                    <div style="display: inline" class="form-group">
                 <label for="searchInput" class="bmd-label-floating">søg</label>
                <input style="display: inline; width: 12rem;" class="form-control"  aria-label="search" id="searchInput" type="text">
                    </div>
                </form>
            </div>


            <div id="layer_1" class="layer1" style="display: block">

                <div id="select_list_1">
                    <!-- Via Ajax, get products data and send them in between this div. "Booking.js(getProductsFromDB)" -->
                </div>
                <div id="pagination" style="display: none; margin-top: 1rem">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end">
                            <li class="page-item"><a id="prevBtn" class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a id="currentPage"  class="page-link" href="#">1</a></li>
                            <li class="page-item"><a id="2ndPage" class="page-link" href="#">2</a></li>
                            <li class="page-item"><a id="3rdPage" class="page-link" href="#">3</a></li>
                            <li class="page-item"><a id="nextBtn" class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 107%">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button id="closeCal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="background-color: white" id="itemCalendar"></div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div aria-hidden="true" aria-labelledby="ModalLabel" class="modal fade" id="usermodal" role="dialog"
     tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lån</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="user_modal_content" class="modal-body">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/itemCalendar.js"></script>
<script type="text/javascript" src="assets/js/booking.js"></script>
<script type="text/javascript" src="assets/js/bookingtimer.js"></script>
<?php
include "includes/footer.php";
?>


