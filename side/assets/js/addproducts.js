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