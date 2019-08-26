<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


if (!$_SESSION['user']['user_group_id']) {
    $_SESSION['msg'] = "Du skal være logget ind først, for at se denne side.";
    header('location: ../index.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../index.php");

}
$userrank = "";
switch (strval($_SESSION['user']['user_group_id'])) {
    case "1":
        $userrank = "admin bruger";
        break;
    case "2":
        $userrank = "super bruger";
        break;
    case "3":
        $userrank = "almindelig bruger";

}
?>

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-12 col-md-8"></div>
                <div class="col-6 col-md-4"></div>
            </div>

            <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
            <div class="row">
                <div class="col-6 col-md-4"></div>
                <div class="col-6 col-md-4">
                    <div class="card text-white bg-dark mb-3" style="width: 20rem;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <img id="profile-image" height="50" width="50"
                                     src="../assets/images/admin.png" alt="profile picture"><?php echo $_SESSION['user']['name']; ?>
                            <h6 class="card-subtitle mb-2 text-muted"><i></i></h6>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-3" style="width: 20rem;">
                        <div class="card-header">
                            User info
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                id: <?php echo $_SESSION['user']['id']; ?>
                            </li>
                            <li class="list-group-item"><i
                                        class="material-icons">email</i><?php echo $_SESSION['user']['email']; ?>
                            </li>
                            <li class="list-group-item"><i class="material-icons">group_work</i><?php echo $userrank ?> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-6 col-md-4"></div>
            </div>

            <!-- Columns are always 50% wide, on mobile and desktop -->
            <div class="row">
                <div class="col-6"></div>
                <div class="col-6"></div>
            </div>
            <!-- logged in user information -->
        </div>
    </div>
<?php
include '../includes/footer.php';

