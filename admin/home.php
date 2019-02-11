<?php
include '../auth.php';
include '../includes/header.php';
include '../includes/sidebar.php';


if (!isAdmin()) {
	$_SESSION['msg'] = "Du skal være logget ind først, for at se denne side.";
	header('location: ../index.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
}
?>


	<div class="headerAdmin">
		<h2>Admin - Dashboard</h2>
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
			<img src="../assets/images/admin.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['name']; ?></strong></br>
					<i><?php echo $_SESSION['user']['email']; ?></i>

					<small>
						<i  style="color: #888;"><?php echo ucfirst($_SESSION['user']); ?></i>
						<br>
						<a href="home.php?logout='1'" style="color: red;"> Log ud</a>
                       &nbsp; <a href="create_user.php"> + Tilføj bruger</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>

	<?php
	include './includes/footer.php';
	 ?>
