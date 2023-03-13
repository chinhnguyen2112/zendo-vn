
$('.change_content_li').click(function () {
    let id_active = $(this).data('active')
    switch (id_active) {
        case 1:
            $('.description').show()
            $('.champ').hide()
            $('.skin').hide()
            $('.active').removeClass('active')
            $(this).addClass('active')
            break;
        case 2:
            $('.champ').show()
            $('.description').hide()
            $('.skin').hide()
            $('.active').removeClass('active')
            $(this).addClass('active')
            break;
        case 3:
            $('.skin').show()
            $('.description').hide()
            $('.champ').hide()
            $('.active').removeClass('active')
            $(this).addClass('active')
            break;
        default:
            break;
    }
})
var id_voucher = 0;
var val_voucher = 0;

function show_popup() {
    if (parseInt(id_user) > 0) {
        $('.popup_voucher').show();
    } else {
        swal({
            title: "Có lỗi xảy ra",
            type: "error",
            text: "Bạn chưa đăng nhập!"
        }, function () {
            window.location = '/dang-nhap/';
        });
    }
}


$(".inp_voucher").on('keypress', function (e) {
    if (e.which == 13) {
        apdung_voucher();
    }
});


$(document).ready(function () {
    $('.box_text_noti_gif').click(function () {
        $(this).find('.check_voucher').click();
    })
    $('.check_voucher').click(function () {
        if ($(this).prop('checked')) {
            $('.inp_voucher').val('');
            $('.active_voucher').removeClass('active_voucher');
            $(".check_voucher").prop('checked', false);
            $(this).prop('checked', true);
            $(this).parents('.box_text_noti_gif').addClass('active_voucher');
            id_voucher = $(this).next('.box_voucher').data('id');
            val_voucher = $(this).next('.box_voucher').data('value');
            $('#id_voucher').val(id_voucher)
            $('#val_voucher').val(val_voucher)
        } else {
            $('.active_voucher').removeClass('active_voucher');
            id_voucher = 0;
            val_voucher = 0;
            $('#id_voucher').val('0')
            $('#val_voucher').val('0')
        }
    })


    $(".account_menu ul.left li").click(function () {
        $(".account_menu ul.left li").removeClass("active");
        $(this).addClass("active");
        target = $(this).attr("target");
        $(".account_info .detail_account").hide()
        $("#" + target).show();
    });
});


var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

function strtonum(num) {
    return parseInt(num, 10);
}

mini_des_more = 4;

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            this_url = e.target.result;
            $("#public_image_" + get_target).hide();
            $("#image_preview_" + get_target + " img").attr("src", this_url);
            $("#image_preview_" + get_target).show();
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function format_price(div) {
    x = $(div).val();
    x = x.replace(/\./g, '');
    num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $(div).val(num);
}
function test_cart(id) {
    swal({
        title: "Tài Khoản Số #" + id,
        text: "Bạn có chắc chắn muốn mua tài khoản này ?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $.post("/them_gio_hang", {
            id: id,
            id_voucher: $('#id_voucher').val(),
            val_voucher: $('#val_voucher').val(),
            gio_hang: 4
        }, function (data) {
            if (data.status == 1) {
                window.location.href = "/gio-hang/";
            } else {
                swal({
                    title: "Có lỗi xảy ra",
                    type: "error",
                    text: data.message
                }, function () {
                    if (data.status == 0) {
                        window.location.href = "/gio-hang/";
                    } else {
                        window.location.href = "/dang-nhap/";
                    }
                });
            }
        }, "json");
    });
}

function setCookies(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}