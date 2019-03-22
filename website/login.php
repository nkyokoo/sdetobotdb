<?php
//session_start();
//include './functions/fileroute.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';

?>
<link rel="stylesheet" href="assets/css/login.css">

<!DOCTYPE html>

<content>

    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <div class="header">
                <h2>SDE - Login</h2>
            </div>
        </div>
        <div class="card-body">
            <form method="post" action="login.php">
                <?php  //if ($logind) $class->display_error(); ?>


                <div class="form-group">
                    <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                    <label for="nameinput" class="bmd-label-floating">Navn</label>
                    <input type="text" class="form-control" id="nameinput" name="name">
                </div>
                <div class="form-group bmd-form-group"> <!-- manually specified -->
                    <label for="passwordInput" class="bmd-label-floating">Adgangskode</label>
                    <input type="text" class="form-control" id="passwordInput" name="password">
                </div>
                <button type="submit" class="btn btn-primary btn-raised" name="login_btn">Login</button>

                <p style="color: black !important;">
                    Ingen bruger? opret en <a href="register.php">her</a>
                </p>
            </form>
        </div>

</content>
<?php
include 'includes/footer.php';
?>
