<?php include('auth.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
    <meta http-equiv='x-ua-compatible' content='ie=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content='sde udlånsystem til automation og robotteknologi '>
    <meta name='theme-color' content=''#2196F3'>
    <meta content='' property='og:image' />
    <meta content='SDE AUTOMATION OG ROBOTTEKNOLOGI' property='og:title' />
    <meta content='sde udlånsystem til automation og robotteknologi' property='og:description' />
    <meta name='revisit-after' content='2 days'>
    <meta name='keywords' content='sde,robot'>
	
	<title>SDE AUTOMATION OG ROBOTTEKNOLOGI</title>
	
	<link rel="stylesheet" type="text/css" href="assets/css/_stylesheets.css">
    <link rel='icon' type='image/x-icon' href='favicon.ico'>
</head>
<body>

	<div class="header">
		<h2>SDE - Register</h2>
	</div>
	<form method="post" action="register.php">
		<?php echo display_error(); ?>
		<div class="input-group">
			<label>Navn</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Bekræft password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn">Register</button>
		</div>
		<p>
			Allerede bruger? <a href="index.php">Login her</a>
		</p>
	</form>

	<footer class="footer">

	</footer>
</body>
</html>