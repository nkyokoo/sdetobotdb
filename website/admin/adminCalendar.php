<?php
include "admin_includes/adminprotection.php";
include "../includes/header.php";
include "../includes/navbar.php";
include '../includes/sidebar.php';
?>
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

<div class="container">

    <div style="background-color: white" id="calendar"></div>
</div>

<script  src="../assets/js/TestCalendar.js"></script>
<?php
include "../includes/footer.php";
?>