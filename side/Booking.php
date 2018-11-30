

<?php

include ('includes/session.php');
include 'includes/connect.php';
include "includes/header.php";
include "includes/navbar.php";
include "includes/footer.php";



?>

<script>

    let ChangeLayers = () => {

        // Switch between layers
        if($('#layer_1').css('display') === 'block')
        {

            document.getElementById("layer_2").style.display = "block";
            document.getElementById("layer_1").style.display = "none";


        }
        else {

            document.getElementById("layer_1").style.display = "block";
            document.getElementById("layer_2").style.display = "none";

        }
    }

    //Populate Options for Product Enheder/Devices.
    let ChangeEnhed = (id) => {

        let product_id = "#item_" + id.toString();
        let productValue = $(product_id).val();//$('#'+product_id.).val();
        let enheds = "enhed_" + id.toString();

        //Ajax go to php site to get the Enheds of Chosen Product
        if(productValue){
            $.ajax({
                type:'POST',
                url:'./includes/BookingDropDownList.php',
                data:'item_id='+productValue,
                success:function(html){
                    $('#'+enheds).html(html);
                    //$('#city').html('<option value="">Select state first</option>');
                }
            });
        }else{
            $('#'+enheds).html('<option value="">Select an Item</option>');
            //$('#city').html('<option value="">Select state first</option>');
        }

    }
    //Global variables doesn't reset data after each use. Global only resets when you refresh DOM.
    let layer1Limit = 10;
    let layer1SelectionCounter = 1;

    let layer2Limit = 20;
    let layer2SelectionCounter = 11;

    //Add Selection boxes
    let AddSelect = (layer_id) => {
        if (layer_id === 1){

            if (layer1SelectionCounter <= layer1Limit){


                layer1SelectionCounter += 1;

                //New Selection Box ready to add
                let select = "<select id='item_"+layer1SelectionCounter+"' name='item_"+layer1SelectionCounter+"' onchange='ChangeEnhed("+layer1SelectionCounter+")'>" +
                    "        </select>" +
                    "        <select id='enhed_"+layer1SelectionCounter+"' name='enhed_"+layer1SelectionCounter+"'>"+
                    "            <option>Select an Item</option>" +
                    "        </select>";

                //I'm using Append instead of InnerHTML because InnerHTML remove the old data then add the new ones while Append just add the new data to old.
                let e = document.createElement('div');
                let div = document.getElementById('select_list_1');
                e.innerHTML = select;
                div.appendChild(e);

                PopulateOptionForProductSelection(layer1SelectionCounter);


            }

        }else {
            if (layer2SelectionCounter <= layer2Limit){

                layer2SelectionCounter += 1;
                let select = "<select id='item_"+layer2SelectionCounter+"' name='item_"+layer2SelectionCounter+"' onchange='ChangeEnhed("+layer2SelectionCounter+")'>" +
                    "        </select>" +
                    "        <select id='enhed_"+layer2SelectionCounter+"' name='enhed_"+layer2SelectionCounter+"'>"+
                    "            <option>Select an Item</option>" +
                    "        </select>";
                let e = document.createElement('div');
                let div = document.getElementById('select_list_2');
                e.innerHTML = select;
                div.appendChild(e);

                PopulateOptionForProductSelection(layer2SelectionCounter);            }
        }
    }

    //Populate Options for Product selections
    let PopulateOptionForProductSelection = (id) => {
        $.ajax({
            type:'POST',
            url:'./includes/DropdownListProducts_Function.php',
            data:'item_id='+id,
            success:function(html){
                alert(html);
                $('#item_'+id).html(html);

                //$('#city').html('<option value="">Select state first</option>');
            }
        });
    }
</script>
<button onclick="ChangeLayers()">Change Layer</button>
<form action="./includes/BookingSend.php" method="post">
    <div id="layer_1" class="layer1" >
        <span id="increment_1" style="display: none">1</span>

        <p>Layer 1</p>
        <div id="select_list_1">
            <div>
                <select id="item_1" name="item_1" onchange="ChangeEnhed(1)">
                    <?php
                    include ('includes/DropdownListProducts_Function.php');
                    ?>
                </select>
                <select id="enhed_1" name="enhed_1">
                    <option>Select an Item</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="AddSelect(1);">Add new</button>

    </div>

    <!-- ################################################################################################################ -->

    <div id="layer_2" class="layer2" >
        <data id="increment_2" value="11"></data>

        <p>Layer 2</p>
        <div id="select_list_2">
            <div>
                <select id="item_11" name="item_11" onchange="ChangeEnhed(11)">
                    <?php
                    include ('includes/DropdownListProducts_Function.php');
                    ?>
                </select>
                <select id="enhed_11" name="enhed_11">
                    <option>Select an Item</option>
                </select>
            </div>
        </div>
        <button type="button" onclick="AddSelect(2)">+</button>

    </div>


    <input type="submit" value="Book">
</form>

