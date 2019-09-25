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


    $("#callPhplogout").click(function () {
        $.ajax({
            type: "POST",
            url: "../backend_instantiate/int_logout.php",
            success: function (output) {
                    window.location = '../index.php';

            }
        })
    })

    $("#login-button").click(() => login())
    $("#register_btn").click(() => register())

    $('#change_password').on('click', function (e) {
        const confirmpassword = $('#repeat-password').val()
        const newpassword = $('#new-password').val()
        const currentpassword = $('#current-password').val()
        if (newpassword !== confirmpassword) {
            let options = {
                content: "Adgangskoderne er ikke ens", // text of the snackbar
                style: "toast", // add a custom class to your snackbar
                timeout: 1000, // time in milliseconds after the snackbar autohides, 0 is disabled
                htmlAllowed: true, // allows HTML as content value
                onClose: function () {


                } // callback called when the snackbar gets closed.
            }
            $.snackbar(options);
        } else {
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
const register = () => {
    try {
        let name = $("#registerName").val();
        let email = $("#registerEmail").val();
        let password = $("#registerPassword").val();
        let array = [name,email, password];
        let arrayName = ["#registerName","#registerEmail", "#new-password",];
        //Looping the array to check for condition.
        //Check if it has any value


        if (array[0] && array[1]) {
            $.ajax({
                type: 'post',
                url: '../backend_instantiate/int_register.php',
                data: {name:array[0],email: array[1], password: array[2]},
                success: function (data) {
                    $('#createUser_btn').attr("disabled", true);
                    let options = {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 500, // time in milliseconds after the snackbar autohides, 0 is disabled
                        htmlAllowed: true, // allows HTML as content value
                        onClose: function () {
                            //window.location.replace("./login")
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
                content: "you are missing something",// text of the snackbar
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
const login = () => {
    try {

        let email = $("#nameinput").val();
        let password = $("#passwordInput").val();
        let array = [email, password];
        let arrayName = ["#nameinput", "#passwordInput",];
        //Looping the array to check for condition.
        //Check if it has any value


        if (array[0] && array[1]) {
            $.ajax({
                type: 'post',
                url: '../backend_instantiate/int_login.php',
                data: {type: 'login', email: array[0], password: array[1]},
                success: function (data) {
                    $('#createUser_btn').attr("disabled", true);
                    let options = {
                        content: data, // text of the snackbar
                        style: "toast", // add a custom class to your snackbar
                        timeout: 500, // time in milliseconds after the snackbar autohides, 0 is disabled
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

                        } // callback called when the snackbar gets closed.
                    }
                    $.snackbar(options);


                },

            });
        } else {

            let options = {
                content: "you are missing something",// text of the snackbar
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