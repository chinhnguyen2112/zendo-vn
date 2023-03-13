// js nut p thanh submit
$('.upload_btn').click(function() {
    $('#avatar').click();
});

// xem truoc anh truoc khi upload

function preview_image(e, element) {
    var _URL = window.URL || window.webkitURL;
    var file, img;
    preview_before_upload(e, element);
}

function preview_before_upload(event, elem) {
    if (typeof FileReader == "undefined") return true;
    var elem = $(elem);
    var files = event.target.files;
    for (var i = 0, file; file = files[i]; i++) {
        if (file.type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(event) {
                    var image = event.target.result;
                    $('.img_avt').attr("src", image);
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }
}

// check gioi tinh

$('.check_gt').click(function() {
    if ($(this).prop('checked')) {
        $(".check_gt").prop('checked', false);
        $(this).prop('checked', true);
        var id = $(this).data('id');
        $('#sex').val(id);

    }
});

// <!-- chuyen tab -->
$('.active-info-box').click(function() {
    $('.active').removeClass('active')
    $('.appear').removeClass('appear')
    $('.body-info').addClass('active')
    $(this).find('img').addClass('appear')

})

$('.active-history-spin').click(function() {
    $('.active').removeClass('active')
    $('.appear').removeClass('appear')
    $('.spin-history-box').addClass('active')
    $(this).find('img').addClass('appear')

})

$('.active-change-pass').click(function() {
    $('.active').removeClass('active')
    $('.appear').removeClass('appear')
    $('.box_change_pass').addClass('active')
    $(this).find('img').addClass('appear')
})

$('.active-code').click(function() {
    $('.active').removeClass('active')
    $('.appear').removeClass('appear')
    $('.box_code').addClass('active')
    $(this).find('img').addClass('appear')
})
$('.active-zen').click(function() {
    $('.active').removeClass('active')
    $('.appear').removeClass('appear')
    $('.box_zen').addClass('active')
    $(this).find('img').addClass('appear')
})

//next menu
$('.arrow_right').click(function() {
    $('.li-active').removeClass('li-active')
    $('.title').find('li').addClass('none')
    $('.none-on-respon').addClass('li-active')
    $('.none-on-respon').removeClass('none')
    $('.li-btn').addClass('li-active')
})

$('.arrow_left').click(function() {
    $('.none-on-respon').removeClass('li-active')
    $('.none-on-respon').addClass('none')
    $('.hien').addClass('li-active')
})
$('.menu-select').change(function() {
    var value_select = $('.menu-select').val();
    if (value_select == 1) {
        $('.active').removeClass('active')
        $('.appear').removeClass('appear')
        $('.body-info').addClass('active')
        $(this).find('img').addClass('appear')
    } else
    if (value_select == 2) {
        $('.active').removeClass('active')
        $('.appear').removeClass('appear')
        $('.spin-history-box').addClass('active')
        $(this).find('img').addClass('appear')
    } else if (value_select == 4) {
        window.location.href = "/nap-the/";
    } else
    if (value_select == 5) {
        $('.active').removeClass('active')
        $('.appear').removeClass('appear')
        $('.box_change_pass').addClass('active')
        $(this).find('img').addClass('appear')
    } else if (value_select == 6) {
        window.location.href = "/kho-do/";
    } else if (value_select == 7) {
        $('.active').removeClass('active')
        $('.appear').removeClass('appear')
        $('.box_code').addClass('active')
        $(this).find('img').addClass('appear')
    } else if (value_select == 8) {
        $('.active').removeClass('active')
        $('.appear').removeClass('appear')
        $('.box_zen').addClass('active')
        $(this).find('img').addClass('appear')
    }
})

// validate đổi zen
$("#inp_change_zen").validate({
    onclick: false,
    rules: {
        "amount_zen": {
            required: true,
            number: true,
            min: 1
        }
    },
    messages: {
        "amount_zen": {
            required: "Vùi lòng nhập số Zen muốn đổi!",
            number: 'Vui lòng nhập số',
            min: "Số phải lớn hơn 1"
        }
    },

    submitHandler: function() {
        if (confirm('Bạn muốn đổi ' + ($('#amount_zen').val()).toLocaleString('en-US') + ' Zen với giá ' + (($('#amount_zen').val()) * 100).toLocaleString('en-US') + 'đ ?')) {
            var data = new FormData();
            data.append('zen', $('#amount_zen').val());
            data.append('type', 4);

            $.ajax({
                type: 'post',
                url: '/doi_zen',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function(feedback) {
                    if (feedback.status == 1) {
                        swal({
                            title: "Thành Công",
                            type: "success",
                            text: feedback.mess
                        }, function() {
                            window.location.reload();
                        });
                    } else {
                        swal({
                            title: "Thất bại",
                            type: "error",
                            text: feedback.mess
                        }, function() {
                            if (feedback.status == 0) {
                                window.location.href = '/nap-the/';
                            }
                        });
                    }

                }
            })
        }
    }

});
// validate nhập mã giới thiệu
$("#inp_code_gt").validate({
    onclick: false,
    rules: {
        "code_gt": {
            required: true,
        }
    },
    messages: {
        "code_gt": {
            required: "Bạn chưa nhập mã giới thiệu!",
        }
    },

    submitHandler: function() {
        var data = new FormData();
        data.append('code', $('#code_gt').val());
        data.append('type', 3);

        $.ajax({
            type: 'post',
            url: '/ma_gioi_thieu',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,

            success: function(feedback) {
                if (feedback.status == 1) {
                    $('.popup_voucher').find('.happy_gif').text(feedback.mess);
                    $('.div_img_noti').show();
                    $('.img_error').hide();
                    $('.popup_voucher').find('.btn_lg').show();
                    $('.popup_voucher').show()
                } else {
                    $('.popup_voucher').find('.happy_gif').text(feedback.mess);
                    $('.div_img_noti').hide();
                    $('.img_error').show();
                    $('.popup_voucher').find('.btn_lg').hide();
                    $('.popup_voucher').show()
                }

            }
        })
    }

});

// validate change password
$("#change_pass").validate({
    onclick: false,
    rules: {
        "old_pass": {
            required: true,
        },
        "new_pass": {
            required: true,
            minlength: 6,
        },
        "re_pass": {
            required: true,
            minlength: 6,
            equalTo: "#new_pass",
        },
    },
    messages: {
        "old_pass": {
            required: "Vui lòng nhập tên tài khoản.",
        },
        "new_pass": {
            required: "Vui lòng nhập nhật khẩu.",
            minlength: "Mật khẩu ít nhất chứa 6 ký tự.",
        },
        "re_pass": {
            required: "Bạn chưa nhập lại mật khẩu.",
            equalTo: "Nhập lại mật khẩu không chính xác.",
        },
    },

    submitHandler: function() {
        var data = new FormData();
        data.append('oldpass', $('#old_pass').val());
        data.append('newpass', $('#new_pass').val());
        data.append('type', 1);

        $.ajax({
            type: 'post',
            url: '/doi_mat_khau',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,

            success: function(feedback) {
                if (feedback.status == 0) {
                    alert(feedback.mess)
                } else {
                    alert(feedback.mess)
                    window.location.reload();
                }

            }
        })
    }

});

// update info
$("#update_info").validate({
    onclick: false,
    rules: {
        "fullname": {
            required: true,
        },

        "email": {
            required: true,
            email: true,
        },

        "sex": {
            required: true,
        },

        "phonenumber": {
            required: true,
            number: true,
            minlength: 10
        },

        "birthday": {
            required: true,
        },
    },
    messages: {
        "fullname": {
            required: "Bạn chưa nhập họ tên đầy đủ.",
        },

        "email": {
            required: "Bạn chưa nhập email.",
            email: "Định dạng email chưa đúng.",
        },

        "sex": {
            required: "Bạn chưa chọn giới tính"
        },

        "phonenumber": {
            required: "Bạn chưa nhập số điện thoại.",
            number: "Số điện thoại phải là số.",
            minlength: "Số điện thoại phải tối thiểu 10 số.",
        },

        "birthday": {
            required: "Bạn chưa chọn ngày sinh.",
        },
    },

    submitHandler: function() {
        var data = new FormData();
        var files = $('#avatar')[0].files;
        console.log(files);
        data.append('fullname', $('#fullname').val());
        data.append('email', $('#email').val());
        data.append('phonenumber', $('#phonenumber').val());
        data.append('birthday', $('#birthday').val());
        data.append('address', $('#address').val());
        data.append('sex', $('#sex').val());
        data.append('file', files[0]);
        data.append('type', 2);

        $.ajax({
            type: 'post',
            url: '/doi_thong_tin',
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            data: data,

            success: function(feedback) {
                if (feedback.status == 0) {
                    alert(feedback.mess)
                } else {
                    alert(feedback.mess)
                    // $('.avt_main').attr('src', site_main + feedback.url)
                    // $('.img_avatar_user').find('img').attr('src', site_main + feedback.url)
                }
            }
        })
    }

});