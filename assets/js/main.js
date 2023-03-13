
var site_main = 'http://localhost:8282/';
if (window.location.hash == '#_=_') {
    window.location.hash = ''; // for older browsers, leaves a # behind
    history.pushState('', document.title, window.location.pathname); // nice and clean
    e.preventDefault(); // no page reload
}
$('.box_vxmm_main').hover(function () {
    $(this).find('img').attr('src', site_main + 'images/home/hover.png');
}, function () {
    $(this).find('img').attr('src', site_main + 'images/home/default.png');
});
$(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
        $('#v_footer_all_top').fadeIn(800)
    } else {
        $('#v_footer_all_top').fadeOut(800)
    }
});
$('.c_ontop').click(function () {
    $('html, body').animate({
        scrollTop: 0
    }, 500)
});

function show_call(e, type) {
    if (type == 1) {
        $('.mun_call').show(200);
        $(e).attr('onclick', 'show_call(this,2)');
    } else {
        $('.mun_call').hide(200);
        $(e).attr('onclick', 'show_call(this,1)');
    }
}

$(document).click(function (event) {
    $target = $(event.target);
    if (!$target.closest('.nav_hover').length && $('.nav_hover').is(":visible") && !$target.closest('.menu_active_hover').length) {
        $('.nav_hover').hide(100);
        $('.menu_active_hover').removeClass('menu_active_hover');
    }

});

var type = "";
$('.tw_menu_nav').hover(function () {
    if ($(this).find('.nav_hover').length > 0) {
        evt_click_menu(this, type);
    } else {
        $(type).removeClass('menu_active_hover');
        $(type).find('.nav_hover').hide(100);
    }
    type = this;
})
$('.tw_menu_nav').mouseup(function () {
    if ($(this).find('.nav_hover').length > 0) {
        evt_click_menu(this, type);
    }
    type = this;
})

function show_menu(e) {
    if (e == 1) {
        $('.tw_menu_tablet').attr("onclick", "show_menu(2)");
        $('.tw_menu_right').show(500);
    } else {
        $('.tw_menu_tablet').attr("onclick", "show_menu(1)");
        $('.nav_hover').hide(100);
        $('.menu_active_hover').removeClass('menu_active_hover');
        $('.tw_menu_right').hide(500);
    }

}

function evt_click_menu(e, type) {
    if (e == type) {
        var check_clas = $(e).hasClass('menu_active_hover');
        if (check_clas) { } else {

            $(e).addClass('menu_active_hover');
        }
        $(e).find('.nav_hover').show(500);
    } else {
        $(e).find('.nav_hover').show(500);
        $(e).addClass('menu_active_hover');
        $(type).removeClass('menu_active_hover');
        $(type).find('.nav_hover').hide(100);
    }
}

function show_call(e, type) {
    if (type == 1) {
        $('.mun_call').show(200);
        $(e).attr('onclick', 'show_call(this,2)');
    } else {
        $('.mun_call').hide(200);
        $(e).attr('onclick', 'show_call(this,1)');
    }
}

function close_uudai() {
    $('.uudai').hide();
}

$(document).click(function (event) {
    $target = $(event.target);
    if (!$target.closest('.header_list_tablet').length && $('.header_list_tablet').is(":visible") && !$target.closest('.header_logo_tablet').length) {
        $('.header_list_tablet').hide(200);
    }

});

function show_menu(e) {
    if (e == 1) {
        $('.header_list_tablet').show(200);
    } else {
        $('.header_list_tablet').hide(200);
    }
}
var width = $('.box_vqmm').width();
$('.box_vqmm').css({
    'height': width
})
var width_img = ($('.thumb-bq').width() * 0.5);
$('.thumb-bq img').css({
    'height': width_img
})
var tam = "";
var tam_img = "";

function click_img(id, e) {
    //ẩn cái cũ
    $('.text_' + tam).hide(100);
    $(tam_img).find('img').removeClass('img_active');
    $(tam_img).find('p').removeClass('p_active');


    // show cái mới
    $(e).find('p').addClass('p_active');
    $(e).find('img').addClass('img_active');
    $('.text_' + id).show(100);
    tam = id;
    tam_img = e;
}

function click_menu_con(e, type) {
    if (type == 1) {
        $(e).next().show(100);
        $(e).attr('onclick', 'click_menu_con(this,2)');
    } else {
        $(e).next().hide(100);
        $(e).attr('onclick', 'click_menu_con(this,1)');
    }
}