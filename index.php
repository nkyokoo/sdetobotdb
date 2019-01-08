<?php
   	error_reporting(E_ALL);
   	ini_set("display_errors", 1);

	ob_start();
	session_start();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Proto</title>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container">
			<div class="login">
				<div id="login-form">
					<form action="functions/auth.php" method="POST">
						<label for="email">Email:</label>
						<input type="text" name="email" id="email">
						<label for="password">Kodeord:</label>
						<input type="password" name="password" id="password">

						<input type="submit" value="Login">
					</form>					
				</div>
			</div>
		</div>
	</body>
</html>