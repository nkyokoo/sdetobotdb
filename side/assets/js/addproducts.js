
//Send AddProducts.php data to php.
function btnAddProduct() {myBlock:{
    try {
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
        let arrayName = ["#kategori_id_andet","#virksomhed_id_andet","#lokale_id_andet","#hylde_id_andet","#plads_id_andet","#leverandoer_id_Leverandorandet"];

        for (let i = 0; i < array.length; i++) {
            if (array[i] === "andet" || array[i] === "_Leverandorandet") {
                if (!parseInt($(arrayName[i]).val())) {
                    if(array[i] === "_Leverandorandet"){
                        let container1 = $(arrayName[i]).val();
                        let container2 = $('#leverandoer_id_andet_adress').val();
                        let container3 = $('#leverandoer_id_andet_phonenr').val();
                        array[i]= container1+","+container2+","+container3;
                    }
                    else {

                        array[i] = $(arrayName[i]).val();
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
                data: {kategori: array[0],produkt_navn: produkt_navn,virksomhed: array[1],lokale: array[2],hylde: array[3],plads: array[4],antal: antal,description: description,flytbar:flytbar,leverandoer:array[5]},
                success:function (data) {
                    // alert("You've succeed in creating a new product!");
                    alert(data);

                }
            });
        } else {
            alert("something is empty");
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
        } else {
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

