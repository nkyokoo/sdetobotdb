<?php include('auth.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='sde udlånsystem til automation og robotteknologi'>
    <meta name='theme-color' content='#2196F3'>
    <meta content="" property='og:image'>
    <meta content='SDE AUTOMATION OG ROBOTTEKNOLOGI' property='og:title'>
    <meta content='sde udlånsystem til automation og robotteknologi' property='og:description'>
    <meta name='revisit-after' content='2 days'>
    <meta name='keywords' content='sde,robot'>

	<title>SDE AUTOMATION OG ROBOTTEKNOLOGI</title>

	<link rel="stylesheet" type="text/css" href="assets/css/_stylesheets.css">
    <link rel='icon' type='image/x-icon' href='favicon.ico'>
</head>
<body>
	<div class="header">
		<h2>SDE - Login</h2>
	</div>
	<form method="post" action="index.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Navn</label>
			<input type="text" name="name" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
		<p>
			Ingen bruger? opret en <a href="register.php">her</a>
		</p>
	</form>

	<footer class="footer">
		<p>Copyright © 2019 <a href="https://www.sde.dk/">Sydansk Erhvervsskole</a></p>
	</footer>
</body>
</html>
