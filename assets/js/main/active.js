
function setCookies(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
$('.re_send').click(function () {
    swal({
        title: "Gửi lại mail xác thực",
        text: "Bạn có chắc chắn muốn nhận mã xác thực mới ?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Đóng",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        var data = new FormData();
        data.append('type', 4);

        // return false;
        $.ajax({
            url: '/re_active',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            data: data,
            success: function (response) {
                if (response.status == 0) {
                    alert(response.mess);
                } else if (response.status == 1) {

                    swal({
                        title: "Gửi lại mail xác thực",
                        type: "success",
                        text: "Zendo Shop đã gửi mã xác thực mới đến email đăng ký của bạn. Vui lòng kiểm tra email để có mã xác thực !"
                    }, function () {

                    });
                }
            },
            error: function (xhr) {
                alert('Thất bại');

            }
        });
    });

})
$("#send_active").validate({
    onclick: false,
    rules: {
        "code": {
            required: true,
            minlength: 6,
            maxlength: 6,
        },
    },
    messages: {
        "code": {
            required: "Vui lòng nhập mã xác thực!",
            minlength: "Độ dài mã xác thực không hợp lệ!",
            maxlength: "Độ dài mã xác thực không hợp lệ!",
        },
    },
    submitHandler: function (form) {

        var code = $('#code').val();
        var data = new FormData();
        data.append('code', code);
        data.append('type', 3);

        // return false;
        $.ajax({
            url: '/active',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            data: data,
            success: function (response) {
                if (response.status == 0) {
                    alert(response.mess);
                } else {
                    swal({
                        title: "Xác thực tành công",
                        type: "success",
                        text: "Kích hoạt tài khoản thành công. Chúc bạn có nhiều trải nghiệm với Zendo Shop!"
                    }, function () {
                        var url = '/';
                        if (getCookie('url_301') != "") {
                            url = getCookie('url_301');
                        }
                        window.location.href = url;
                    });
                }
            },
            error: function (xhr) {
                alert('Thất bại');

            }
        });
        return false;
    }
});
