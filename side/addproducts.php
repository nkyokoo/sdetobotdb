<?php


//include 'includes/connect.php';

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
    <form>
        <div>
            <select id="kategori_id" onchange="AddNewInputOfAndet(this.id)" required>
                <option value="">Kategori</option>
                <?php
                $sql = "SELECT * FROM booking.category";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['category_name']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";

                }

                ?>
            </select>

            <input id="produkt_id" type="text"  placeholder="Produkt navn" required>

            <select id="virksomhed_id" onchange="AddNewInputOfAndet(this.id)" required>

                <?php
                echo "<option value=''>Virksomhed</option>";


                $sql = "SELECT adress FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY adress)";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['adress']."'>".$row['adress']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";

                }
                ?>
            </select>

            <select id="lokale_id" onchange="AddNewInputOfAndet(this.id)"required>
                <option value="">Lokale</option>
                <?php


                $sql = "SELECT lokale FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY lokale)";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['lokale']."'>".$row['lokale']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";

                }
                ?>
            </select>

            <select id="hylde_id" onchange="AddNewInputOfAndet(this.id)"required>
                <option value="">Hylde</option>
                <?php


                $sql = "SELECT hylde FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY hylde)";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['hylde']."'>".$row['hylde']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";

                }
                ?>
            </select>

            <select id="plads_id" onchange="AddNewInputOfAndet(this.id)"required>
                <option value="">Plads</option>
                <?php


                $sql = "SELECT plads FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY plads)";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['plads']."'>".$row['plads']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";

                }
                ?>
            </select>
            <select id="flytbar_id"required>
                <option value="">Flytbar</option>
                <option value="ja">ja</option>
                <option value="nej">nej</option>

            </select>
            <input id="antal_id" type="number" placeholder="Antal" min="0" max="999" required>
            <select id="leverandoer_id" onchange="AddNewInputOfAndet(this.id)" required>
                <option value="1">Leverandør</option>
                <?php


                $sql = "SELECT id,leverandoer_name FROM booking.leverandoer";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['leverandoer_name']."</option>";
                    }
                    echo "<option value='_Leverandorandet'>Andet</option>";
                }
                ?>
            </select>
        </div>
        <textarea id="description_id" placeholder="Description" rows="6" cols="30" required></textarea>
        <input type="button" value="Tilføj"  onclick="BtnAddProduct()">
    </form>
</div>
<?php
include "includes/footer.php";
$mysqli->close();
?>
