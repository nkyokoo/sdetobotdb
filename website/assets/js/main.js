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
    }, 1000)

    $('#sideBar').hover(function () {
        $(this).animate({width: '10rem'}, 100, function () {
            $("#sidebarcontent").css({'display': 'block'})

        });
    }, function () {
        $(this).animate({width: '1rem'}, 100, function () {
            $("#sidebarcontent").css({'display': 'none'})

        });

    }).trigger('mouseleave');




    $('#cancel_changes').on('click', function () {

        window.location.reload()
    })
    $('#accept_changes').on('click', function () {
        const newname = $('#username_profile').val();
        console.log(newname);
        if (newname !== "") {
            $.ajax({
                type: 'POST',
                url: '../backend_instantiate/int_user_changename.php',
                data: {name: newname},
                success: function (output) {
                        let options =  {
                        content: "Din navn er ændret, du skal logge ind igen før at ændringerne bliver vist.", // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){
                            window.location.reload();

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);
                },
                error: function (output) {
                    let options =  {
                        content: output.responseText, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){


                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);
                }
            })
        }
        else
        {
            let options =  {
                content: "Adgangskoderne er ikke ens", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function(){


                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }

    })


    $("#callPhplogout").click(function () {
        $.ajax({
            type: "POST",
            data: {
                logout: '1',
            },
            url: "../authenticator.php",
            success: function (output) {
                alert(output);
                if (output == 'done') {
                    window.location = '../index.php';
                }
            }
        })
    })
    $("#unlock_edit_password").on('click', function () {
                let $this = $('#username_profile');
                let input = $('<input />', {
                    'type': 'text',
                    'id':'username_profile',
                    'class': 'form-control',
                    'value': $this.text()
                });
                $this.replaceWith(input);
                $('#cancel_changes').show()
                $('#accept_changes').show()
                $(this).hide();


        }
    )
    $('#change_password').on('click', function (e) {
       const confirmpassword = $('#password_3').val()
       const newpassword = $('#password_2').val()
        const currentpassword = $('#password_1').val()
        if (newpassword === confirmpassword ) {
            $.ajax({
                type: 'POST',
                url: '../backend_instantiate/int_user_changepassword.php',
                data: {currentpassword: currentpassword, newpassword: newpassword},
                success: function (output) {
                        let options =  {
                            content: output.responseText, // text of the snackbar
                            style: "toast", // add a custom class to your snackbar
                            timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                            htmlAllowed: true, // allows HTML as content value
                            onClose: function(){
                                if (!edit_settings.enabled) {
                                    $("#password_1").prop("disabled", false);
                                    $("#password_2").prop("disabled", false);
                                    $("#password_3").prop("disabled", false);
                                    $("#change_password").prop("disabled", false);
                                    edit_settings.enabled = true;
                                } else {
                                    $("#password_1").prop("disabled", true);
                                    $("#password_2").prop("disabled", true);
                                    $("#password_3").prop("disabled", true);
                                    $("#change_password").prop("disabled", true);
                                    edit_settings.enabled = false;
                                }
                            } // callback called when the snackbar gets closed.
                        }
                    $.snackbar(options);
                },
                error: function (output) {
                    let options =  {
                        content: output.responseText, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function(){


                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);
                }
            })
        }
        else
            {
            let options =  {
                content: "Adgangskoderne er ikke ens", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function(){


                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        }
    })

});
let sendMail = () => {
    let content = document.getElementById('Message-input')
    let category = document.getElementById('categoryList')
    let title = document.getElementById('messageTitle')

    if (title.value !== "" && content.value !== "" && category.value !== "") {
        $.post("api/sendEmail.php", {
            title: category.options[category.selectedIndex].value + "-" + title.value,
            content: content.value,

        }, (data) => {
            alert(data)
        })
    } else {
        alert("error")


    }

}
