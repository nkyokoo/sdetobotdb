<?php

include 'auth.php';

include 'includes/header.php';
?>

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
			Allerede bruger? <a href="login.php">Login her</a>
		</p>
	</form>
<?php
	include 'includes/footer.php';
