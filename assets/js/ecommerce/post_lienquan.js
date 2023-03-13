
$('#champs').select2();

$('#skin').select2();
$(document).ready(function () {

    jQuery.validator.addMethod('valid_post', function (value) {

        var regex = /^\S*$/;

        return value.trim().match(regex);

    });



    var type_action = $('.btn-sm').attr('data-action');



    if (type_action != 'update') {

        $('#data-lienquan').validate({

            onclick: false,

            rules: {

                "username": {

                    required: true,

                    valid_post: true

                },

                "password": {

                    required: true,

                    valid_post: true

                }

                ,

                "price": {

                    required: true,

                    maxlength: 8

                },

                "thumb": {

                    required: true,

                },

                "gem[]": {

                    required: true,

                }

            },

            messages: {

                "username": {

                    required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.",

                    valid_post: "Bạn vui lòng viết liền và không có dấu."

                },

                "password": {

                    required: "Vui lòng nhập mật khẩu tài khoản của bạn.",

                    valid_post: "Bạn vui lòng viết liền và không có dấu."

                },

                "price": {

                    required: "Vui lòng nhập giá mong muốn.",

                    maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại"

                },

                "thumb": {

                    required: "Vui lòng nhập ảnh đại diện.",

                },

                "gem[]": {

                    required: "Vui lòng nhập ảnh thông tin.",

                }

            },

            errorPlacement: function (error, element) {



                if (element.attr("name") == "username") {

                    $(".err_username").html(error);

                }

                if (element.attr("name") == "password") {

                    $(".err_password").html(error);

                }

                if (element.attr("name") == "price") {

                    $(".err_price").html(error);

                }

                if (element.attr("name") == "thumb") {

                    $(".err_thumb").html(error);

                }

                if (element.attr("name") == "gem[]") {

                    $(".err_gem").html(error);

                }

            },

            success: function () {
            },

            submitHandler: function () {

                var type_action = $('.btn-sm').attr('data-action');

                var formData = new FormData($('#data-lienquan')[0]);

                $.ajax({

                    url: '/user_post_lq',

                    type: 'POST',

                    data: formData,

                    async: false,

                    dataType: 'json',

                    success: function (data) {

                        if (data.status == 1) {
                            swal({
                                title: "Thành công",
                                type: "success",
                                text: data.msg
                            }, function () {
                                window.location = '/danh-sach-tai-khoan/?game=1';
                            });
                        } else {
                            swal({
                                title: "Thất bại",
                                type: "error",
                                text: data.msg
                            });
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        })

    } else {
        console.log("NONOOO");
        $('#data-lienquan').validate({
            onclick: false,
            rules: {
                "username": {
                    required: true,
                    valid_post: true
                },
                "password": {
                    required: true,
                    valid_post: true
                },
                "price": {
                    required: true,
                    maxlength: 8
                }
            },
            messages: {
                "username": {
                    required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.",
                    valid_post: "Bạn vui lòng viết liền và không có dấu."
                },
                "password": {
                    required: "Vui lòng nhập mật khẩu tài khoản của bạn.",
                    valid_post: "Bạn vui lòng viết liền và không có dấu."
                },
                "price": {
                    required: "Vui lòng nhập giá mong muốn.",
                    maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại"
                }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "username") {
                    $(".err_username").html(error);
                }
                if (element.attr("name") == "password") {
                    $(".err_password").html(error);
                }
                if (element.attr("name") == "price") {
                    $(".err_price").html(error);
                }
            },
            submitHandler: function () {
                var formData = new FormData($('#data-lienquan')[0]);
                $.ajax({
                    url: '/user_post_lq',
                    type: 'POST',
                    data: formData,
                    async: false,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == 1) {
                            swal({
                                title: "Thành công",
                                type: "success",
                                text: data.msg
                            }, function () {
                                window.location = '/danh-sach-tai-khoan/?game=1';
                            });
                        } else {
                            swal({
                                title: "Thất bại",
                                type: "error",
                                text: data.msg
                            });
                        }
                    },

                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        })
    }
})
$('#champs').change(function () {
    var champs_count = $('#champs').find(":selected").length;
    $('#champs_count').val(champs_count);
})
$('#skin').change(function () {
    var skins_count = $('#skin').find(":selected").length;
    $('#skins_count').val(skins_count);
})