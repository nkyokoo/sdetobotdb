<?php
include 'admin_includes/adminprotection.php';

include '../includes/header.php';
include '../includes/navbar.php';
include 'admin_includes/admin_sidebar.php';


?>
<link rel="stylesheet" href="../assets/css/administration.css">
<script src="../assets/js/administration.js"></script>
<div class="container">
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Produkter</li>
        <li class="tab-link" data-tab="tab-2">Produkt enheder</li>
    </ul>

    <div id="tab-1" class="tab-content current">
            <table class="table" style="overflow-x: scroll">
                <thead class="thead-dark">

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">produkt navn</th>
                    <th scope="col">kategori</th>
                    <th scope="col">flyttebar</th>
                    <th scope="col">levandør</th>
                    <th scope="col">skole navn</th>
                    <th scope="col">beskrivelse</th>
                </tr>
                </thead>
                <tbody>
                <?php

                $url = 'http://localhost:8000/api/booking/products/get';
                $result = file_get_contents($url, false);
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
        <a href="addproducts.php" class="btn btn-raised btn-primary"> Tilføj ny produkt</a>

    </div>
    <div id="tab-2" class="tab-content">
        <table class="table" style="overflow-x: scroll">
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
            $result = file_get_contents($url, false);
            $jsonData = json_decode($result, true);


            if (sizeof($jsonData) > 0) {
                foreach ($jsonData as $i) {
                    echo '<tr><th scope="row">'.$i['id'].'</th><td>'.$i['product_name'].'</td> 
                    <td>'.$i['unit_number'].'</td><td>'.$i['svf_type'].'</td><td>'.$i['thp_type'].'</td><td>'.$i[''].'</td><td>'.$i['description'].'</td></tr>';
                }

            }

            ?>

            </tbody>

        </table>
    </div>

</div>
