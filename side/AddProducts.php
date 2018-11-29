<?php


//include 'includes/connect.php';

include "includes/header.php";
include "includes/navbar.php";

$mysqli = new mysqli("localhost", "root", "root", "booking", 3307);




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
        let array = [kategori,virksomhed,lokale,hylde,plads,leverandoer];

        for (let i = 0; i<array.length;i++){
            if (array[i] === "andet"){
                switch (i) {
                    case 0:
                        array[i] = $(kategori_id_andet).val();
                        break;
                    case 1:
                        array[i] = $(virksomhed_id_andet).val();

                        break;
                    case 2:
                        array[i] = $(lokale_id_andet).val();

                        break;
                    case 3:
                        array[i] = $(hylde_id_andet).val();

                        break;
                    case 4:
                        array[i] = $(plads_id_andet).val();

                        break;
                    case 5:
                        array[i] = $(leverandoer_id_andet).val();

                        break;

                }
            }
        }
        $.ajax({
            type:'post',
            url:'includes/addproducttodatabase.php',
            data: {kategori: array[0],produkt_navn: produkt_navn,virksomhed: array[1],lokale: array[2],hylde: array[3],plads: array[4],antal: antal,description: description,flytbar:flytbar,leverandoer:array[5]},
            success:function (data) {
               // alert("You've succeed in creating a new product!");
                alert(data);
                alert("You've successfully inserted data into the database");
            }
        });




    }

    function AddNewInputOfAndet(CurrentEventId) {
                        let andetPlaceHolerName = CurrentEventId;
                        andetPlaceHolerName = andetPlaceHolerName.slice(0,-3);
                        let addHTML = "<input type='text' id='"+CurrentEventId+"_andet' placeholder='Ny "+andetPlaceHolerName+"'>";
                        let CurrentValue = document.getElementById(CurrentEventId).value ;

                        if (CurrentValue === "andet"){
                           let container = document.getElementById(CurrentEventId);
                           let createdElement = document.createElement('span');
                           createdElement.innerHTML = addHTML;
                           container.insertAdjacentElement("afterend", createdElement);
                        }else {
                            if ($("#"+CurrentEventId+"_andet")){
                                $("#"+CurrentEventId+"_andet").remove();
                            }
                        }
    }
</script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div>
    <form action="includes/addproducttodatabase.php" method="post">
        <div>
            <select id="kategori_id" onchange="AddNewInputOfAndet(this.id)">
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

            <input id="produkt_id" type="text"  placeholder="Produkt navn">

            <select id="virksomhed_id" onchange="AddNewInputOfAndet(this.id)">

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

            <select id="lokale_id" onchange="AddNewInputOfAndet(this.id)">
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

            <select id="hylde_id" onchange="AddNewInputOfAndet(this.id)">
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

            <select id="plads_id" onchange="AddNewInputOfAndet(this.id)">
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
            <select id="flytbar_id">
                <option value="">Flytbar</option>
                <option value="ja">ja</option>
                <option value="nej">nej</option>

            </select>
            <input id="antal_id" type="number" placeholder="Antal" min="0" max="999" >
            <select id="leverandoer_id" onchange="AddNewInputOfAndet(this.id)">
                <option value="1">Leverandør</option>
                <?php


                $sql = "SELECT id,leverandoer_name FROM booking.leverandoer";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        echo "<option value='".$row['id']."'>".$row['leverandoer_name']."</option>";
                    }
                    echo "<option value='andet'>Andet</option>";
                }
                ?>
            </select>
        </div>
        <textarea id="description_id" placeholder="Description" rows="6" cols="30" ></textarea>
        <input type="button" value="Tilføj"  onclick="BtnAddProduct()">
    </form>
</div>
<?php
include "includes/footer.php";
$mysqli->close();
?>

