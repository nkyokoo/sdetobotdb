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

    $('#sideBar').hover(function(){
        $(this).animate({width:'10rem'},100, function () {
            $("#sidebarcontent").css({'display':'block'})

        });
    },function(){
        $(this).animate({width:'1rem'},100, function () {
            $("#sidebarcontent").css({'display':'none'})

        });

    }).trigger('mouseleave');

    $("#callPhplogout").click(function(){
        $.ajax({
            type: "POST",
            data: {
                logout: '1',
            },
            url: "../authenticator.php",
            success: function(output) {
                alert(output);
                if (output == 'done') {
                    window.location = '../index.php';
                }
            }
        })
    })

});
let sendMail = () => {
    let content = document.getElementById('Message-input')
    let category = document.getElementById('categoryList')
    let title = document.getElementById('messageTitle')

    if (title.value !== "" && content.value !== "" && category.value !== "") {
        $.post("api/sendEmail.php", {
            title:  category.options[category.selectedIndex].value + "-" + title.value,
            content: content.value,

        },  (data) => {
            alert(data)
        })
    } else {
        alert("error")


    }

}
