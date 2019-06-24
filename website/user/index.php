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
?>
	<div class="header">
		<h2>Låne System</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php
						echo $_SESSION['success'];
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">	<img id="profile-image" height="50" width="50" src="../assets/images/admin.png"><strong><?php echo $_SESSION['user']['name']; ?></strong></br></h5>
                <h6 class="card-subtitle mb-2 text-muted"><i><?php echo $_SESSION['user']['email']; ?></i></h6>
            </div>
		</div>
	</div>

