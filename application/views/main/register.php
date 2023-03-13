<style>
  .main_content {
    height: 100vh;
  }

  .img_login {
    background: url('<?= site_main() ?>images/login/dang_nhap.jpg');
    padding: 5px 0px;
    width: 100%;
    height: 100%;
    min-height: calc(100vh - 204px);
  }

  .box_login {
    width: 100%;
    max-height: 50%x;
    overflow-y: auto;
  }

  .box_lg {
    background: #FFFFFF;
    box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    width: 410px;
    margin: auto;
    margin-top: 5%;
    padding: 20px 20px;
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
    margin: 20px 0px;
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
  }

  .line_connect {
    margin: 20px 0px;
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
    margin-top: 30px;
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

  .notify_auto {
    display: none !important;
  }

  .uudai {
    display: none !important;
  }

  .content-box {
    background: #1f2334;
    height: inherit;
    padding-top: 5%;
  }

  .z-modal-content img {
    height: 200px;
    width: 100%;
  }

  @media (min-width: 568px) and (max-width: 991.98px) and (max-height: 599px) {
    .img_login {
      padding: 2vh 0;
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
      width: 75%;
      padding: 10px 10px;
    }

    .title_login {
      margin-bottom: 10px;
    }

    .img_login {
      padding: 20px 0px;
    }

    .md-body-left,
    .md-body-right {
      width: 100% !important;
      margin-bottom: 20px;
    }

    .z-modal-content {
      width: 90% !important;
    }
  }
</style>
<link rel="stylesheet" href="<?= site_main() ?>assets/css/sanacc/e_commerce.css?v=<?= time() ?>">
<div class="content-box" style="    background: #1f2334;">

  <div class="z-modal-content">
    <div class="z-modal-body dis-flex" style="flex-wrap:wrap ;">
      <div class="md-body-left dis-flex">
        <h2 style="color:#F26222;">Cá Nhân</h2>
        <img src="<?= site_main() ?>images/login/logo_user_register.png" alt="người mua">
        <p class="user-register"><a href="/dang-ky-nguoi-mua/">Đăng ký mua acc</a></p>
      </div>
      <div class="md-body-right dis-flex">
        <h2 style="color:#F26222;">Người bán</h2>
        <img src="<?= site_main() ?>images/login/logo_seller_register.png" alt="người bán">
        <p class="seller-register"><a href="/dang-ky-nguoi-ban/">Đăng ký bán acc</a></p>
      </div>
    </div>
  </div>
</div>