// tinh tien khi checkbox
var tong_tien_tam = tong_tien = last_price = 0;
var mess_text = '';
$('.avata_acc, .des_order').click(function () {
    $(this).prevAll('.action_cart').find('.choose_order').click();

})

$('.choose_order').each(function () {
    if ($(this).prop('checked')) {
        $(this).each(function () {
            var price = $(this).data('price')
            tong_tien = tong_tien_tam += price;
        })


    }
    $('.total_price').text(tong_tien.toLocaleString('en-US') + ' VNĐ')
    apdung_voucher()
})
$('.choose_order').click(function () {
    if ($(this).prop('checked')) {
        $(this).each(function () {
            var price = $(this).data('price')
            tong_tien = tong_tien_tam += price;
        })


    } else {
        $(this).each(function () {
            var price = $(this).data('price');
            if (tong_tien != 0) {
                tong_tien = tong_tien_tam -= price;
            }
        })


    }
    $('.total_price').text(tong_tien.toLocaleString('en-US') + ' VNĐ')
    apdung_voucher()
});

// chon voucher
var id_voucher = "";
var val_voucher = 0;

function show_popup() {
    last_price = tong_tien_tam;


    if (parseInt(id_user) > 0) {
        if (tong_tien > 0) {
            $('.popup_voucher').show();
            data = new FormData();
            data.append('last_price', last_price);
            // data.append('last_price_zend', last_price/100);
            data.append('gio_hang', 1);

            $.ajax({
                type: 'post',
                url: '/show_voucher',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function (feedback) {
                    if (feedback.status == 1) {
                        $('.body_gif_nav').html(feedback.html)
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
            });

        } else {
            swal({
                title: "Có lỗi xảy ra",
                text: 'Bạn chưa chọn đơn hàng!',
                type: "error",
            }, function () {

            });
        }


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

//    tính tiền khi chọn voucher


id_voucher_tam = 0;
var name_voucher = "";


function choose_voucher(e) {
    $(e).prev('.check_voucher').click();
    if ($(e).prev('.check_voucher').prop('checked')) {

        $('.inp_voucher').val('');
        $('.active_voucher').removeClass('active_voucher');
        $(".check_voucher").prop('checked', false);
        $(e).prev('.check_voucher').prop('checked', true);
        id_voucher_tam = $(e).data('id');
        val_voucher_tam = $(e).data('value');
        $('#id_voucher').val(id_voucher)
        $('#val_voucher').val(val_voucher)

    } else {
        $('.active_voucher').addClass('active_voucher');
        id_voucher_tam = 0;
        val_voucher_tam = 0;
        $('#id_voucher').val('0')
        $('#val_voucher').val('0')
    }

    if ($(e).hasClass('active_voucher')) {
        $(e).removeClass('active_voucher')
    } else {
        $(e).addClass('active_voucher')
    }
}

function check_voucher(e) {
    if ($(e).prop('checked')) {

        $('.inp_voucher').val('');
        $('.active_voucher').removeClass('active_voucher');
        $(".check_voucher").prop('checked', false);
        $(e).prop('checked', true);
        $(e).parents('.box_text_noti_gif').removeClass('active_voucher');
        id_voucher_tam = $(e).next('.box_voucher').data('id');
        val_voucher_tam = $(e).next('.box_voucher').data('value');
        name_voucher = $(e).next('.box_voucher').data('name');
        $('#id_voucher').val(id_voucher)
        $('#val_voucher').val(val_voucher)

    } else {
        $('.active_voucher').addClass('active_voucher');
        id_voucher_tam = 0;
        val_voucher_tam = 0;
        $('#id_voucher').val('0')
        $('#val_voucher').val('0')
    }

    if ($(e).hasClass('active_voucher')) {
        $(e).removeClass('active_voucher')
    } else {
        $(e).addClass('active_voucher')
    }
}

function append_voucher() {
    val_voucher = val_voucher_tam;
    last_price_tam = tong_tien_tam;

    last_price = last_price_tam - val_voucher;

    $('.last_price').text(last_price.toLocaleString('en-US') + ' VNĐ')
    $('.last_price_zend').text((last_price / 100).toLocaleString('en-US') + ' ZEN')
    $('.discount').text(val_voucher.toLocaleString('en-US') + ' VNĐ')
    $('.popup_voucher').hide();
    $('.text_choose_voucher').text("Bạn đã chọn \"" + name_voucher + "\"");

}
$('.inp_voucher').keypress(function (e) {
    if (event.keyCode == 13 || event.which == 13) {
        apdung_voucher()
    }
})

// tinh tien khi chon uu dai
function apdung_voucher() {
    $('.text_choose_voucher').text('');
    var discount = $('.inp_voucher').val()
    if (discount != "") {
        data = new FormData();
        data.append('discount', discount);
        data.append('gio_hang', 2);

        $.ajax({
            type: 'post',
            url: '/nhap_voucher',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,

            success: function (feedback) {
                if (feedback.status == 0) {
                    swal({
                        title: "Có lỗi xảy ra",
                        text: feedback.message,
                        type: "error",
                    }, function () {
                        $('.inp_voucher').val('');
                        $('.discount').text('0 VNĐ');
                        $('.last_price').text(tong_tien_tam.toLocaleString('en-US') + ' VNĐ')
                        $('.last_price_zend').text((tong_tien_tam / 100).toLocaleString('en-US') + ' ZEN')
                    });
                } else if (feedback.status == 1) {
                    if (feedback.val_use > tong_tien) {
                        swal({
                            title: "Có lỗi xảy ra",
                            text: 'Mã giảm giá này chỉ áp dụng cho đơn hàng từ ' + feedback.val_use + ' VNĐ trở lên!',
                            type: "error",
                        }, function () {
                            $('.inp_voucher').val('');
                            $('.discount').text('0 VNĐ');
                        });
                    } else {
                        last_price = tong_tien_tam - feedback.val;
                        $('.discount').text((feedback.val).toLocaleString('en-US') + ' VNĐ');
                        $('.last_price').text(last_price.toLocaleString('en-US') + ' VNĐ')
                        $('.last_price_zend').text((last_price / 100).toLocaleString('en-US') + ' ZEN')
                    }
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
        });

    } else {
        $('.inp_voucher').val('');
        $('.discount').text('0 VNĐ');
        $('.last_price').text(tong_tien_tam.toLocaleString('en-US') + ' VNĐ')
        $('.last_price_zend').text((tong_tien_tam / 100).toLocaleString('en-US') + ' ZEN')
    }


}


// nhấn thanh toán
$('.pay_cart_btn').click(function () {

    var discount = $('.inp_voucher').val();
    var id_account = [];
    var str_id = '';
    id_voucher = id_voucher_tam;
    tong_tien = tong_tien_tam;
    if (tong_tien > 0) {
        $('.choose_order').each(function () {
            if ($(this).prop('checked')) {
                id_account.push($(this).data('id'));
                str_id += '#' + $(this).data('id') + ', ';

            }
        })

        swal({
            title: "Thanh toán giỏ hàng",
            text: "Bạn có chắc chắn muốn mua tài khoản " + str_id.slice(0, -2) + ' ?',
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Có",
            cancelButtonText: "Không",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            data = new FormData();
            data.append('id_account', id_account);
            data.append('last_price', last_price);
            data.append('discount', discount);
            data.append('id_voucher', id_voucher);
            data.append('thanhtoan', 1);
            if (discount != "") {
                data.append('type', 1);
            } else if (id_voucher != "") {
                data.append('type', 2);
            } else if (discount != "" && id_voucher != "") {
                data.append('type', 3);
            }


            $.ajax({
                type: 'post',
                url: '/mua_acc',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function (feedback) {
                    if (feedback.status == 0) {
                        swal({
                            title: "Có lỗi xảy ra",
                            type: "error",
                            text: feedback.message
                        }, function () {
                            window.location.href = "/nap-the/";
                        });
                    } else {
                        $('.inp_voucher').val('');
                        $('.discount').text('0 VNĐ');
                        $('.last_price').text(' 0 VNĐ');
                        tong_tien_tam = tong_tien = last_price = 0;
                        $('.choose_order').each(function () {
                            $(this).prop('checked', false)
                        })
                        swal({
                            title: "Thành Công",
                            type: "success",
                            text: feedback.message
                        }, function () {
                            window.location.href = "/lich-su-mua-hang/"
                        });
                    }

                }
            });


        });

    } else {
        swal({
            title: "Có lỗi xảy ra",
            text: 'Bạn chưa chọn đơn hàng!',
            type: "error",
        }, function () {

        });
    }
})

// nhấn thanh toán bằng ZEN
$('.pay_cart_btn_zend').click(function () {

    var discount = $('.inp_voucher').val();
    var id_account = [];
    var str_id = '';
    var last_price_zend = $('.last_price_zend').html();
    id_voucher = id_voucher_tam;
    tong_tien = tong_tien_tam;
    if (tong_tien > 0) {
        $('.choose_order').each(function () {
            if ($(this).prop('checked')) {
                id_account.push($(this).data('id'));
                str_id += '#' + $(this).data('id') + ', ';

            }
        })

        swal({
            title: "Thanh toán giỏ hàng",
            text: "Bạn có chắc chắn muốn mua tài khoản " + str_id.slice(0, -2) + ' với ' + last_price_zend + ' ?',
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Có",
            cancelButtonText: "Không",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {
            console.log(last_price);

            data = new FormData();
            data.append('id_account', id_account);
            data.append('last_price_zend', (last_price / 100));
            data.append('discount', discount);
            data.append('id_voucher', id_voucher);
            data.append('thanhtoan', 2);
            if (discount != "") {
                data.append('type', 1);
            } else if (id_voucher != "") {
                data.append('type', 2);
            } else if (discount != "" && id_voucher != "") {
                data.append('type', 3);
            }


            $.ajax({
                type: 'post',
                url: '/mua_acc',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function (feedback) {
                    if (feedback.status == 0) {
                        swal({
                            title: "Có lỗi xảy ra",
                            type: "error",
                            text: feedback.message
                        }, function () {
                            window.location.href = "/nap-the/";
                        });
                    } else {
                        $('.inp_voucher').val('');
                        $('.discount').text('0 VNĐ');
                        $('.last_price').text(' 0 VNĐ');
                        tong_tien_tam = tong_tien = last_price = 0;
                        $('.choose_order').each(function () {
                            $(this).prop('checked', false)
                        })
                        swal({
                            title: "Thành Công",
                            type: "success",
                            text: feedback.message
                        }, function () {
                            window.location.href = "/lich-su-mua-hang/"
                        });
                    }

                }
            });


        });

    } else {
        swal({
            title: "Có lỗi xảy ra",
            text: 'Bạn chưa chọn đơn hàng!',
            type: "error",
        }, function () {

        });
    }
})


function sw() {
    swal({
        title: "Có lỗi xảy ra",
        text: 'Tài khoản của bạn không đủ để thực hiện giao dịch này nè!',
        type: "error"
    }, function () {
        window.location.href = "/nap-the/";
    });
}

function setCookies(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
setCookies('id_acc', '', 1);


// xóa giỏ hàng 
function delete_cart(e) {

    var id_cart = $('.delete_cart').data('id_cart');
    var id_post = $('.ma_acc').data('id_post');
    data = new FormData();
    data.append('id_cart', id_cart);
    data.append('gio_hang', 5);


    swal({
        title: "Thanh toán giỏ hàng",
        text: "Bạn có chắc chắn muốn xóa tài khoản #" + id_post + ' khỏi giỏ hàng?',
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {

        $.ajax({
            type: 'post',
            url: '/xoa_gio_hang',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,

            success: function (feedback) {
                if (feedback.status == 0) {
                    swal({
                        title: "Có lỗi xảy ra",
                        type: "error",
                        text: feedback.message
                    }, function () { });
                } else {
                    swal({
                        title: "Thành Công",
                        type: "success",
                        text: feedback.message
                    }, function () {
                        $(e).parents('.items_cart').remove();
                        window.location.reload();
                    });
                }

            }
        });

    });

}