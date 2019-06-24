$(function(){
    $('#sideBar').hover(function(){
        $(this).animate({width:'10rem'},100, function () {
            $("#sidebarcontent").css({'display':'block'})

        });
    },function(){
        $(this).animate({width:'1rem'},100, function () {
            $("#sidebarcontent").css({'display':'none'})

        });

    }).trigger('mouseleave');
});