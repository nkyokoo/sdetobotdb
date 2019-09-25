<?php
include 'admin_includes/adminprotection.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>
    <link rel="stylesheet" href="../assets/css/administration.css">
    <script src="../assets/js/administration.js"></script>
    <div class="container">
        <div id="material-tabs">
            <a id="tab1-tab" href="#tab1" class="active">Produkter</a>
            <a id="tab2-tab" href="#tab2">Produkt Enheder</a>
            <span class="yellow-bar"></span>
        </div>

        <div class="tab-content">
            <div id="tab1">
                <form style="display: inline; margin-left: 1rem" class="form-group">
                    <label for="product-search" class="bmd-label-floating">Søg</label>
                    <input  id="product-search" style="width: 10rem; display: inline" type="text" class="form-control">
                    <button style="display: inline" class="btn btn-primary" type="button" id="product-search-btn"><i
                                class="material-icons">search</i></button>
                </form>
                <div id="productgrid" style="height: 600px;" class="ag-theme-material"></div>

                <a style="margin-left: 1rem" href="addproducts.php" class="btn btn-raised btn-primary"> Tilføj ny produkt</a>

            </div>

            <div id="tab2">
                <div id="unitgrid" style="height: 600px;" class="ag-theme-material"></div>


            </div>
        </div>
    </div>
<?php
include "../includes/footer.php";