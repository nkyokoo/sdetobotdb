<?php

include 'includes/header.php';
?>
    <!--this formular  is used for registration. post the information tp auth.php-->
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="assets/js/login-site.js"></script>


    <link rel="stylesheet" href="assets/css/register.css">
    <script src="assets/js/login-site.js"></script>

    <content>
        <div class='container'>
            <div class='row'>
                <div class='col'></div>
                <div class='col'></div>
                <div class='col'>
                    <div class="card" style="width: 18rem; margin-top: 1.5rem">
                        <div class="card-header">
                            <img src="assets/images/logo.svg" alt="">

                        </div>
                        <div class="card-body">
                            <form id="regid" method="post" action="authenticator.php">
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
                                    <label for="password_1" class="bmd-label-floating">Password</label>
                                    <input type="password" id="password_1" class="form-control" name="password_1"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="password_2" class="bmd-label-floating">Bekræft password</label>
                                    <input type="password" id="password_2" class="form-control" name="password_2"
                                           required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="register_btn" class="btn btn-primary btn-raised"
                                            name="register_btn">Register
                                    </button>

                                </div>
                                <p>
                                    Allerede bruger? <a href="login.php">Login her</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <div class="copyrightLoginSite">
                        <p class="copyrightLoginSiteText">
                            Copyright © SDE IT OG DATA
                        </p>
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
    </content>


<?php
  include "includes/footer.php";