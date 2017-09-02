$(function() {


    $('input').on('keyup', function() {
        $('#message').removeClass('warn').removeClass('sucesso').addClass('remove').html('');
    });


    $('.tabitem').on('click', function() {
        $('.activetab').removeClass('activetab');
        $(this).addClass('activetab');

        var item = $('.activetab').index();
        $('.tabbody').hide();
        $('.tabbody').eq(item).show();
    });

    $('.menu_lateral li').on('click', function() {

        $(this).addClass('menu_ativo').siblings().removeClass('menu_ativo');

    });

    $('.tabbody').eq(0).show();



    $('#busca').on('focus', function() {
        $(this).animate({
            width: '360px'
        }, 'fast');
    });

    $('#busca').on('blur', function() {
        if ($(this).val() == '') {
            $(this).animate({
                width: '.5px'
            }, 'fast');
        }

        setTimeout(function() {
            $('.searchresults').hide();
        }, 500);
    });


});