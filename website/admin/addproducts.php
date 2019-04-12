
<?php


//include 'includes/connect.php';

include "adminprotection.php";
include "../includes/header.php";
include "../includes/navbar.php";
include '../includes/sidebar.php';

echo "
<link rel=\"stylesheet\" href=\"../assets/css/loading.css\">
<div class=\"loadingscreen\" id=\"loading\">
    <div class=\"loadingbar\">
        <div class=\"lds-roller\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
</div>";

?>

<script src="../assets/js/addproducts.js">
</script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Produkt registreringsform</h5>
        </div>
        <div class="card-body">
        <form method="post" action="addproducts.php">
            <div class="form-group">
                <label for="kategori_id" class="bmd-label-floating">kategori</label>
                <select id="kategori_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>
                    <?php
                    $url = 'http://localhost:8000/api/booking/category/get?type=category';
                    $result = file_get_contents($url, false);
                    $jsonData = json_decode($result, true);

                    if (sizeof($jsonData) > 0) {
                        foreach ($jsonData as $i) {
                            echo "<option value='" . $i['id'] . "'>" . $i['category_name'] . "</option>";
                        }

                    }
                    echo "<option value='andet'>Tilføj Ny</option>";

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="produkt_id" class="bmd-label-floating">produkt navn</label>
                <input id="produkt_id"  class="form-control" type="text"  required>
            </div>
            <div class="form-group">
                <label for="virksomhed_id" class="bmd-label-floating">virksomhed</label>
                <select id="virksomhed_id" class="form-control"  onchange="addNewInputOfAndet(this.id)" required>

                <?php
                //WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY adress
                $url = 'http://localhost:8000/api/booking/category/get?type=company';
                $result = file_get_contents($url, false);
                $jsonData = json_decode($result,true);

                if (sizeof($jsonData) > 0){
                foreach ($jsonData as $i){
                        echo "<option value='".$i['id']."'>".$i['company_name_short']."</option>";
                    }
                }
                
                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="lokale_id" class="bmd-label-floating">lokale</label>
                <select id="lokale_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>
                <?php


                $url = 'http://localhost:8000/api/booking/category/get?type=room';
                $result = file_get_contents($url, false);
                $jsonData = json_decode($result,true);

                if (sizeof($jsonData) > 0){
                    foreach ($jsonData as $i){
                        echo "<option value='".$i['id']."'>".$i['room']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="svf_id" class="bmd-label-floating">Skab/Væg/Floor</label>
                <select id="svf_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>
                <?php


                $url = 'http://localhost:8000/api/booking/category/get?type=svf';
                $result = file_get_contents($url, false);
                $jsonData = json_decode($result,true);

                if (sizeof($jsonData) > 0){
                    foreach ($jsonData as $i){
                        echo "<option value='".$i['id']."'>".$i['type'].$i['nr']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="thp_id" class="bmd-label-floating">Hylde/Tavle/Plads</label>
                <select id="thp_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>
                <?php

                $url = 'http://localhost:8000/api/booking/category/get?type=svf';
                $result = file_get_contents($url, false);
                $jsonData = json_decode($result,true);

                if (sizeof($jsonData) > 0){
                    foreach ($jsonData as $i){
                        echo "<option value='".$i['id']."'>".$i['type'].$i['nr']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="flytbar_id" class="bmd-label-floating">Flytbar</label>
                <select class="form-control" id="flytbar_id" required>
                <option value="ja">ja</option>
                <option value="nej">nej</option>

            </select>
            </div>
            <div class="form-group">
                <label for="antal_id" class="bmd-label-floating">antal</label>
            <input id="antal_id" class="form-control"  type="number" min="0" max="999" required>
            </div>
            <div class="form-group">
                <label for="leverandoer_id" class="bmd-label-floating">Leverandør</label>
                <select id="leverandoer_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>
                <?php


                $url = 'http://localhost:8000/api/booking/category/get?type=company2';
                $result = file_get_contents($url, false);
                $jsonData = json_decode($result,true);

                if (sizeof($jsonData) > 0){
                    foreach ($jsonData as $i){
                        echo "<option value='".$i['id']."'>".$i['name']."</option>";
                    }
                }
                echo "<option value='_Leverandorandet'>Tilføj Ny</option>";
                ?>
            </select>
            </div>
            <div class="form-group">
            <select class="form-control"  o required>
                <option>Worker (progress)</option>
            </select>
        </div>
        <textarea id="description_id" class="form-control" placeholder="Produkt beskrivelse" rows="6" cols="30" required></textarea>
        <input id="button" type="submit"  class="btn btn-primary btn-raised" value="Tilføj">
    </form>
        </div>
    </div>
</div>

<?php

echo "
<script>
        $('#loading').remove();
</script>";
include "../includes/footer.php";

?>

