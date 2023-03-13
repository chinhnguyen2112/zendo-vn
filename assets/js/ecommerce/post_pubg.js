$(document).ready(function () {
    jQuery.validator.addMethod("valid_post", function (e) {
        return e.trim().match(/^\S*$/);
    }),
        "update" != $(".btn-sm").attr("data-action")
            ? (console.log("YESSS"),
                $("#data-pubg").validate({
                    onclick: !1,
                    rules: { username: { required: !0, valid_post: !0 }, password: { required: !0, valid_post: !0 }, price: { required: !0, maxlength: 8 }, thumb: { required: !0 }, "gem[]": { required: !0 } },
                    messages: {
                        username: { required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                        password: { required: "Vui lòng nhập mật khẩu tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                        price: { required: "Vui lòng nhập giá mong muốn.", maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại" },
                        thumb: { required: "Vui lòng nhập ảnh đại diện." },
                        "gem[]": { required: "Vui lòng nhập ảnh thông tin." },
                    },
                    errorPlacement: function (e, t) {
                        "username" == t.attr("name") && $(".err_username").html(e),
                            "password" == t.attr("name") && $(".err_password").html(e),
                            "price" == t.attr("name") && $(".err_price").html(e),
                            "thumb" == t.attr("name") && $(".err_thumb").html(e),
                            "gem[]" == t.attr("name") && $(".err_gem").html(e);
                    },
                    submitHandler: function () {
                        $(".btn-sm").attr("data-action");
                        var e = new FormData($("#data-pubg")[0]);
                        $.ajax({
                            url: "/user_post_lq",
                            type: "POST",
                            data: e,
                            async: !1,
                            dataType: "json",
                            success: function (e) {
                                if (a.status == 1) {
                                    swal({
                                        title: "Thành công",
                                        type: "success",
                                        text: a.msg
                                    }, function () {
                                        window.location = '/danh-sach-tai-khoan/?game=3';
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
                }))
            : (console.log("NONOOO"),
                $("#data-pubg").validate({
                    onclick: !1,
                    rules: { username: { required: !0, valid_post: !0 }, password: { required: !0, valid_post: !0 }, price: { required: !0, maxlength: 8 } },
                    messages: {
                        username: { required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                        password: { required: "Vui lòng nhập mật khẩu tài khoản của bạn.", valid_post: "Bạn vui lòng viết liền và không có dấu." },
                        price: { required: "Vui lòng nhập giá mong muốn.", maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại" },
                    },
                    errorPlacement: function (e, t) {
                        "username" == t.attr("name") && $(".err_username").html(e), "password" == t.attr("name") && $(".err_password").html(e), "price" == t.attr("name") && $(".err_price").html(e);
                    },
                    submitHandler: function () {
                        var e = new FormData($("#data-pubg")[0]);
                        $.ajax({
                            url: "/user_post_lq",
                            type: "POST",
                            data: e,
                            async: !1,
                            dataType: "json",
                            success: function (e) {
                                if (e.status == 1) {
                                    swal({
                                        title: "Thành công",
                                        type: "success",
                                        text: e.msg
                                    }, function () {
                                        window.location = '/danh-sach-tai-khoan/?game=3';
                                    });
                                } else {
                                    swal({
                                        title: "Thất bại",
                                        type: "error",
                                        text: e.msg
                                    });
                                }
                            },
                            cache: !1,
                            contentType: !1,
                            processData: !1,
                        });
                    },
                }));
});
