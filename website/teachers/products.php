<?php
include 'admin_includes/adminprotection.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


?>
<link rel="stylesheet" href="../assets/css/administration.css">
<script src="../assets/js/administration.js"></script>
<div class="container">
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Produkter</li>
        <li class="tab-link" data-tab="tab-2">Produkt enheder</li>
    </ul>

    <div id="tab-1" class="tab-content current">
         <div class="scrollbar">
             <table class="table">
                 <thead class="thead-dark">

                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">produkt navn</th>
                     <th scope="col">kategori</th>
                     <th scope="col">flytbar</th>
                     <th scope="col">leverandør</th>
                     <th scope="col">skole navn</th>
                     <th scope="col">beskrivelse</th>
                 </tr>
                 </thead>
                 <tbody>
                 <?php

                 $url = 'http://localhost:8000/api/booking/products/get';
                 $options = array(
                     'http' => array(
                         'header' => 'Authorization: '.$_SESSION['user']['token'],
                         'method' => 'GET',
                     )
                 );
                 //send request to api and get result
                 $context = stream_context_create($options);

                     $result = file_get_contents($url, false, $context);
                     $jsonData = json_decode($result, true);




                 if (sizeof($jsonData) > 0) {
                     foreach ($jsonData as $i) {
                         echo '<tr><th scope="row">'.$i['id'].'</th><td>'.$i['product_name'].'</td> 
                    <td>'.$i['category_name'].'</td><td>'.$i['movable'].'</td><td>'.$i['name'].'</td><td>'.$i['school_name'].'</td><td>'.$i['description'].'</td></tr>';
                     }

                 }

                 ?>
                 </tbody>

             </table>
         </div>

        <a href="addproducts.php" class="btn btn-raised btn-primary"> Tilføj ny produkt</a>

    </div>
    <div id="tab-2" class="tab-content">
        <div class="scrollbar">
        <table class="table">
            <thead class="thead-dark">

            <tr>
                <th scope="col">#</th>
                <th scope="col">Produkt navn</th>
                <th scope="col">Enheds nummer</th>
                <th scope="col">SVF</th>
                <th scope="col">THP</th>
                <th scope="col">Lokale</th>
                <th scope="col">Tilgængelighed</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $url = 'http://localhost:8000/api/booking/products/units/get';
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
                    echo '<tr><th scope="row">'.$i['id'].'</th><td>'.$i['product_name'].'</td> 
                    <td>'.$i['unit_number'].'</td><td>'.$i['svf_type'].$i['svf_number'].'</td><td>'.$i['thp_type'].$i['thp_number'].'</td><td>'.$i['room'].'</td><td>'.$i['status_name'].'</td></tr>';
                }

            }

            ?>

            </tbody>

        </table>
        </div>
    </div>

</div>
<?php
 include "../includes/footer.php";