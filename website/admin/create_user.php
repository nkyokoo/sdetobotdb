<?php
    session_start();
    include ('../includes/header.php');
    include('../includes/navbar.php');
include '../includes/sidebar.php';
?>
<body>
<script src="../assets/js/administration.js">
</script>
    <div class='container'>
    <div class='row'>
    <div class='col'></div>
    <div class='col'></div>
    <div class='col'>
    <div class="card" style="width: 40rem; margin-top: 1.5rem">
    <div class="card-header">
        <h1>Admin - Opret bruger</h1>
    </div>
    <div class="card-body">
	<form id="admin-user-registration">
		 <div class="form-group">
			<label for="createUserName" class="bmd-label-floating">Navn</label>
			<input class="form-control" type="text" id="createUserName" name="name">
		</div>
		 <div class="form-group">
			<label for="createUserEmail" class="bmd-label-floating">Email</label>
			<input class="form-control"  autocomplete="email" type="email" id="createUserEmail" name="email">
		</div>
		 <div class="form-group">
			<label for="user_type" class="bmd-label-floating">Bruger Gruppe</label>
			<select class="form-control" name="user_type" id="user_type" >
                <option value="">Vælg rettighed</option>
                <?php
                $url = 'http://localhost:8000/api/users/group/get';
                $options = array(
                    'http' => array(
                        'method' => 'GET',
                        'header' => 'Authorization: '.$_SESSION['user']['token'],
                    )
                );
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $jsonData = json_decode($result, true);
                foreach ($jsonData as $element){
                    echo "<option value='{$element['id']}'>{$element['user_rank']}</option>";
                }
                ?>
			</select>
		</div>
		 <div class="form-group">
			<label for="password_1" class="bmd-label-floating">Password</label>
			<input class="form-control" type="password" autocomplete="new-password" id="password_1" name="password_1">
		</div>
		 <div class="form-group">
			<label for="password_2"  class="bmd-label-floating">Bekræft password</label>
			<input class="form-control" type="password" autocomplete="new-password" id="password_2" name="password_2">
		</div>
        <div class="form-group">
            <button type="button" id="createUser_btn" class="btn btn-primary btn-raised"
                    name="register_btn">Opret bruger
            </button>

        </div>
    </form>
    </div>
    </div>
    </div>
        <div class='col'></div>
        <div class='col'></div>
    </div>
        <div class='row'>
            <div class='col col-sm-4'>
            </div>
            <div class='col ol-sm-4'>

            </div>
            <div class='col col-sm-4'>
            </div>
        </div>
        <div id="issuemodal"class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div id="issue" class="modal-content">

                </div>
            </div>
        </div>
    </div>
<?php
 include("../includes/footer.php")
?>