<?php
if (isset($_SESSION['user']['user_group_id'])) {
    header('location: ../index.php');
}

session_start();
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


$userrank = "";
switch (strval($_SESSION['user']['user_group_id'])) {
    case "1":
        $userrank = "Super Administrator";
        break;
    case "2":
        $userrank = "Administrator";
        break;
    case "3":
        $userrank = "Almindelig bruger";

}
?>

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
            </div>

            <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <div class=card style="width: 20rem;">
                        <div class="card-body">
                            <div class="card-top" style="display: flex; align-items:center;">
                                <img style="display: inline; vertical-align: middle" id="profile-image" height="50"
                                     width="50"
                                     src="../assets/images/admin.png" alt="profile picture">
                                <h5 id="username_profile" class="card-title"
                                    style="display: inline"><?php echo $_SESSION['user']['name']; ?></h5>
                                <button id="accept_changes" style="display: none;" class="btn">
                                    <i style="color: white" class="material-icons">check</i>
                                </button>
                                <button id="cancel_changes" style="display: none;" class="btn">
                                    <i style="color: white" class="material-icons">cancel</i>
                                </button>
                                <button id="unlock_edit_password" style="display: inline;" class="btn">
                                    <i style="color: white" class="material-icons">edit</i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class=card style="width: 20rem;">
                        <div class="card-header">
                            User info
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                id: <?php echo $_SESSION['user']['id']; ?>
                            </li>
                            <li class="list-group-item">
                                <i class="material-icons">email</i><?php echo $_SESSION['user']['email']; ?>
                            </li>
                            <li class="list-group-item">
                                <i class="material-icons">group_work</i><?php echo $userrank ?>
                            </li>
                        </ul>
                    </div>
                    <div class=card style="width: 20rem;">
                        <div class="card-header" style="display: inline">
                            <p style="display: inline; width: 2rem">Password</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
                                    <label for="password_1" class="bmd-label-floating">Nuværende adgangskode</label>
                                    <input type="password" class="form-control" id="password_1">
                                </div>
                                <div class="form-group bmd-form-group"> <!-- manually specified -->
                                    <label for="password_2" class="bmd-label-floating">Ny adgangskode</label>
                                    <input type="password" class="form-control" id="password_2">
                                </div>
                                <div class="form-group bmd-form-group"> <!-- manually specified -->
                                    <label for="password_3" class="bmd-label-floating">Gentag adgangskode</label>
                                    <input type="password" class="form-control" id="password_3">
                                </div>
                            </form>
                            <button class="btn btn-raised btn-danger" id="change_password">change password
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-md-4"></div>
            </div>

            <!-- Columns are always 50% wide, on mobile and desktop -->
            <div class="row">s
                <div class="col-6"></div>
                <div class="col-6"></div>
            </div>
            <!-- logged in user information -->
        </div>
    </div>
<?php
include '../includes/footer.php';

