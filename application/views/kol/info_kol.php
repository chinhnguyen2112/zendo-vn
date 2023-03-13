<div id="main">
    <div class="content">
        <div class="banner">
            <div class="header-content">
                <div class="simple-info">
                    <form class="box_img_avt">
                        <img src="<?= site_main() ?><?php if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== "") {
                                                        echo   $_SESSION['user']['avatar'];
                                                    } else {
                                                        echo 'images/quanly/avt.png';
                                                    }
                                                    ?>" class="img_avt" alt="Ảnh đại diện">
                        <div class="EAyyHe">
                            <div class="EzQmEf"></div>
                        </div>
                    </form>
                    <input type="file" hidden name="avatar_kol" onchange="preview_image(event,this)" id="avatar_kol" accept="image/png, image/jpeg, image/jpg, image/gif">
                    <div class="text">
                        <h2> <?= $_SESSION['user']['name']; ?> </h2>
                        <p>Email:
                            <?php
                            if ($_SESSION['user']['email'] != "") {
                                echo $_SESSION['user']['email'];
                            } else {
                                echo 'Chưa cập nhật';
                            }
                            ?>
                        </p>
                        <div class="money">
                            <img src="<?= site_main()  ?>images/quanly/coin.svg" alt="coin">
                            <p>Số dư: <span> <?= number_format($_SESSION['user']['cash']); ?>đ </span></p>
                        </div>
                        <div class="money">
                            <img src="<?= site_main() ?>assets/img_gift/coins 1.png" alt="Zen">
                            <p>Zen: <span> <?= number_format($_SESSION['user']['zen']); ?> Zen </span></p>
                        </div>
                    </div>
                </div>
                <div class="amount-buy">
                    <div class="bought">
                        <p><?= 1 ?></p>
                        <span>Giờ thuê</span>
                    </div>
                    <div class="cart">
                        <p><?= 1 ?></p>
                        <span>lượt thuê</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content">
            <!-- main info -->
            <!-- <div class="box-title">
                <div class="title">
                    <li class="title-li hien active-info-box">
                        <img class="dot-green appear" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Thông tin cơ bản</span>
                    </li>
                    <li class="title-li active-change-pass none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Đổi mật khẩu</span>
                    </li>
                </div>

                <div class="menu-li">
                    <select name="" id="" onchange="" class="menu-select">
                        <option value="1">Thông tin cơ bản</option>
                        <option value="5">Đối mật khẩu</option>
                    </select>
                </div>
            </div> -->

            <!-- body info -->
            <div class="body-info active">
                <div class="from-content">
                    <label for="" class="data_lh">LIÊN HỆ</label>
                    <form id="update_info" enctype="multipart/form-data">
                        <div class="box-info">
                            <div class="box-left">
                                <div class="row">
                                    <label for="">
                                        <p>Nick name</p>
                                    </label>
                                    <input type="text" name="name" id="name" placeholder="Tên của bạn" value="<?= $_SESSION['user']['name']; ?>">
                                </div>
                                <div class="row">
                                    <label for="">
                                        <p>Tên tài khoản</p>
                                    </label>
                                    <input type="text" name="" placeholder="Tên tài khoản" disabled id="" value="<?= $_SESSION['user']['username']; ?>">
                                </div>
                                <div class="row">
                                    <label for="">
                                        <p>Email</p>
                                    </label>
                                    <input type="email" name="email" <?= ($_SESSION['user']['email'] != "") ? 'disabled' : '' ?> id="email" placeholder="Email của bạn" value="<?= ($_SESSION['user']['email'] != "") ? $_SESSION['user']['email'] : ''; ?>">
                                </div>
                                <div class="row">
                                    <label for="">
                                        <p>Số điện thoại</p>
                                    </label>
                                    <input type="text" name="phone" id="phone" placeholder="SĐT" value="<?= ($_SESSION['user']['phone'] != null) ? $_SESSION['user']['phone'] : '' ?>">
                                </div>
                                <div class="row">
                                    <label for="">
                                        <p>Giới tính</p>
                                    </label>
                                    <select name="sex" id="sex" class="select_1">
                                        <option value="0">Chọn giới tính</option>
                                        <option <?= (isset($_SESSION['user']) && $_SESSION['user']['sex'] == 1) ? 'selected' : '' ?> value="1">Nam</option>
                                        <option <?= (isset($_SESSION['user']) && $_SESSION['user']['sex'] == 2) ? 'selected' : '' ?> value="2">Nữ</option>
                                        <option <?= (isset($_SESSION['user']) && $_SESSION['user']['sex'] == 3) ? 'selected' : '' ?> value="3">Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="last-row">
                            <div class="last-btn">
                                <button class="save-btn">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="from-content">
                    <label for="" class="data_lh">THÔNG TIN</label>
                    <div class="from-introduce">
                        <form id="data_kol">
                            <div class="box-info">
                                <div class="box-left">
                                    <div class="row">
                                        <label for="">
                                            <p>Intro (Khoảng 5 đến 7 từ)</p>
                                        </label>
                                        <input type="text" name="intro" id="intro" placeholder="Giới thiệu ngắn gọn về bản thân" value="<?= (isset($kol) && $kol['text_intro'] != '') ? $kol['text_intro'] : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="">
                                            <p>Giá thuê (giá / 1 giờ)</p>
                                        </label>
                                        <input type="number" name="price" id="price" placeholder="giá thuê" value="<?= (isset($kol) && $kol['price'] >= 0) ? $kol['price'] : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="">
                                            <p>Các loại game</p>
                                        </label>
                                        <select name="cate[]" id="cate" class="select_2_cate" multiple>
                                            <?php
                                            $CI = &get_instance();
                                            $arr = $CI->Account->query_sql("SELECT * FROM category ORDER BY name ");
                                            if (isset($kol) && $kol['cate'] != '') {
                                                $list_cate = explode(',', $kol['cate']);
                                            }
                                            foreach ($arr as $val) { ?>
                                                <option <?= (isset($list_cate) && in_array($val['id'], $list_cate)) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                        <span id="cate_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="last-row">
                                <div class="last-btn">
                                    <button class="save-btn">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="from-content">
                    <label for="" class="data_lh">MẠNG XÃ HỘI</label>
                    <div class="from-introduce">
                        <form id="social">
                            <div class="box-info">
                                <div class="box-left">
                                    <div class="row">
                                        <label for="">
                                            <p>Facebook</p>
                                        </label>
                                        <input type="text" name="facebook" id="facebook" placeholder="Facebook" value="<?= (isset($kol) && $kol['facebook'] != '') ? $kol['facebook'] : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="">
                                            <p>Youtube</p>
                                        </label>
                                        <input type="text" name="youtube" placeholder="Youtube" id="youtube" value="<?= (isset($kol) && $kol['youtube'] != '') ? $kol['youtube'] : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="">
                                            <p>Tiktok</p>
                                        </label>
                                        <input type="text" name="tiktok" id="tiktok" placeholder="Tiktok" value="<?= (isset($kol) && $kol['tiktok'] != '') ? $kol['tiktok'] : '' ?>">
                                    </div>
                                    <div class="row">
                                        <label for="">
                                            <p>Instagram</p>
                                        </label>
                                        <input type="text" name="insta" id="insta" placeholder="Instagram" value="<?= (isset($kol) && $kol['instagram'] != '') ? $kol['instagram'] : '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="last-row">
                                <div class="last-btn">
                                    <button class="save-btn">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="from-content">
                    <label for="" class="data_lh">GIỚI THIỆU</label>
                    <div class="from-introduce">
                        <form id="introduce">
                            <div class="from-introduce-content">
                                <div class="form-group">
                                    <textarea class="form-control textarea_info" name="des" id="des" placeholder="Giới thiệu về bản thân" rows="10" style="border:none"><?= (isset($kol) && $kol['des'] != '') ? $kol['des'] : '' ?></textarea>
                                </div>
                            </div>
                            <div class="last-row">
                                <div class="last-btn">
                                    <button class="save-btn">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="from-content">
                    <form id="form_upload_img">
                        <div class="box_title_img">
                            <label for="" class="data_lh">ẢNH TẢI LÊN</label>
                            <input type="file" id="chon_anh" name="chon_anh[]" class="custom-file" multiple>
                        </div>
                        <div class="content-file">
                            <div class="load_img">
                                <div class="scroll_img"></div>
                            </div>
                        </div>
                        <div class="from-img-company">
                            <?php if (isset($kol) && $kol['list_img'] != '') {
                                $arr_img = explode(',', $kol['list_img']);
                                foreach ($arr_img as $key => $val) { ?>

                                    <div class="content-img">
                                        <img class="company_image" src="/<?= $val ?>" alt="ảnh thông tin">
                                        <img onclick="delete_image(<?= $key ?>, this)" class="delete_com_image" src="/images/quanly/icon-close.svg">
                                    </div>
                            <?php   }
                            } ?>
                        </div>
                        <div class="last-row">
                            <div class="last-btn">
                                <button class="save-btn">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box_change_pass">
                <div class="change_pass_container">
                    <form id="change_pass">
                        <div class="row_change_pass">
                            <label for="">
                                <p>MẬT KHẨU CŨ</p>
                            </label>

                            <input type="password" name="old_pass" id="old_pass" value="">
                        </div>

                        <div class="row_change_pass">
                            <label for="">
                                <p>MẬT KHẨU MỚI</p>
                            </label>

                            <input type="password" id="new_pass" name="new_pass" value="">
                        </div>

                        <div class="row_change_pass">
                            <label for="">
                                <p>XÁC NHẬN MẬT KHẨU MỚI</p>
                            </label>

                            <input type="password" name="re_pass" value="">

                        </div>

                        <div class="change_pass_btn">
                            <div class="last-btn">
                                <!-- <button class="cancel-btn">Hủy bỏ</button> -->
                                <button class="save-btn">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>