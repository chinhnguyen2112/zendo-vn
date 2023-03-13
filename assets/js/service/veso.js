function show_des_vs(type, e) {
    if (type == 1) {
        $(e).text('Ẩn bớt');
        $(e).attr('onclick', 'show_des_vs(0,this)');
        $('.list_text_vs').removeClass('active_hide');
    } else if (type == 0) {
        $(e).text('Xem thêm');
        $(e).attr('onclick', 'show_des_vs(1,this)');
        $('.list_text_vs').addClass('active_hide');
    }
}

// validate change password
$("#form_vs").validate({
    onclick: false,
    rules: {
        "number_vs": {
            required: true,
            maxlength: 2,
        },
        "amount_zen": {
            required: true,
            min:20
        }
    },
    messages: {
        "number_vs": {
            required: "Vui lòng nhập con số may mắn.",
            maxlength: "Số phải từ 00 đến 99",
        },
        "amount_zen": {
            required: "Vui lòng nhập số Zen.",
            min: "Tối thiểu cược 20 Zen"
        },
    },

    submitHandler: function() {
        var number_vs = $('#number_vs').val();
        if (number_vs < 1) {
            number_vs = '00';
        }
        if (confirm('Bạn muốn đặt số ' + number_vs + ' với ' + $('#amount_zen').val() + ' Zen?')) {
            var data = new FormData();
            data.append('number', $('#number_vs').val());
            data.append('zen', $('#amount_zen').val());

            $.ajax({
                type: 'post',
                url: '/post_veso',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function(feedback) {

                    if (feedback.status == 0) {
                        swal({
                            title: "Có lỗi xảy ra",
                            type: "error",
                            text: feedback.mess
                        });
                    } else if(feedback.status == 2) {
                        swal({
                            title: "Chưa đăng nhập",
                            type: "error",
                            text: feedback.mess
                        }, function() {
                            window.location.href='/dang-nhap/';
                        });
                    } else {
                        swal({
                            title: "Thành công",
                            type: "success",
                            text: feedback.mess
                        }, function() {
                            window.location.reload()
                        });
                    }
                }
            })
        }
    }
});