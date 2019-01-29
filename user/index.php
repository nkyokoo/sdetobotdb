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
	<div class="nav" id="myNav">
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

	<div class="content">
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
							<thead>
								<tr class="table100-head">
									<th class="column1">Navn</th>
									<th class="column2">Beskrivelse</th>
									<th class="column3">Antal</th>
									<th class="column4">Book</th>
								</tr>
							</thead>
							<tbody>
								<?php include('../includes/usertable.php') ?>	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer class="footer">
		<p>Copyright © 2019 <a href="https://www.sde.dk/">Sydansk Erhvervsskole</a></p> 
	</footer>


<script type="text/javascript">
	// When the user scrolls the page, execute myFunction
	window.onscroll = function() {myFunction()};

	// Get the header
	var header = document.getElementById("myNav");

	// Get the offset position of the navbar
	var sticky = header.offsetTop;

	// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
	function myFunction() {
	  if (window.pageYOffset > sticky) {
	    header.classList.add("stickyNav");
	  } else {
	    header.classList.remove("stickyNav");
	  }
	} 
</script>	
</body>
</html>