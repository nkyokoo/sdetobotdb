$(document).ready(function () {
        setInterval(function () {
            $.ajax({
                type: 'get',
                url: '../backend_instantiate/int_cartevent.php',
                success: function (data) {
                    $("#cartItemCount").html(data)
                },
                error: function (request, status, error) {

                    console.log(error)


                },

            });
        },1000)



});