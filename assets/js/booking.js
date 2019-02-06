
//Always running when DOM is ready
$(document).ready(function() {
    //Trigger instances if it contain this name.

    $('*[id*="btn-"]').click(function(){
        let variable = this.id;
        //slice the first 3 character
        let key = variable.slice(4);
        //add to function
        addToCart(key);
    });

});

var selectArray = ["0","0"];
let layerLimit =[10,20];
let layerSelectionCounter = [1,11];
function ChangeLayers() {
    try { // Switch between layers

        let getlayerTextByID = document.getElementById("layerText").innerHTML;
        let nextLayer = "1" === getlayerTextByID ? document.getElementById("layer_2").style.display = 'block' : document.getElementById("layer_1").style.display = 'block';
        let currentLayer = "1" === getlayerTextByID ? document.getElementById("layer_1").style.display = 'none' : document.getElementById("layer_2").style.display = 'none';
        document.getElementById("layerText").innerHTML = "1" === getlayerTextByID ? "2" : "1";

    } catch (e) {
    }
}
// Add product to cart via SESSION in a php file
function addToCart(productID) {
    try {
        //Get the input
        let product = document.getElementById( "product-unit-"+productID);
        //Get the Value of input
        let getChosenValueOfProduct = product.value;
        //
        if (getChosenValueOfProduct > 0) {
            $.ajax({
                type: 'POST',
                url: 'api/api_eventsforcarts.php',
                data: {PID: productID,quantity: getChosenValueOfProduct, submit:'submit'},
                success: function (output) {
                    alert(output);
                    let btn = document.getElementById('btn-' + productID);
                    btn.innerHTML = 'Added';
                    btn.disabled = true;
                    product.disabled = true;
                }
            })
        } else {
            alert("You've not chosen an Amount Yet");
        }
    } catch (e) {
    }

}

//Populate Options for Product Enheder/Devices.
/*
function ChangeEnhed(id) {

    try {
        let product_id = "#item_" + id.toString();
        let productValue = $(product_id).val();
        let enheds = "enhed_" + id.toString();
        let layerID = id < 10 ? 0 : 1;
        let selectionID = document.getElementById("item_"+id.toString());
        //Ajax go to php site to get the Enhed/items of Chosen Product
        if (productValue) {
            alert("selected value ="+selectionID.value);
            selectArray[layerID] += "," + selectionID.value;
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
        let checkIfProductIsSelected = document.getElementById("item_"+layerSelectionCounter[layer_id]);
        if (checkIfProductIsSelected.value > 0){
            if (layerSelectionCounter[layer_id] < layerLimit[layer_id]) {

                layerSelectionCounter[layer_id] += 1;

                //New Selection Box ready to add
                let select = "<select id='item_" +layerSelectionCounter[layer_id] + "' name='item_" +layerSelectionCounter[layer_id] + "' onchange='ChangeEnhed(" +layerSelectionCounter[layer_id] + ")'>" +
                    "        </select>" +
                    "        <select id='enhed_" +layerSelectionCounter[layer_id] + "' name='enhed_" +layerSelectionCounter[layer_id] + "'>" +
                    "            <option>Select an Item</option>" +
                    "        </select>";

                //I'm using Append instead of InnerHTML because InnerHTML remove the old data then add the new ones while Append just add the new data to old.
                alert(select);
                let e = document.createElement('div');
                //decide which layer the Selection boxes should reside.
                let div = layer_id === 0 ? document.getElementById('select_list_1'): document.getElementById('select_list_2');
                e.innerHTML = select;
                div.appendChild(e);

                PopulateOptionForProductSelection(layer_id,layerSelectionCounter[layer_id]);

            }
        }

    } catch (e) {
    }
}

//Populate Selection boxes with Options from DB
function PopulateOptionForProductSelection(layer_ID,item_ID) {
    try {
        // let layerID = id < 11 ? 1 : 2;
        alert("JAVASCRIPT selected = "+selectArray[layer_ID] +" and id = " + layer_ID);
        let productsInUse = selectArray[layer_ID];
        // AJAX Call to Backend/dropdownlistproducts_function.php.
        $.ajax({
            type: 'post',
            url: 'api/api_dropdownlistproducts_function.php',
            data: {selectedProducts: productsInUse},
            success: function (html) {
                alert(html);
                $('#item_' + item_ID).html(html);

            }
        });
    } catch (e) {
    }
}
*/