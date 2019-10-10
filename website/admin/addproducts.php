
<?php

echo "
<link rel=\"stylesheet\" href=\"../assets/css/loading.css\">
<div class=\"loadingscreen\" id=\"loading\">
    <div class=\"loadingbar\">
        <div class=\"lds-roller\"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
</div>";
//include 'includes/connect.php';

include "admin_includes/adminprotection.php";
include "../includes/header.php";
echo "<link rel=\"stylesheet\" href=\"../assets/css/administration.css\">";
include "../includes/navbar.php";
include '../includes/sidebar.php';



?>
<script src="../assets/js/addproducts.js"></script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div class="container">
    <div id="product_registration_form"  style="display: none;" class=card>
        <div class="card-header">
            <h5 class="card-title">Produkt registrerings form</h5>
        </div>
        <div class="card-body">
        <form id="product_registration_forms" method="post" action="addproducts.php">
            <div class="form-group">
                <label for="kategori_id" class="bmd-label-floating">kategori</label>
                <select id="kategori_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>

                </select>
            </div>
            <div class="form-group">
                <label for="produkt_id" class="bmd-label-floating">produkt navn</label>
                <input id="produkt_id"  class="form-control" type="text"  required>
            </div>
            <div class="form-group">
                <label for="virksomhed_id" class="bmd-label-floating">virksomhed</label>
                <select id="virksomhed_id" class="form-control"  onchange="addNewInputOfAndet(this.id)" required>

            </select>
            </div>
            <div class="form-group">
                <label for="lokale_id" class="bmd-label-floating">lokale</label>
                <select id="lokale_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>

            </select>
            </div>
            <div class="form-group">
                <label for="svf_id" class="bmd-label-floating">Skab/Væg/Floor</label>
                <select id="svf_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>

            </select>
            </div>
            <div class="form-group">
                <label for="thp_id" class="bmd-label-floating">Hylde/Tavle/Plads</label>
                <select id="thp_id" class="form-control" onchange="addNewInputOfAndet(this.id)" required>

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

            </select>
            </div>
            <div class="form-group">
            <select class="form-control"   required>
                <option>Worker (progress)</option>
            </select>
        </div>
            <label for="description_id" class="bmd-label-floating">Produkt beskrivelse</label>
        <textarea id="description_id" class="form-control" rows="6" cols="30" required></textarea>
            <button id="createButton" type="button"  class="btn btn-primary btn-raised" style="display: flex">
                        <i class="material-icons" style="display: flex; ">add_box</i>
                        <p id="text">tilføj</p>
            </button>
    </form>
        </div>
    </div>
</div>

<?php

include "../includes/footer.php";

?>

