<?php

include 'includes/header.php';
?>
<!--this formular  is used for registration. post the informarion tp auth.php-->
<body>


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
                        <h2>SDE - Register</h2>
                    </div>

                </div>
                <div class="card-body">
                    <form id="regid" method="post" action="authenticator.php">
                        <?php/* echo display_error();*/ ?>
                        <div class="form-group">
                            <label for="registerName" class="bmd-label-floating">Navn</label>
                            <input id="registerName"  class="form-control" type="text" name="name" value="<?php $name; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="registerEmail" class="bmd-label-floating" >Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" value="<?php $email; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password_1" class="bmd-label-floating">Password</label>
                            <input type="password" id="password_1" class="form-control" name="password_1" required>
                        </div>
                        <div class="form-group">
                            <label for="password_2" class="bmd-label-floating">Bekræft password</label>
                            <input type="password" id="password_2"  class="form-control" name="password_2" required>
                        </div>
                        <div class="form-group">
                            <button type="submit"  id="register_btn" class="btn btn-primary btn-raised" name="register_btn">Register</button>

                        </div>
                        <p>
                            Allerede bruger? <a href="login.php">Login her</a>
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

<?php

	include 'includes/footer.php';
