<?php
include 'admin_includes/adminprotection.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


?>
    <script src="../assets/js/administration.js"></script>
<div class="container">

    <div class="card mb-3" style="width: auto; margin-top: 10px; background: #ededed">
        <div id="usergrid" style="height: 600px;" class="ag-theme-material"></div>

        <div class="card-footer" style="background: #ededed">
            <a href="create_user.php" class="btn btn-raised btn-primary"> Tilføj bruger</a>
        </div>
    </div>
</div>
<?php
include "../includes/footer.php";