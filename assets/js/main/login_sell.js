
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

        $("#register").validate({
            onclick: false,
            rules: {
                "username": {
                    required: true,
                },
                "password": {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                "username": {
                    required: "Vui lòng nhập tên tài khoản.",
                },
                "password": {
                    required: 'Vui lòng nhập nhật khẩu.',
                    minlength: 'Mật khẩu ít nhất chứa 6 ký tự.'
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "username") {
                    $(".error_name").html(error);
                }
                if (element.attr("name") == "password") {
                    $(".error_pass").html(error);
                }
            },
            submitHandler: function(form) {

                var name = $('#username').val();
                var pass = $('#password').val();
                var data = new FormData();
                data.append('name', name);
                data.append('pass', pass);
                data.append('type', 2);

                // return false;
                $.ajax({
                    url: '/login',
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    data: data,
                    success: function(response) {
                        if (response.status == 0) {
                            alert(response.mess);
                        } else if(response.status == 1) {
                            if (getCookie('url_301') != "") {
                                window.location.href = getCookie('url_301');
                            } else {
                                window.location.href = "/";
                            }
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
        $(document).ready(function() {
            $('.link_lg').click(function() {
                $('#z-myModal').fadeIn(400);
            })
            $('.z-close').click(function() {
                $('.z-modal').fadeOut(400);
            })
        })