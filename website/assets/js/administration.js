function getCount() {


    $.ajax({
        type: 'get',
        url: '../backend_instantiate/int_dashboard.php',
        data: {getItem: 'dashboard'},
        success: function (data) {
            let jsondata = JSON.parse(data)
            let productinfo = $('#productinfo')
            productinfo.append(`<a  class="list-group-item"><span class="label label-default label-pill">Antal produkter: ${jsondata.total_products.product_count}</span></a>`)
            productinfo.append(`<a  class="list-group-item"><span class="label label-default label-pill">Antal produkt enheder: ${jsondata.total_product_units.unit_count}</span></a>`)
            let product_requests = $('#product_requests')
            product_requests.append(`<a  class="list-group-item"><span class="label label-default label-pill">Antal anmodninger: ${jsondata.total_requests.request_count}</span></a>`)
            product_requests.append(`<a  class="list-group-item"><span class="label label-default label-pill">Nuværende aktive ønskelister: ${jsondata.total_requests.request_activeCount}</span></a>`)

            let total_users = $('#userinfo')
            total_users.append(`<a  class="list-group-item"><span class="label label-default label-pill">Antal brugere: ${jsondata.total_users.user_count}</span></a>`)
        },
        error: function (request, status, error) {

            console.log(error)


        },

    });

}

const usercontrol = (id,action) => {
    if (action === 'disable') {
        try {

            $.ajax({
                type: 'post',
                url: '../backend_instantiate/int_disable_user.php',
                data: {userid: id},
                success: function (data) {
                    let options = {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            window.location.reload();
                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },
                error: function (request, status, error) {
                    let options = {
                        content: request.responseText, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            window.location.reload()

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },

            });
        } catch (e) {
            let options = {
                content: e.errorCode, // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {
                    window.location.reload()


                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }

    } else if (action === 'enable'){

        try {

            $.ajax({
                type: 'post',
                url: '../backend_instantiate/int_enable_user.php',
                data: {userid: id},
                success: function (data) {
                    let options = {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            window.location.reload()
                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },
                error: function (request, status, error) {
                    let options = {
                        content: request.responseText, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            window.location.reload()

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },

            });
        } catch (e) {
            let options = {
                content: e.errorCode, // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {


                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);


        }
    }
}


const btnCreateUser = () => {
    let rank = document.getElementById('user_type')

    try {

        let name = $("#createUserName").val();
        let email = $("#createUserEmail").val();
        let user_type = rank.options[rank.selectedIndex].value;
        let password1 = $("#password_1").val();
        let password2 = $("#password_2").val();
        let array = [name, email, user_type, password1, password2];
        let arrayName = ["#createUserName", "#createUserEmail", "#user_type", "#password_1", "#password_2"];
        //Looping the array to check for condition.
        //Check if it has any value


        if (array[0] && array[1] && array[2] && array[3] && array[4]) {
            $.ajax({
                type: 'post',
                url: '../backend_instantiate/int_user.php',
                data: {name: array[0], email: array[1], user_type: array[2], password1: array[3], password2: array[4]},
                success: function (data) {
                    $('#createUser_btn').attr("disabled", true);
                    let options = {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            // $('#product_registration_form')[0].reset();
                            window.location.replace("users.php")
                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },
                error: function (request, status, error) {
                    let options = {
                        content: request.responseText, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },

            });
        } else {

            let options = {
                content: "you are missing something in your form, please check it again.", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {
                }


                // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }
    } catch (e) {
        let options = {
            content: e.errorCode, // text of the snackbar
            style: "toast", // add a custom class to your snackbar
            timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
            htmlAllowed: true, // allows HTML as content value
            onClose: function () {


            } // callback called when the snackbar gets closed.
        }
        $.snackbar(options);
    }

}

function isInArray(date, dates) {
    for (let idx = 0, length = dates.length; idx < length; idx++) {
        let d = dates[idx];
        if (date.getFullYear() == d.getFullYear() &&
            date.getMonth() == d.getMonth() &&
            date.getDate() == d.getDate()) {
            return true;
        }
    }

    return false;
}

let produktGridOptions;
let unitGridOptions;
let userGridOptions;

$(function () {
    //letiable of the scheduler for function scheduler.select(null);    line: 81


    $('#material-tabs').each(function () {

        let $active, $content, $links = $(this).find('a');

        $active = $($links[0]);
        $active.addClass('active');

        $content = $($active[0].hash);

        $links.not($active).each(function () {
            $(this.hash).hide();
        });

        $(this).on('click', 'a', function (e) {

            $active.removeClass('active');
            $content.hide();

            $active = $(this);
            $content = $(this.hash);

            $active.addClass('active');
            $content.show();

            e.preventDefault();
        });
    });

    $('#createUser_btn').click(function () {
        btnCreateUser();
    });
    $('#product-search-btn').on('click', function () {
        let searchVal = $('#product-search').val()
        console.log(searchVal)
        if (searchVal !== "") {
            agGrid.simpleHttpRequest({url: `../backend_instantiate/int_search.php?q=${searchVal}&type=product`}).then(function (data) {
                produktGridOptions.api.setRowData(data);
            });

        }


    })
    $('#tab2-tab').on('click', function () {
        unitGridOptions.api.sizeColumnsToFit();

    })

    if ($('#productinfo').length !== 0) {
        getCount()
    }


    if ($('#productgrid').length !== 0) {
        createProductsDataGrid()
        createUnitsDataGrid()

    }
    if ($('#usergrid').length !== 0) {
        createUserDataGrid()

    }


});

let createProductsDataGrid = () => {
    let columnDefs = [
        {headerName: "Product navn", field: "product_name", filter: true, sortable: true,},
        {headerName: "Kategori", field: "category_name", filter: true, sortable: true,},
        {headerName: "Flytbar", field: "movable", filter: true, sortable: true},
        {headerName: "Virksomhed", field: "school_name", filter: true, sortable: true},
        {headerName: "Leverandør", field: "name", filter: true, sortable: true},
        {headerName: "Beskrivelse", field: "description", filter: true, sortable: true},
        {headerName: "Oprettet af", field: "created_by", filter: true, sortable: true},

    ];

    // specify the data


    // let the grid know which columns and what data to use
    produktGridOptions = {
        columnDefs: columnDefs,
    };

    // lookup the container we want the Grid to use
    let eGridDiv = document.querySelector('#productgrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, produktGridOptions);
    agGrid.simpleHttpRequest({url: '../backend_instantiate/int_getproducts.php',}).then(function (data) {
        produktGridOptions.api.setRowData(data);
    });

    produktGridOptions.api.sizeColumnsToFit();


}
let createUnitsDataGrid = () => {
    let columnDefs = [
        {headerName: "Product navn", field: "product_name", filter: true, sortable: true,},
        {headerName: "Enhed nummer", field: "unit_number", filter: true, sortable: true,},
        {headerName: "svf type", field: "svf_type", filter: true, sortable: true},
        {headerName: "svf nummer", field: "svf_number", filter: true, sortable: true},
        {headerName: "thp type", field: "thp_type", filter: true, sortable: true},
        {headerName: "thp nummer", field: "thp_number", filter: true, sortable: true},
        {headerName: "Rum/Lokale", field: "room", filter: true, sortable: true},
        {headerName: "Tilgængelighed", field: "status_name", filter: true, sortable: true}
    ];

    // specify the data


    // let the grid know which columns and what data to use
    unitGridOptions = {
        columnDefs: columnDefs,
    };

    // lookup the container we want the Grid to use
    let eGridDiv = document.querySelector('#unitgrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, unitGridOptions);

    agGrid.simpleHttpRequest({url: '../backend_instantiate/int_getunits.php'}).then(function (data) {
        unitGridOptions.api.setRowData(data);
    });


}

let createUserDataGrid = () => {
    function disableEditor() {

    }
    function DisabledRenderer() {}

// init method gets the details of the cell to be rendere
    DisabledRenderer.prototype.init = function(params) {
        console.log(params)
        this.eGui = document.createElement('select');
        this.eGui.setAttribute('class', 'form-control')
        this.eGui.setAttribute('onchange',`usercontrol('${params.data.id}', '${params.value === 'ja' ? 'enable' : 'disable'}')`)
        let option = document.createElement('option')
        option.setAttribute('value',params.value === 'ja' ? '1':'0');
        option.innerHTML = params.value === 'ja' ? 'ja':'nej'
        let option2 = document.createElement('option')
        option2.setAttribute('value',params.value !== 'ja' ? '1':'0');
        option2.innerHTML = params.value !== 'ja' ? 'ja':'nej'

        console.log(option, option2)
        this.eGui.appendChild(option)
        this.eGui.appendChild(option2)


    };

    DisabledRenderer.prototype.getGui = function() {
        return this.eGui;
    };
    let columnDefs = [
        {headerName: "Navn", field: "name", filter: true, sortable: true,},
        {headerName: "Email", field: "email", filter: true, sortable: true,},
        {headerName: "Rank", field: "user_rank", filter: true, sortable: true},
        {
            headerName: "Deaktiveret",
            field: "disabled",
            filter: true,
            sortable: true,
            cellRenderer: 'DisabledRenderer',
        },


    ];


    // let the grid know which columns and what data to use
    userGridOptions = {
        columnDefs: columnDefs,
        components: {
            'DisabledRenderer': DisabledRenderer,
        },
    };


    // lookup the container we want the Grid to use
    let eGridDiv = document.querySelector('#usergrid');

    // create the grid passing in the div to use together with the columns & data we want to use
    new agGrid.Grid(eGridDiv, userGridOptions);

    agGrid.simpleHttpRequest({url: '../backend_instantiate/int_get_users.php'}).then(function (data) {
        userGridOptions.api.setRowData(data);
    });

    userGridOptions.api.sizeColumnsToFit();

}