<?php
session_start();
include '../includes/header.php';
include '../includes/navbar.php';
include 'admin_includes/admin_sidebar.php';


?>

<div class="container">

    <div class="card" style="width: auto; margin-top: 10px">
        <table class="table">
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
        <div class="card-footer">
            <a href="addproducts.php" class="btn btn-raised btn-primary"> Tilføj ny produkt</a>
        </div>
    </div>
</div>
