<?php
session_start();
if (isset($_SESSION['user'])){

}
include 'includes/header.php';
include 'includes/navbar.php';

?>
<link rel="stylesheet" href="assets/css/login.css">



<!DOCTYPE html>

<content>
    <div class='container'>
        <div class='row'>
            <div class='col col-sm-4'>
            </div>
            <div class='col col-sm-4'>
            </div>
            <div class='col col-sm-4'>
            </div>
        </div>
        <div class='row'>
            <div class='col'></div>
            <div class='col'>
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <div class="header">
                            <h2>SDE - Login</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="authenticator.php">
                            <?php  //if ($logind) $class->display_error(); ?>


                            <div class="form-group">
                                <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                                <label for="nameinput" class="bmd-label-floating">Email</label>
                                <input type="email" class="form-control" id="nameinput" name="email" required>
                            </div>
                            <div class="form-group bmd-form-group"> <!-- manually specified -->
                                <label for="passwordInput" class="bmd-label-floating">Adgangskode</label>
                                <input type="password" class="form-control" id="passwordInput" name="password" required>
                            </div>
                            <button type="sumbit" class="btn btn-primary btn-raised" name="login_btn">Login</button>

                            <p style="color: black !important;">
                                Ingen bruger? opret en <a href="register.php">her</a>
                            </p>
                        </form>
                    </div>

            </div>

            <div class='col'></div>
            <div class='col'></div>
            <div class='col'></div>
          </div>
            <div class='row'>
                <div class='col col-sm-4'>
                </div>
                <div class='col ol-sm-4'>
                </div>
                <div class='col col-sm-4'>
                </div>
            </div>
        </div>
</content>
<?php
//include 'includes/footer.php';
?>
