<?php
	include('../auth.php');
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='sde udlånsystem til automation og robotteknologi'>
    <meta name='theme-color' content='#2196F3'>
    <meta content='' property='og:image'>
    <meta content='SDE AUTOMATION OG ROBOTTEKNOLOGI' property='og:title'>
    <meta content='sde udlånsystem til automation og robotteknologi' property='og:description'>
    <meta name='revisit-after' content='2 days'>
    <meta name='keywords' content='sde,robot'>

	<title>SDE AUTOMATION OG ROBOTTEKNOLOGI</title>

	<link rel="stylesheet" type="text/css" href="../assets/css/_stylesheets.css">
    <link rel='icon' type='image/x-icon' href='favicon.ico'>
</head>
<body>
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
</body>
</html>
