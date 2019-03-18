<?php
//session_start();
include './api/fileroute.php';
include 'includes/header.php';

?>


<!DOCTYPE html>

<content>
	<div class="header">
		<h2>SDE - Login</h2>
	</div>
	<form method="post" action="login.php">
      <?php if ($logind) $class->display_error();?>


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
</content>

<?php
  include 'includes/footer.php';
 ?>
