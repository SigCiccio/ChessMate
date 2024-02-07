$(document).ready(function () {

    console.log('halo')

    $(window).resize(function () { 
        
        if($(window).width() >= 850){
            $('.titlebar').removeClass('hide');
        }
        else {
            if(!$('.titlebar').hasClass('home'))
                $('.titlebar').addClass('hide');
        }

    }).resize();

});