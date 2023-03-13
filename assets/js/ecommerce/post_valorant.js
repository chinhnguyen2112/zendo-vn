$(document).ready(function () {
    jQuery.validator.addMethod("valid_post", function (a) {
        return a.trim().match(/^\S*$/);
    }),
        "update" != $(".btn-sm").attr("data-action")
            ? $("#data-valorant").validate({
                onclick: !1,
                rules: { username: { required: !0, valid_post: !0 }, password: { required: !0, valid_post: !0 }, price: { required: !0, maxlength: 8 }, thumb: { required: !0 }, "gem[]": { required: !0 } },
                messages: {
                    username: { required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                    password: { required: "Vui lòng nhập mật khẩu tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                    price: { required: "Vui lòng nhập giá mong muốn.", maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại" },
                    thumb: { required: "Vui lòng nhập ảnh đại diện." },
                    "gem[]": { required: "Vui lòng nhập ảnh thông tin." },
                },
                errorPlacement: function (a, e) {
                    "username" == e.attr("name") && $(".err_username").html(a),
                        "password" == e.attr("name") && $(".err_password").html(a),
                        "price" == e.attr("name") && $(".err_price").html(a),
                        "thumb" == e.attr("name") && $(".err_thumb").html(a),
                        "gem[]" == e.attr("name") && $(".err_gem").html(a);
                },
                submitHandler: function () {
                    $("#modal_loading").show();
                    $(".btn-sm").attr("data-action");
                    var a = new FormData($("#data-valorant")[0]);
                    $.ajax({
                        url: "/user_post_lq",
                        type: "POST",
                        data: a,
                        async: !1,
                        dataType: "json",
                        success: function (a) {
                            if (a.status == 1) {
                                swal({
                                    title: "Thành công",
                                    type: "success",
                                    text: a.msg
                                }, function () {
                                    window.location = '/danh-sach-tai-khoan/?game=8';
                                });
                            } else {
                                swal({
                                    title: "Thất bại",
                                    type: "error",
                                    text: a.msg
                                });
                            }
                        },
                        cache: !1,
                        contentType: !1,
                        processData: !1,
                    });
                },
            })
            : $("#data-valorant").validate({
                onclick: !1,
                rules: { username: { required: !0, valid_post: !0 }, password: { required: !0, valid_post: !0 }, price: { required: !0, maxlength: 8 } },
                messages: {
                    username: { required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                    password: { required: "Vui lòng nhập mật khẩu tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                    price: { required: "Vui lòng nhập giá mong muốn.", maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại" },
                },
                errorPlacement: function (a, e) {
                    "username" == e.attr("name") && $(".err_username").html(a), "password" == e.attr("name") && $(".err_password").html(a), "price" == e.attr("name") && $(".err_price").html(a);
                },
                submitHandler: function () {
                    var a = new FormData($("#data-valorant")[0]);
                    $.ajax({
                        url: "/user_post_lq",
                        type: "POST",
                        data: a,
                        async: !1,
                        dataType: "json",
                        success: function (a) {
                            if (a.status == 1) {
                                swal({
                                    title: "Thành công",
                                    type: "success",
                                    text: a.msg
                                }, function () {
                                    window.location = '/danh-sach-tai-khoan/?game=8';
                                });
                            } else {
                                swal({
                                    title: "Thất bại",
                                    type: "error",
                                    text: a.msg
                                });
                            }
                        },
                        cache: !1,
                        contentType: !1,
                        processData: !1,
                    });
                },
            });
});
