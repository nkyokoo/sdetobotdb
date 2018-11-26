<?php


include 'includes/connect.php';

include "includes/header.php";
include "includes/navbar.php";
include "includes/footer.php";

?>
<script>
    function BtnAddProduct() {

        let kategori_id = document.getElementById(kategori_id).val();
        let produkt_navn = document.getElementById(produkt_navn);
        let virksomhed_id = document.getElementById(virksomhed_id).val();
        let lokale_id = document.getElementById(lokale_id).val();
        let hylde_id = document.getElementById(hylde_id).val();
        let plads_id = document.getElementById(plads_id).val();
        let antal_id = document.getElementById(antal_id).val();
        let description_id = document.getElementById(description_id).val();

      /*  $.ajax({
            type:'post',
            url:'includes/AddProductToDatabase.php',
            data: 'produkt_navn='+produkt_navn,
            success:function (data) {
               // alert("You've succeed in creating a new product!");
                alert(data);
                alert("sht");
            }
        });*/

        $.post( "includes/AddProductToDatabase.php", {
            name: "John",
            time: "2pm"
        } );


    }
</script>

<!-- #############################-------- SCRIPT -------############################################ -->

<div>
    <form>
        <div>
            <select id="kategori_id">
                <option value="">Kategori</option>
            </select>

            <input id="produkt_navn" type="text" placeholder="Produkt navn">

            <select id="virksomhed_id">
                <option value="">Virksomhed</option>
            </select>

            <select id="lokale_id">
                <option value="">Lokale</option>
            </select>

            <select id="hylde_id">
                <option value="">Hylde</option>
            </select>

            <select id="plads_id">
                <option value="">Plads</option>
            </select>

            <select id="antal_id">
                <option value="">Antal</option>
            </select>
        </div>
        <textarea id="description_id" placeholder="Description" rows="6" cols="30" ></textarea>
        <input type="button" value="Tilføj" onclick="BtnAddProduct()">
    </form>
</div>


