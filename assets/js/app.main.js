$(document).ready(function () {

    $(document).ready(function () {
        // $('#lq-danh-sach-tuong').select2();
    });
    $('.mobile_menu').click(function (event) {
        event.stopPropagation();
        // $('.mb_menu_cont').addClass('active');
        $('.modal').show();
    })
    $('.tat-menu').click(function (event) {
        event.stopPropagation();
        // $('.mb_menu_cont').removeClass('active');
        $('.modal').hide();
    })
    $('.mb_item_menu_dv_mngame').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.mb_mngame_menu').toggleClass('z-transform');
        $('.ul_menu_child_minigame').slideToggle(400);
    })
    $('.mb_item_menu_dv_service').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.mb_dichvu_menu').toggleClass('z-transform');
        $('.ul_menu_child_service').slideToggle(400);
    })
    $('.mb_item_menu_dv_store').click(function (event) {
        event.preventDefault();
        event.stopPropagation();
        $('.mb_store_menu').toggleClass('z-transform');
        $('.ul_menu_child_store').slideToggle(400);
    })
    $('.rm-run-header').click(function (event) {
        $('.top-header').hide(400);
    })
    $('input[name="header-search"]').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            $('.logo-search').click();
        }
    });
    //test khi nhấn Enter
    $('.logo-search').click(function (event) {
        alert("Bạn đã nhấn Enter thành công")
    });

    $('.mb-ve-chungtoi').click(function (event) {
        event.preventDefault();
        $('.ft-about-image').toggleClass('z-transform');
        $('.ul-ft-introduce').slideToggle(400)
    });

    $('.mb-tutorial').click(function (event) {
        event.preventDefault();
        $('.ft-tutorial-image').toggleClass('z-transform');
        $('.ul-ft-tutorial').slideToggle(400)
    });

    $('.ft-fanpage').click(function (event) {
        event.preventDefault();
        $('.ft-fanpage-image').toggleClass('z-transform');
        $('.fb-hide-mb').slideToggle(400)
    });


}) //end $(funtion());

// window.onclick = function(event) {
//     event.stopPropagation();
//     if (!event.current.matches('.mb_menu_cont')) {
//         var event_class = document.getElementsByClassName('mb_menu_cont');
//         var i;
//         for (i = 0; i < event_class.length; i++) {
//             var openDropdown = event_class[i];
//             if (openDropdown.classList.contains('active')) {
//                 openDropdown.classList.remove('active');
//             }
//         }
//     }
// }

var width = $('.box_vqmm').width();
$('.box_vqmm').css({
    'height': width
})
// var width = $('.box_vqmm').width();
// $('.box_vqmm').css({
//     'height': width
// })

var width = $(window).width();
if (width <= 425) {
    var splide = new Splide('.splide', {
        perPage: 1,
        type: 'loop',
        cover: true,
        lazyLoad: 'nearby',
        width: '100%',
        autoplay: true,
        breakpoints: {
            height: '6rem',
        },
    });
}
else {
    var splide = new Splide('.splide', {
        perPage: 2,
        type: 'loop',
        cover: true,
        lazyLoad: 'nearby',
        width: '100%',
        autoplay: false,
        breakpoints: {
            height: '6rem',
        },
    });
}
splide.mount();
var splide2 = new Splide( '.show_slick', {
    perPage : 1,
    type   : 'loop',
    cover   : true,
    lazyLoad: 'nearby',
    width : '100%',
    autoplay: true,
  });
  splide2.mount();
