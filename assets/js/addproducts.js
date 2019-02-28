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
                if (!parseInt($(arrayName[i]).val()) || i === 0) {
                    //check if the value is this or that
                    if(array[i] === "_Leverandorandet"){
                        //Input with more than one textbox require another way of doing things-
                        let container1 = $('#leverandoer_id_Leverandorandet').val();
                        let container2 = $('#leverandoer_id_andet_adress').val();
                        let container3 = $('#leverandoer_id_andet_phonenr').val();
                        array[i]= container1+","+container2+","+container3;
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
        //Check if it has any value
        if (array[0] && array[1] && array[2] && array[3] && array[4] && array[5].length > 3 && produkt_navn && antal && flytbar){
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
            let errorArray = array;
            let errorArrayName =["[Kategori]","[Virksomhed]","[Lokale]","[SVF]","[THP]","[Leverandoer]","[Produkt_navn]","[Antal]","[Flytbar]"];
            errorArray.push(produkt_navn,antal,flytbar);
            let errorMessage = "Something is wrong or in the wrong format on the following fields : \n";
            for (let i = 0; i<errorArray.length; i++){

                if (i === 5){
                    if (!$('#leverandoer_id_Leverandorandet').val() || !$('#leverandoer_id_andet_adress').val() || !$('#leverandoer_id_andet_phonenr').val()) {
                        errorMessage += errorArrayName[i]+" ";

                    }
                }
                else {
                    if (!errorArray[i]){

                        errorMessage += errorArrayName[i]+" ";

                    }
                }
            }
            alert(errorMessage);
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
