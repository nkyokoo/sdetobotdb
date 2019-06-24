<?php
include 'admin_includes/adminprotection.php';
include '../includes/header.php';
echo '<link rel="stylesheet" href="../assets/css/administration.css"">';
echo '<script src="../assets/js/administration.js"> </script>';
include '../includes/navbar.php';
include 'admin_includes/admin_sidebar.php';


if (!$_SESSION['user']['user_group_id']) {
	$_SESSION['msg'] = "Du skal være logget ind først, for at se denne side.";
	header('location: ../index.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../index.php");
}
?>


<div class="container">
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
        <div class="row">
            <div class="col-sm">

                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h1 class="card-title">Administrations dashboard</h1>
                        </div>
                    </div>
                </div>
            <div class="col-sm">
                <div class="card">
                    <h5 class="card-header">Produkter</h5>
                    <div class="card-body">
                        <a class="list-group-item">
                            Antal registerede produkter
                            <?php
                            $url = 'http://localhost:8000/api/booking/products/get';
                            $options = array(
                                'http' => array(
                                    'method' => 'GET',
                                    'header' => 'Authorization: '.$_SESSION['user']['token'],
                                )
                            );
                            $context = stream_context_create($options);
                            $result = file_get_contents($url, false, $context);
                            $jsonData = json_decode($result, true);

                            echo "<span  id='total-product-number' class='label label-default label-pill pull-xs-right'>".count($jsonData)."</span>";


                            ?>
                        </a>
                        <a href="products.php" class="btn btn-primary">Se fulde produkt database</a>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                        <h5 class="card-header">Låne anmodninger</h5>
                        <div class="card-body">
                            <a class="list-group-item">
                                Antal låne anmodninger
                                <?php
                                $url = 'http://localhost:8000/api/request/get';
                                $options = array(
                                    'http' => array(
                                        'method' => 'GET',
                                        'header' => 'Authorization: '.$_SESSION['user']['token'],
                                    )
                                );
                                $context = stream_context_create($options);
                                $result = file_get_contents($url, false, $context);
                                $jsonData = json_decode($result, true);

                                echo "<span  id='total-request-number' class='label label-default label-pill pull-xs-right'>".count($jsonData)."</span>";


                                ?>
                            </a>
                            <a href="acceptrequests.php" class="btn btn-primary">Accepter anmodninger</a>
                        </div>
                    </div>
            </div>
        </div>
            <div class="row">
                <div class="col-sm">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">	<img id="profile-image" height="50" width="50" src="../assets/images/admin.png"><strong><?php echo $_SESSION['user']['name']; ?></strong></br></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><i><?php echo $_SESSION['user']['email']; ?></i></h6>
                            <a class="btn btn-raised btn-danger" href="index.php?logout='1'" > Log ud</a>
                            <a class="btn btn-raised btn-primary" href="create_user.php"> <i class="material-icons" style="display:  vertical-align: bottom; font-size: 18px !important;">person_add</i> Tilføj bruger</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <h5 class="card-header"> Brugere </h5>
                        <div class="card-body">
                            <a class="list-group-item">
                                Antal registerede brugere
                                <?php
                                $url = 'http://localhost:8000/api/users/count/get';
                                $options = array(
                                    'http' => array(
                                        'method' => 'GET',
                                        'header' => 'Authorization: '.$_SESSION['user']['token'],
                                    )
                                );
                                $context = stream_context_create($options);
                                $result = file_get_contents($url, false, $context);
                                $jsonData = json_decode($result, true);
                                echo "<span id='total-request-number' class='label label-default label-pill pull-xs-right'>{$jsonData[0]['count']}</span>";


                                ?>
                            </a>
                            <a href="users.php" class="btn btn-primary">Se alle brugere</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <a class="list-group-item">


                            </a>
                            <a href="" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <a class="list-group-item">


                            </a>
                            <a href="" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <a class="list-group-item">


                            </a>
                            <a href="" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card">
                        <h5 class="card-header"></h5>
                        <div class="card-body">
                            <a class="list-group-item">


                            </a>
                            <a href="" class="btn btn-primary"></a>
                        </div>
                    </div>
                </div>
            </div>

           <div class="row">
               <div class="col-sm">
                   <div class="card">
                       <h5 class="card-header"></h5>
                       <div class="card-body">
                           <a class="list-group-item">


                           </a>
                           <a href="" class="btn btn-primary"></a>
                       </div>
                   </div>
               </div>
             <div class="col-sm">
                 <div class="card">
                     <h5 class="card-header"></h5>
                     <div class="card-body">
                         <a class="list-group-item">


                         </a>
                         <a href="" class="btn btn-primary"></a>
                     </div>
                 </div>
             </div>
            <div class="col-sm">
                <div class="card">
                    <h5 class="card-header"></h5>
                    <div class="card-body">
                        <a class="list-group-item">


                        </a>
                        <a href="" class="btn btn-primary"></a>
                    </div>
                </div>
            </div>
           </div>
        </div>

	<?php
	include '../includes/footer.php';
	 ?>
