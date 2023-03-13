<style>
    .main_content {
        height: 100vh;
    }

    .lienhe.box_vxmm_main {
        display: none;
    }

    .img_login {
        background: url('<?= site_main() ?>/images/login/dang_nhap.jpg');
        padding: 5px 0px;
        width: 100%;
        height: 100%;
        overflow: auto;
        min-height: calc(100vh - 204px);
    }

    .box_login {
        width: 100%;
        margin-top: 6%;
    }

    @media (min-width: 1366px) and (max-width : 1520px) {
        .box_login {
            width: 100%;
            max-height: 466px;
            overflow-y: auto;
        }
    }

    .box_lg {
        background: #FFFFFF;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.3);
        border-radius: 20px;
        width: 410px;
        margin: auto;
        /*margin-top: 100px;*/
        padding: 20px 20px;
    }

    @media (max-width : 768px) {
        .box_login {
            margin-top: 20%;
        }
    }

    @media (max-width : 480px) {
        .box_login {
            margin-top: 2%;
        }
    }

    @media (max-width : 375px) {
        .box_login {
            margin-top: -3%;
        }
    }

    .title_login {
        font-style: normal;
        font-weight: 700;
        font-size: 27px;
        line-height: 30px;
        margin-bottom: 20px;
        color: #FD4D2C;
        text-align: center;
    }

    .form_inp input {
        width: 100%;
        height: 40px;
        padding: 0px 35px;
        border: 1px solid #CCCCCC;
        box-sizing: border-box;
        outline: none;
        border-radius: 6px;
        color: #000;
        margin: 0px;
    }

    .form_inp {
        position: relative;
    }

    .img_email {
        position: absolute;
        left: 10px;
        top: 13px;
    }

    .img_phone {
        position: absolute;
        left: 5px;
        top: 13px;
    }

    .img_pass {
        position: absolute;
        left: 10px;
        top: 11px;
    }

    .img_pass_show {
        position: absolute;
        right: 7px;
        top: 7px;
    }

    .div_mr {
        margin: 10px 0px;
    }

    button.btn_login {
        padding: 6px;
        background: #FD4D2C;
        border-radius: 10px;
        width: 100%;
        border: navajowhite;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 27px;
        /* identical to box height */
        text-align: center;
        color: #fff;
        cursor: pointer;
    }

    .line_connect {
        margin: 10px 0px;
        display: flex;
        align-content: center;
        justify-content: center;
        color: #000;
    }

    .box_fb {
        background: #3A66FF;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        padding: 10px;
        text-align: center;
    }

    .redirect_lg {
        margin-top: 10px;
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        line-height: 24px;
        /* identical to box height */
        color: #000000;
    }

    a.link_lg {
        color: #fd4d2c;
        font-weight: 600;
    }

    .none_page {
        display: none;
    }

    .error {
        color: red;
    }

    footer {
        display: none;
    }

    @media (min-width: 568px) and (max-width: 991.98px) and (max-height: 599px) {
        .img_login {
            padding: 2vh 0;
            /*overflow: scroll;*/
        }

        .box_lg {
            width: 73vh;
            margin-top: 0vh;
            padding: 2vh;
        }

        .title_login {
            font-size: 5vh;
            margin-bottom: 2vh;
            line-height: 7.2vh;
        }

        .form_inp {
            margin: 1vh 0;
        }

        .form_inp input {
            height: 8vh;
        }

        button.btn_login {
            font-size: 4vh;
            padding: 1vh;
        }

        .line_connect {
            margin: 1vh 0;
            margin-top: 0vh;
        }

        img.img_pass_show {
            width: 5vh;
            top: 1.5vh;
        }

        .box_fb {
            padding: 1vh;
        }

        img.img_pass {
            top: 1vh;
        }

        .redirect_lg {
            margin-top: 1vh;
            font-size: 4vh;
        }
    }

    @media only screen and (max-width: 540px) {
        .box_lg {
            width: 90%;
            padding: 10px 10px;
            margin-top: 0px;
        }

        .title_login {
            margin-bottom: 10px;
        }

        .img_login {
            padding: 50px 0px;
            /*overflow: scroll;*/
        }
    }
</style>
<div class="content-box">
    <div class="container_login">
        <div class="img_login">
            <div class="box_login">
                <div class="box_lg">
                    <form id="register">
                        <div class="title_login"><span>ĐĂNG KÝ NGƯỜI BÁN</span></div>
                        <div class="content_login">
                            <div class="form_login">
                                <div class="form_inp" style="margin-bottom: 10px;">
                                    <input type="text" id="username" name="username" placeholder="Tên đăng nhập...">
                                    <span class="error error_name"></span>
                                    <img class="img_email" src="<?= site_main() ?>images/login/user.svg" alt="tên đăng nhập">
                                </div>
                                <div class="form_inp" style="margin-bottom: 10px;">
                                    <input type="text" id="email" name="email" placeholder="Email...">
                                    <span class="error error_email"></span>
                                    <img class="img_email" src="<?= site_main() ?>images/login/email.svg" alt="email">
                                </div>
                                <div class="form_inp div_mr">
                                    <input type="password" name="password" id="password" class="rg-password" placeholder="Mật khẩu...">
                                    <span class="error error_pass"></span>
                                    <img class="img_pass" src="<?= site_main() ?>images/login/pass.svg" alt="password">
                                    <img class="img_pass_show" src="<?= site_main() ?>images/login/show.svg" alt="password" onclick="myFunction()">
                                </div>
                                <div class="form_inp div_mr">
                                    <input type="password" name="password_confirmation" id="re_password" class="rg-password" placeholder="Nhập lại mật khẩu...">
                                    <span class="error error_re_pass"></span>
                                    <img class="img_pass" src="<?= site_main() ?>images/login/pass.svg" alt="password">
                                    <img class="img_pass_show" src="<?= site_main() ?>images/login/show.svg" alt="password" onclick="myFunction()">
                                </div>
                                <div class="form_inp" style="margin-bottom: 10px;">
                                    <input type="number" id="phone" name="phone" placeholder="Số điện thoại...">
                                    <span class="error error_phone"></span>
                                    <img class="img_phone" src="/images/login/phoneIcon2.png" alt="số điện thoại">
                                </div>
                                <div class="form_inp">
                                    <button class="btn_login">Đăng ký</button>
                                </div>
                            </div>
                        </div>
                        <div class="line_connect">
                            <img src="<?= site_main() ?>images/login/gach.svg" alt="nối">
                            <span>&nbsp;Hoặc&nbsp;</span>
                            <img src="<?= site_main() ?>images/login/gach.svg" alt="nối">
                        </div>
                        <div class="redirect_lg">
                            <span>Bạn đã có tài khoản ? <a href="/dang-nhap/" class="link_lg">Đăng nhập</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>