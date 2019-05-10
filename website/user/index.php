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
		<div class="profile_info">
			<img src="../assets/images/user.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['name']; ?></strong>

					<small>
						<i  style="color: #888;"><?php echo ucfirst($_SESSION['user']); ?></i>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>

