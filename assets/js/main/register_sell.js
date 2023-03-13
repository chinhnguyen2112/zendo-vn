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
jQuery.validator.addMethod('valid_username', function (value) {
      var regex = /^[a-zA-Z0-9]([a-zA-Z0-9]){5,30}$/;
      return value.trim().match(regex);
});
jQuery.validator.addMethod('valid_password', function (value) {
      var regex = /^[a-zA-Z0-9_@$!%*#?&]{6,30}$/;
      return value.trim().match(regex);
});
$("#register").validate({
    onclick: false,
    rules: {
        "email": {
            required: true,
            email:true
        },
        "username": {
            required: true,
            minlength: 6,
            valid_username:true
        },
        "password": {
            required: true,
            minlength: 6,
            valid_password : true
        },
        "password_confirmation": {
            required: true,
            minlength: 6,
            equalTo: "#password",
        },
        "phone": {
            required: true,
            minlength: 8,
            digits: true
        },
    },
    messages: {
        "email": {
            required: "Vui lòng nhập email.",
            email:'Định dạng email không chính xác.'
        },
        "username": {
            required: "Vui lòng nhập tên tài khoản.",
            minlength : "Nhập tối thiểu 6 ký tự",
            valid_username : "Viết liền không dấu chữ hoặc số,không chứa các ký tự đặc biệt như -#?!% vv.."
        },
        "password": {
            required: 'Vui lòng nhập nhật khẩu.',
            minlength: 'Mật khẩu ít nhất chứa 6 ký tự.',
            valid_password : "Mật khẩu viết liền không dấu bao gồm chữ , số hoặc các ký tự : @$!%*#?&"
        },
        "password_confirmation": {
            required: "Bạn chưa nhập lại mật khẩu.",
            equalTo: "Nhập lại mật khẩu không chính xác."
        },
        "phone": {
            required: "Bạn chưa nhập số điện thoại.",
            minlength: "Nhập số điện thoại chính xác"
        }
    },
    errorPlacement: function(error, element) {
        if (element.attr("name") == "email") {
            $(".error_email").html(error);
        }
        if (element.attr("name") == "username") {
            $(".error_name").html(error);
        }
        if (element.attr("name") == "password") {
            $(".error_pass").html(error);
        }
        if (element.attr("name") == "password_confirmation") {
            $(".error_re_pass").html(error);
        }
        if (element.attr("name") == "phone") {
            $(".error_phone").html(error);
        }
    },
    submitHandler: function(form) {
        var name = $('#username').val();
        var pass = $('#password').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var data = new FormData();
        data.append('email', email);
        data.append('name', name);
        data.append('pass', pass);
        data.append('phone', phone);
        data.append('type', 1);
        data.append('loai_user', 2);
        // return false;
        $.ajax({
            url: '/register_sell',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            data: data,
            success: function(response) {
              if (response.status == 2) {
                    $(".error_email").html(response.mess);
                    $('.error_email').click(function() {
                        $(".error_email").html('');
                    })
                }else if (response.status == 0) {
                    $(".error_name").html(response.mess);
                    $('.error_name').click(function() {
                        $(".error_name").html('');
                    })
                } else {
                    window.location.href = "/xac-thuc-tai-khoan/";
                }
            },
            error: function(xhr) {
                alert('Thất bại');
            }
        });
        return false;
    }
});
function myFunction() {
  var x =$(".rg-password");
  if (x.attr("type") === "password") {
    x.attr("type","text");
  } else {
    x.attr("type","password");
  }
}