<?php
include 'admin_includes/adminprotection.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


?>
    <script src="../assets/js/administration.js"></script>
<div class="container">

    <div class="card mb-3" style="width: auto; margin-top: 10px; background: #ededed">
        <table class="table" style="overflow-x: scroll">
            <thead class="thead-dark">

            <tr>
                <th scope="col">Navn</th>
                <th scope="col">Email</th>
                <th scope="col">Rank</th>
                <th scope="col">Deaktiveret</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $url = 'http://localhost:8000/api/users/get';
            $options = array(
                'http' => array(
                    'method' => 'GET',
                    'header' => 'Authorization: '.$_SESSION['user']['token'],
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $jsonData = json_decode($result, true);


            if (sizeof($jsonData) > 0) {
                foreach ($jsonData as $i) {
                    echo '<tr><td><button onclick="activateUser(\''.$i['id'].'\')" class="btn btn-success"><i class="material-icons">check</i></button><button onclick="deactivateUser(\''.$i['id'].'\')" class="btn btn-danger"><i class="material-icons">remove_circle</i></button>'.$i['name'].'</td> 
                    <td>'.$i['email'].'</td><td>'.$i['user_rank'].'</td>
                    <td>'.($i['disabled'] == 1 ? "ja" :  "nej").'</td></tr>';

                }

            }else{
                echo "well.. this is weird, no users got returned. How are you even logged in?";
            }

            ?>

            </tbody>
        </table>
        <div class="card-footer" style="background: #ededed">
            <a href="create_user.php" class="btn btn-raised btn-primary"> Tilføj bruger</a>
        </div>
    </div>
</div>
<?php
include "../includes/footer.php";