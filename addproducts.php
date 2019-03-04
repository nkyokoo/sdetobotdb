<?php


//include 'includes/connect.php';
session_start();
include "includes/header.php";
include "includes/navbar.php";
include_once "includes/connect.php";
$con = new DBConnection();
$mysqli = $con->getConnection();



?>
<script src="assets/js/addproducts.js">

</script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div>
    <form action="addproducts.php">
        <div>
            <select id="kategori_id" onchange="addNewInputOfAndet(this.id)" required>
                <option value="">Kategori</option>
                <?php
                $sql = "SELECT id,category_name FROM category";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>

            <input id="produkt_id" type="text"  placeholder="Produkt navn" required>

            <select id="virksomhed_id" onchange="addNewInputOfAndet(this.id)" required>

                <?php
                echo "<option value=''>Virksomhed</option>";

                //WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY adress
                $sql = "SELECT id,company_name_short FROM `school_address_short`  GROUP BY company_name_short";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['company_name_short']."</option>";
                    }
                }
                ?>
            </select>

            <select id="lokale_id" onchange="addNewInputOfAndet(this.id)" required>
                <option value="">Lokale</option>
                <?php


                $sql = "SELECT id,room FROM `location_room` group by room";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['room']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>



            <select id="svf_id" onchange="addNewInputOfAndet(this.id)" required>
                <option value="">Skab/Væg/Floor</option>
                <?php


                $sql = "SELECT id,type,nr FROM product_location_type_svf GROUP BY type,nr";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['type'].$row['nr']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>
            <select id="thp_id" onchange="addNewInputOfAndet(this.id)" required>
                <option value="">Hylde/Tavle/Plads</option>
                <?php


                $sql = "SELECT id,type,nr FROM product_location_type_thp GROUP BY type,nr";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['type'].$row['nr']."</option>";
                    }

                }
                echo "<option value='andet'>Tilføj Ny</option>";

                ?>
            </select>
            <select id="flytbar_id"required>
                <option value="">Flytbar</option>
                <option value="ja">ja</option>
                <option value="nej">nej</option>

            </select>
            <input id="antal_id" type="number" placeholder="Antal" min="0" max="999" required>
            <select id="leverandoer_id" onchange="addNewInputOfAndet(this.id)" required>
                <option value="">Leverandør</option>
                <?php


                $sql = "SELECT id,name FROM supplier_company";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                }
                echo "<option value='_Leverandorandet'>Tilføj Ny</option>";
                ?>
            </select>
            <select>
                <option>Worker (progress)</option>
            </select>
        </div>
        <textarea id="description_id" placeholder="Produkt beskrivelse" rows="6" cols="30" required></textarea>
        <input id="button" type="button" value="Tilføj">
    </form>
</div>
<?php
include "includes/footer.php";
$mysqli->close();
?>

