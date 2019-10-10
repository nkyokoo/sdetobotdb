<?php
 session_start();
	include 'includes/header.php';
	include 'includes/navbar.php';
	include 'includes/sidebar.php';


?>
<div class="container">
	<?php
    echo $_SESSION['user']['token'];
	include 'info.php';
	?>
</div>
<?php
include 'includes/footer.php';


