$(document).ready(function() {
    $("#callPhplogout").click(function(){
        $.ajax({
            type: "POST",
            data: {
                logout: '1',
            },
            url: "../authenticator.php",
            success: function(output) {
                alert(output);
                if (output === 'done') {
                    window.location = '../index.php';
                }
            }
        })
    })
});
