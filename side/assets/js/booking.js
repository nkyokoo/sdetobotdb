
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
function ChangeLayers() {

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
function ChangeEnhed(id) {

    let product_id = "#item_" + id.toString();
    let productValue = $(product_id).val();//$('#'+product_id.).val();
    let enheds = "enhed_" + id.toString();

    //Ajax go to php site to get the Enheds of Chosen Productm
    if(productValue){
        $.ajax({
            type:'POST',
            url:'./includes/bookingdropdownlist.php',
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
function AddSelect(layer_id) {
    if (layer_id === 1){

        if (layer1SelectionCounter < layer1Limit){


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
        if (layer2SelectionCounter < layer2Limit){

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
function PopulateOptionForProductSelection(id) {
    $.ajax({
        type:'POST',
        url:'./includes/dropdownlistproducts_function.php',
        data:'item_id='+id,
        success:function(html){
            alert(html);
            $('#item_'+id).html(html);

            //$('#city').html('<option value="">Select state first</option>');
        }
    });
}
