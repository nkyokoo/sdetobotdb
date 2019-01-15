<?php include('../auth.php') ?>
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
	
	<link rel="stylesheet" type="text/css" href="../assets/css/_stylesheets.css">
    <link rel='icon' type='image/x-icon' href='favicon.ico'>
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Opret bruger</h2>
	</div>
	
	<form method="post" action="create_user.php">

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
			<label>Bruger Gruppe</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="1">Admin</option>
				<option value="3">User</option>
			</select>
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
			<button type="submit" class="btn" name="register_btn"> + Opret bruger</button>
		</div>
	</form>
</body>
</html>