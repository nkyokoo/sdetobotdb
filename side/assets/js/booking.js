
/*
//Prototype of ChangeEnhed
$(document).ready(function ChangeEnhed(){
  $(document.getElementsByName("item_1")).on('change',function(){

        let productValue = $(this).val();
        if(productValue){
            $.ajax({
                type:'POST',
                url:'includes/BookingDropDownList.php',
                data:'item_id='+productValue,
                success:function(html){
                    $('#enhed_2').html(html);
                    //$('#city').html('<option value="">Select state first</option>');
                }
            });
        }else{
            $('#enhed_2').html('<option value="">Select an Item</option>');
            //$('#city').html('<option value="">Select state first</option>');
        }

});
});*/

//Global variables doesn't reset data after each use. Global only resets when you refresh DOM.
//let layer1Limit = 10;
//letlayerSelectionCounter[layer_id-1] = 1;

//let layer2Limit = 20;
//let layerSelectionCounter[layer_id-1] = 11;

//used to remove existing product from next selection Try to use it on both layers.
let selectArray = ["0","0"];
let layerLimit =[10,20];
let layerSelectionCounter = [1,11];
function ChangeLayers() {

    try { // Switch between layers
        if ($('#layer_1').css('display') === 'block') {

            document.getElementById("layer_2").style.display = 'block';
            document.getElementById("layer_1").style.display = 'none';


        } else {

            document.getElementById("layer_1").style.display = 'block';
            document.getElementById("layer_2").style.display = 'none';

        }
    } catch (e) {
    }
}

//Populate Options for Product Enheder/Devices.
function ChangeEnhed(id) {

    try {
        let product_id = "#item_" + id.toString();
        let productValue = $(product_id).val();
        let enheds = "enhed_" + id.toString();
        let layerID = id < 11 ? 1 : 2;
        alert("layer id is ="+layerID);
        let selectionID = document.getElementById("item_"+id.toString());
        //Ajax go to php site to get the Enheds of Chosen Productm
        if (productValue) {
            selectArray[layerID-1] += "," + selectionID.value;

            $.ajax({
                type: 'POST',
                url: 'api/api_bookingdropdownlist.php',
                data: 'item_id=' + productValue,
                success: function (html) {
                    $('#' + enheds).html(html);
                }
            });
        } else {
            $('#' + enheds).html('<option value="">Select an Item</option>');
        }
    } catch (e) {
    }

}

//Add Selection boxes
function AddSelect(layer_id) {
    try {
        if (layer_id === 1) {

            if (layerSelectionCounter[layer_id-1] < layerLimit[layer_id-1]) {

                layerSelectionCounter[layer_id-1] += 1;

                //New Selection Box ready to add
                let select = "<select id='item_" +layerSelectionCounter[layer_id-1] + "' name='item_" +layerSelectionCounter[layer_id-1] + "' onchange='ChangeEnhed(" +layerSelectionCounter[layer_id-1] + ")'>" +
                    "        </select>" +
                    "        <select id='enhed_" +layerSelectionCounter[layer_id-1] + "' name='enhed_" +layerSelectionCounter[layer_id-1] + "'>" +
                    "            <option>Select an Item</option>" +
                    "        </select>";

                //I'm using Append instead of InnerHTML because InnerHTML remove the old data then add the new ones while Append just add the new data to old.
                let e = document.createElement('div');
                let div = document.getElementById('select_list_1');
                e.innerHTML = select;
                div.appendChild(e);

                PopulateOptionForProductSelection(layerSelectionCounter[layer_id-1]);


            }

        } else {
            if (layerSelectionCounter[layer_id-1] < layerLimit[layer_id-1]) {

                layerSelectionCounter[layer_id-1] += 1;

                //New Selection Box ready to add
                let select = "<select id='item_" +layerSelectionCounter[layer_id-1] + "' name='item_" +layerSelectionCounter[layer_id-1] + "' onchange='ChangeEnhed(" +layerSelectionCounter[layer_id-1] + ")'>" +
                    "        </select>" +
                    "        <select id='enhed_" +layerSelectionCounter[layer_id-1] + "' name='enhed_" +layerSelectionCounter[layer_id-1] + "'>" +
                    "            <option>Select an Item</option>" +
                    "        </select>";

                //I'm using Append instead of InnerHTML because InnerHTML remove the old data then add the new ones while Append just add the new data to old.
                let e = document.createElement('div');
                let div = document.getElementById('select_list_2');
                e.innerHTML = select;
                div.appendChild(e);

                PopulateOptionForProductSelection(layerSelectionCounter[layer_id-1]);
            }
        }
    } catch (e) {
    }
}

//Populate Options for Product selections
function PopulateOptionForProductSelection(id) {
    try {
        let layerID = id < 11 ? 1 : 2;

        $.ajax({
            type: 'post',
            url: '../backend/dropdownlistproducts_function.php',
            data: {selectedProducts: selectArray,layer_id: layerID-1},
            success: function (html) {
                alert(html);
                $('#item_' + id).html(html);

            }
        });
    } catch (e) {
    }
}
