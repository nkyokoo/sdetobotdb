<?php
    session_start();
    include ('../includes/header.php');
    include('../includes/navbar.php');
    include ('admin_includes/admin_sidebar.php')
?>
<body>
	<div class="header">
		<h2>Admin - Opret bruger</h2>
	</div>
	
	<form method="post" action="create_user.php">


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