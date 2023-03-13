var width = $('.box_vqmm').width();
$('.box_vqmm').css({
    'height': width
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

$('.show_slick').slick({
    slidesToShow: 1,
    arrows: false,
    slidesToScroll: 1,
    adaptiveHeight: true,
    // autoplay: true,
    infinite: true,
    autoplaySpeed: 3000,
});
$('.show_slick_2').slick({
    slidesToShow: 2,
    arrows: false,
    slidesToScroll: 1,
    adaptiveHeight: true,
    // autoplay: true,
    infinite: true,
    // autoplaySpeed: 3000,
});