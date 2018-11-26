<?php


//include 'includes/connect.php';

include "includes/header.php";
include "includes/navbar.php";

$mysql = new mysqli('localhost','root','root','booking',3307);









?>
<script>
    function BtnAddProduct() {

        let kategori = $(kategori_id).val();
        let produkt_navn = $(produkt_id).val();
        let virksomhed = $(virksomhed_id).val();
        let lokale = $(lokale_id).val();
        let hylde = $(hylde_id).val();
        let plads = $(plads_id).val();
        let antal = $(antal_id).val();
        let description = $(description_id).val();
        let flytbar = $(flytbar_id).val();
        let leverandoer = $(leverandoer_id).val();

        $.ajax({
            type:'post',
            url:'includes/AddProductToDatabase.php',
            data: {kategori: kategori,produkt_navn: produkt_navn,virksomhed: virksomhed,lokale: lokale,hylde: hylde,plads: plads,antal: antal,description: description,flytbar:flytbar,leverandoer:leverandoer},
            success:function (data) {
               // alert("You've succeed in creating a new product!");
                alert(data);
                alert("sht");
            }
        });




    }
</script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div>
    <form action="includes/AddProductToDatabase.php" method="post">
        <div>
            <select id="kategori_id">
                <option value="">Kategori</option>
                <?php
                $sql = "SELECT * FROM booking.category";
                   $result = $mysql->query($sql);

                ?>
            </select>

            <input id="produkt_id" type="text" value="s" placeholder="Produkt navn">

            <select id="virksomhed_id">
                <option value="">Virksomhed</option>
                <?php
                $sql = "SELECT lokale FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY lokale)";
                   $result = $mysql->query($sql);
                    if ($result->num_rows > 0){
                        while ($row = $result->fetch_all()){
                            echo "<option value='".$row['lokale']."'>".$row['lokale']."</option>";
                        }
                    }
                ?>
            </select>

            <select id="lokale_id">
                <option value="">Lokale</option>
                <?php
                $sql = "SELECT lokale FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY lokale)";
                $result = $mysql->query($sql);
                ?>
            </select>

            <select id="hylde_id">
                <option value="">Hylde</option>
                <?php
                $sql = "SELECT hylde FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY hylde)";
                $result = $mysql->query($sql);
                ?>
            </select>

            <select id="plads_id">
                <option value="">Plads</option>
                <?php
                $sql = "SELECT plads FROM `product_location` WHERE id IN (SELECT MIN(id) FROM product_location GROUP BY plads)";
                $result = $mysql->query($sql);
                ?>
            </select>
            <select id="flytbar_id">
                <option value="ja">ja</option>
                <option value="nej">nej</option>

            </select>
            <select id="antal_id">
                <option value="1">Antal</option>
            </select>
            <select id="leverandoer_id">
                <option value="1">Leverandør</option>
            </select>
        </div>
        <textarea id="description_id" placeholder="Description" rows="6" cols="30" ></textarea>
        <input type="button" value="shitstortmnm"  onclick="BtnAddProduct()">
    </form>
</div>
<?php
include "includes/footer.php";

?>

