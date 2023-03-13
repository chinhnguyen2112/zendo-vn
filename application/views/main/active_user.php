
<style>
    #page_active {
        background: #fff;
    }

    .page_active {
        padding: 50px 0;
        text-align: center;
        max-width: 750px;
        margin: 0 auto;
    }

    .box_page_active {
        padding: 20px;
        box-shadow: 0px 0px 10px rgb(0 0 0 / 25%);
    }

    .img_page_active img {
        width: 355px;
        height: auto;
    }

    .body_page_active .main_text {
        margin-bottom: 20px;
        color: #000;
        font-size: 16px;
        font-weight: 500;
    }

    .body_page_active .main_tit {
        font-size: 30px;
        color: #3e3ed5;
        margin: 10px 0;
        font-weight: bold;

    }

    .body_page_active .main_text span {
        text-decoration: none;
        color: #3e3ed5;
        cursor: pointer;
        font-weight: 600;
    }

    .enter_code {
        margin-bottom: 20px;
    }

    .enter_code input {
        padding: 0 10px;
        font-size: 37px;
        line-height: 0px;
        outline: none;
        width: 250px;
        border: 1px solid #ccc;
        color: #000;
        font-weight: bold;
        text-align: center;
        letter-spacing: 10px;
    }


    .active_btn button {
        padding: 5px 20px;
        background: #407bff;
        color: #Fff;
        font-size: 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    .error {
        color: red;
        width: 100%;
    }

    input::placeholder {
        letter-spacing: normal;
        font-size: 75%;
        line-height: 46px;
    }

    @media only screen and (max-width: 769px) {
        .page_active {
            max-width: 550px;
        }
    }

    @media only screen and (max-width: 540px) {
        .page_active {
            max-width: 450px;
        }

        .img_page_active img {
            width: 200px;
        }

        .body_page_active .main_tit {
            font-size: 25px;
        }

        .body_page_active .main_text {
            padding: 0 20px;
            font-size: 11px;
        }
    }

    @media only screen and (max-width: 426px) {
        .page_active {
            max-width: 350px;
        }

        .body_page_active .main_tit {
            font-size: 20px;
        }

        .body_page_active .main_text {
            padding: 0 10px;

        }

        .enter_code input {
            width: 250px;
        }

        .active_btn button {
            font-size: 13px;
        }
    }

    @media only screen and (max-width: 376px) {
        .page_active {
            max-width: 300px;
        }

        .body_page_active .main_text {
            padding: 0 5px;
        }

        .enter_code input {
            width: 180px;
            font-size: 20px;
        }
    }

    @media only screen and (max-width: 321px) {

        .box_page_active {
            padding: 20px 10px;
        }

        .img_page_active img {
            width: 150px;
        }
    }
</style>
<div id="page_active">
    <div class="page_active">
        <div class="box_page_active">

            <div class="img_page_active">
                <img src="<?= site_main() ?>images/login/active.png" alt="img">
            </div>
            <div class="body_page_active">
                <p class="main_tit">Xác thực tài khoản</p>
                <p class="main_text">Mã xác thực của bạn đã được gửi đến email đăng ký của bạn. Vui lòng kiểm tra email. Nếu bạn chưa nhận được mã xác thực, hãy bấm vào đây “ <span class="re_send">Gửi lại Email xác thực</span> ”.</p>
            </div>
            <form id="send_active" >
                <div class="enter_code">
                    <input type="number" placeholder="Mã xác thực" name="code" id="code">
                </div>

                <div class="active_btn">
                    <button type="submit">Xác thực</button>
                </div>
            </form>
        </div>
    </div>
</div>



