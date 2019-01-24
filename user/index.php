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
</head>
<body>
	<div class="nav">
		<div class="navbar">
			
		</div>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../assets/images/user.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['name']; ?></strong> <i><?php echo $_SESSION['user']['email']; ?></i></br>
					<a href="../index.php?logout='1'" style="color:#D10068; text-decoration:none;"> Log ud</a>

				<?php endif ?>
			</div>
		</div>
	</div>

	<div class="alert">
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
	</div>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<!--
						<thead>
							<tr class="table100-head">
								<th class="column1">Date</th>
								<th class="column2">Order ID</th>
								<th class="column3">Name</th>
								<th class="column4">Price</th>
							</tr>
						</thead>
						-->
						<tbody>
								<tr>
									<td class="column1">Intel Core i3</td>
									<td class="column2">Beskrivelse</td>
									<td class="column3">Antal lån</td>
									<td class="column4">Book</td>
								</tr>
								<tr>
									<td class="column1">Intel Core i3</td>
									<td class="column2">Beskrivelse</td>
									<td class="column3">Antal lån</td>
									<td class="column4">Book</td>
								</tr>
								<tr>
									<td class="column1">Intel Core i3</td>
									<td class="column2">Beskrivelse</td>
									<td class="column3">Antal lån</td>
									<td class="column4">Book</td>
								</tr>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<p>Copyright © 2019 <a href="https://www.sde.dk/">Sydansk Erhvervsskole</a></p> 
	</footer>
</body>
</html>