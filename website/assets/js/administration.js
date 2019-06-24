
$(function() {

    $('ul.tabs li').click(function(){
        let tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })
    $('#createUser_btn').click(function(){
        btnCreateUser();
    });



});
function btnCreateUser() {
    let rank = document.getElementById('user_type')

    try {

        let name = $("#createUserName").val();
        let email = $("#createUserEmail").val();
        let user_type = rank.options[rank.selectedIndex].value;
        let password1 = $("#password_1").val();
        let password2 = $("#password_2").val();
        let array = [name,email,user_type,password1,password2];
        let arrayName = ["#createUserName","#createUserEmail","#user_type","#password_1","#password_2"];
        //Looping the array to check for condition.
        //Check if it has any value


        if (array[0] && array[1] && array[2] && array[3] && array[4]){
                $.ajax({
                type:'post',
                url:'../backend_instantiate/int_user.php',
                data: {name: array[0],email: array[1],user_type: array[2],password1: array[3],password2: array[4]},
                success:function (data) {
                    $('#createUser_btn').attr("disabled", true);
                    let options =  {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){
                            //$('#product_registration_form')[0].reset();
                            //window.location.replace("users.php")
                        } // callback called when the snackbar gets closed.
                    }
                   $.snackbar(options);



                },
                    error: function (request, status, error) {
                    let options =  {
                        content: request, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){

                        } // callback called when the snackbar gets closed.
                    }
                        $.snackbar(options);



                    },

            });
        } else {

            let options =  {
                content: "you are missing something in your form, please check it again.", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function(){ }


                // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }
    } catch (e) {
        let options =  {
            content: e.errorCode, // text of the snackbar
            style: "toast", // add a custom class to your snackbar
            timeout: 5000, // time in milliseconds after the snackbar autohides, 0 is disabled
            htmlAllowed: true, // allows HTML as content value
            onClose: function(){


            } // callback called when the snackbar gets closed.
        }
        $.snackbar(options);
    }

}