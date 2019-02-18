$(document).ready(function () {
    //When you leave site, return a Confirmation message
    //The message is decided by Browser by Default can be changed.
    window.onbeforeunload = function() {
        return "";
    };
    $('#button').click(function(){
            btnAddProductToDB();
        });


});
//Send AddProducts.php data to php.
function btnAddProductToDB() {myBlock:{
    try {

        //get the values inserted from addproducts.php and send it to backend
        let kategori = $(kategori_id).val();
        let produkt_navn = $(produkt_id).val();
        let virksomhed = $(virksomhed_id).val();
        let lokale = $(lokale_id).val();
        let svf = $(svf_id).val();
        let thp = $(thp_id).val();
        let antal = $(antal_id).val();
       let description = $(description_id).val();
       let flytbar = $(flytbar_id).val();
        let leverandoer = $(leverandoer_id).val();
        //get the values of all Selection boxes into an array
        let array = [kategori,virksomhed,lokale,svf,thp,leverandoer];
        //Easy way to check large data and conditions with array
        let arrayName = ["#kategori_id_andet","#virksomhed_id_Virksomhedandet","#lokale_id_andet","#svf_id_andet","#thp_id_andet","#leverandoer_id_Leverandorandet"];
        //Looping the array to check for condition.
        for (let i = 0; i < array.length; i++) {
            //Check if there's a "_andet" chosen
            if (array[i] === "andet" || array[i] === "_Leverandorandet" || array[i] === "_Virksomhedandet") {
                //check if the value in andet is a int, if it isn't continue
                if (!parseInt($(arrayName[i]).val())) {
                    //check if the value is this or that
                    if(array[i] === "_Leverandorandet"){
                        //Input with more than one textbox require another way of doing things-
                        let container1 = $('#leverandoer_id_Leverandorandet').val();
                        let container2 = $('#leverandoer_id_andet_adress').val();
                        let container3 = $('#leverandoer_id_andet_phonenr').val();
                        array[i]= container1+","+container2+","+container3;
                    }
                    else if (array[i] === "_Virksomhedandet") {
                       let con1 = $('#virksomhed_id_Virksomhedandet').val();
                       let con2 = $('#virksomhed_id_andet_short').val();
                       let con3 = $('#virksomhed_id_andet_city').val();
                       let con4 = $('#virksomhed_id_andet_post').val();
                       let con5 = $('#virksomhed_id_andet_address').val();
                        array[i] = con1 +","+con2+","+con3+","+con4+","+con5;
                    }
                    else {

                        array[i] = $(arrayName[i]).val().toUpperCase();
                    }

                }
                else {
                    alert("You Cannot type numbers in : "+ arrayName[i]);
                    break myBlock;
                }

            }
        }

        if (array[0].length > 0 && array[1].length > 0 && array[2].length > 0 && array[3].length > 0 && array[4].length > 0 && array[5].length > 0 && produkt_navn && antal && flytbar){

            $.ajax({
                type:'post',
                url:'api/api_addproductstodb.php',
                data: {kategori: array[0],produkt_navn: produkt_navn,virksomhed: array[1],lokale: array[2],SVF: array[3],THP: array[4],antal: antal,description: description,flytbar:flytbar,leverandoer:array[5]},
                success:function (data) {
                    // alert("You've succeed in creating a new product!");
                    alert("Your Request Has Been Sent To The System");
                    location.reload();
                }
            });
        } else {
            alert("Something Is Empty Or In The Wrong Format \nPlease Recheck The Fields");
        }
    } catch (e) {
        alert(e.errorCode);
    }

}}

//If you chose selection with ANDET add textbox or remove it.
function addNewInputOfAndet(CurrentEventId) {

    try {
        if (CurrentEventId === "leverandoer_id") {
            let andetPlaceHolderName = CurrentEventId;
            //slice the last 3 index
            andetPlaceHolderName = andetPlaceHolderName.slice(0, -3);
            let addHTML = "<input type='text' id='" + CurrentEventId + "_Leverandorandet' placeholder='Ny " + andetPlaceHolderName + "'><input type='text' id='" + CurrentEventId + "_andet_adress' placeholder='Ny adresse'><input type='text' id='" + CurrentEventId + "_andet_phonenr' placeholder='Ny telefon nr'>";
            let CurrentValue = document.getElementById(CurrentEventId).value;
            if (CurrentValue === "_Leverandorandet") {
                let container = document.getElementById(CurrentEventId);
                let createdElement = document.createElement('span');
                createdElement.innerHTML = addHTML;
                container.insertAdjacentElement("afterend", createdElement);
            } else {
                $("#" + CurrentEventId + "_Leverandorandet").remove();
                $("#" + CurrentEventId + "_andet_adress").remove();
                $("#" + CurrentEventId + "_andet_phonenr").remove();


            }
        }
        else if (CurrentEventId === "virksomhed_id"){
            let andetPlaceHolderName = CurrentEventId;
            andetPlaceHolderName = andetPlaceHolderName.slice(0, -3);
            let addHTML = "<input type='text' id='" + CurrentEventId + "_Virksomhedandet' placeholder='Ny " + andetPlaceHolderName + "'><input type='text' id='" + CurrentEventId + "_andet_short' placeholder='Virksomhed forkortelse'><input type='text' id='" + CurrentEventId + "_andet_city' placeholder='Bynavn'><input type='text' id='" + CurrentEventId + "_andet_post' placeholder='Ny Post nummer'><input type='text' id='"+ CurrentEventId +"_andet_address' placeholder='Ny addresse'>";
            let CurrentValue = document.getElementById(CurrentEventId).value;
            if (CurrentValue === "_Virksomhedandet") {
                let container = document.getElementById(CurrentEventId);
                let createdElement = document.createElement('span');
                createdElement.innerHTML = addHTML;
                container.insertAdjacentElement("afterend", createdElement);
            } else {
                $("#" + CurrentEventId + "_Virksomhedandet").remove();
                $("#" + CurrentEventId + "_andet_short").remove();
                $("#" + CurrentEventId + "_andet_city").remove();
                $("#" + CurrentEventId + "_andet_post").remove();
                $("#" + CurrentEventId + "_andet_address").remove();



            }
        }
        else {
            let andetPlaceHolderName = CurrentEventId;
            andetPlaceHolderName = andetPlaceHolderName.slice(0, -3);
            let addHTML = "<input type='text' id='" + CurrentEventId + "_andet' placeholder='Ny " + andetPlaceHolderName + "'>";
            let CurrentValue = document.getElementById(CurrentEventId).value;
            if (CurrentValue === "andet") {
                let container = document.getElementById(CurrentEventId);
                let createdElement = document.createElement('span');
                createdElement.innerHTML = addHTML;
                container.insertAdjacentElement("afterend", createdElement);
            } else {

                $("#" + CurrentEventId + "_andet").remove();

            }
        }
    } catch (e) {
    }
}

