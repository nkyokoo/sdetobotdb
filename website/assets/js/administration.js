
$(function() {
let app = new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue!'
    }
    });

    $('ul.tabs li').click(function(){
        let tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })


});
