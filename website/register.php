<?php
if (isset($_SESSION['user'])){
    header("Location: ./");
}
include 'includes/header.php';
include 'includes/navbar.php'

?>
    <!--this formular  is used for registration. post the information tp auth.php-->


    <link rel="stylesheet" href="assets/css/register.css">


        <div class='container'>
            <div class='row'>
                <div class='col'></div>
                <div class='col'></div>
                <div class='col'>
                    <div class=card style="width: 18rem; margin-top: 1.5rem">
                        <div class="card-header">
                            <img src="assets/images/logo.svg" alt="">

                        </div>
                        <div class="card-body">
                            <form id="regid" method="post" action="backend_instantiate/authenticator.php">
                                <?php /* echo display_error();*/ ?>
                                <div class="form-group">
                                    <label for="registerName" class="bmd-label-floating">Navn</label>
                                    <input id="registerName" class="form-control" type="text" name="name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="registerEmail" class="bmd-label-floating">Email</label>
                                    <input type="email" class="form-control" id="registerEmail" name="email"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="new-password" class="bmd-label-floating">Password</label>
                                    <input type="password" id=registerPassword class="form-control" name="password_1"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="repeat-password" class="bmd-label-floating">Bekræft password</label>
                                    <input type="password" id="RegisterPasswordRepeat" class="form-control" name="password_2"
                                           required>
                                </div>
                                <div class="form-group">
                                    <button type="button" id="register_btn" class="btn btn-primary btn-raised"
                                            name="register_btn">Register
                                    </button>

                                </div>
                                <p>
                                    Allerede bruger? <a href="login.php">Login her</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
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



<?php
  include "includes/footer.php";