<div id="main">
    <div class="content">
        <!-- banner -->
        <div class="banner">
            <div class="slider">
                <img src="<?= site_main()  ?>images/quanly/slider.png" alt="slider-img">
            </div>

            <div class="header-content">
                <div class="simple-info">
                    <img class="avt_main" src=" <?= site_main() ?><?php if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== "") {
                                                                    echo  $_SESSION['user']['avatar'];
                                                                } else {
                                                                    echo 'images/quanly/avt1.png';
                                                                }
                                                                ?>" alt="avt1">
                    <div class="text">
                        <h2> <?php echo $_SESSION['user']['name']; ?> </h2>

                        <p>
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
                            <p> Số dư: <span> <?php echo number_format($_SESSION['user']['cash']); ?>đ </span></p>
                        </div>
                        <div class="money">
                            <img src="<?= site_main() ?>assets/img_gift/coins 1.png" alt="Zen">
                            <p> Số dư: <span> <?php echo number_format($_SESSION['user']['zen']); ?> Zen </span></p>
                        </div>
                    </div>
                </div>

                <div class="amount-buy">
                    <div class="bought">
                        <p><?php echo $count ?></p>
                        <span>Đã mua</span>
                    </div>
                    <div onclick="window.location.href = '/gio-hang/';" class="cart" style="cursor: pointer;">
                        <p><?php echo $row ?></p>
                        <span>Giỏ hàng</span>
                    </div>

                </div>
            </div>
        </div>

        <!-- main-content -->
        <div class="main-content">

            <!-- main info -->
            <div class="box-title">
                <div class="title">
                    <li class="title-li hien active-info-box">
                        <img class="dot-green appear" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Thông tin cơ bản</span>
                    </li>

                    <li class="title-li none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <a href="/nap-the/" target="_blank">Nạp thẻ</a>
                    </li>

                    <li class="title-li active-change-pass none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Đổi mật khẩu</span>
                    </li>

                    <li class="title-li none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <a href="/kho-do/" target="_blank">Kho đồ</a>
                    </li>

                    <li class="title-li active-code none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Mã giới thiệu</span>
                    </li>
                    <li class="title-li active-zen none-on-respon">
                        <img class="dot-green" src="<?= site_main()  ?>images/quanly/dot-green.svg" alt="dot-green">
                        <span>Đổi Zen</span>
                    </li>


                    <span class="a-arrow-down">
                        <img src="<?= site_main()  ?>images/quanly/arrow-down.svg" alt="arrow-down">
                    </span>

                </div>

                <!-- menu li -->
                <div class="menu-li">
                    <select name="" id="" onchange="" class="menu-select">
                        <option value="1">Thông tin cơ bản</option>
                        <!-- <option value="2">Lịch sử chơi game</option>
                        <option value="3">Rút thưởng</option> -->
                        <option value="4">Nạp thẻ</option>
                        <option value="5">Đối mật khẩu</option>
                        <option value="6">Kho đồ</option>
                        <option value="7">Mã giới thiệu</option>
                        <option value="8">Đổi Zen</option>
                    </select>
                </div>
            </div>

            <!-- body info -->
            <div class="body-info active">
                <form id="update_info" enctype="multipart/form-data">
                    <div class="box-info">
                        <div class="box-left">
                            <div class="row">
                                <label for="">
                                    <p>HỌ VÀ TÊN</p>
                                </label>
                                <input type="text" name="fullname" id="fullname" placeholder="Tên của bạn" value="<?php echo $_SESSION['user']['name']; ?>">
                            </div>

                            <div class="row">
                                <label for="">
                                    <p>TÊN TÀI KHOẢN</p>
                                </label>
                                <input type="text" name="" placeholder="Tên tài khoản" disabled id="" value="<?php echo $_SESSION['user']['username']; ?>">
                            </div>

                            <div class="row-special">
                                <label for="">
                                    <p>GIỚI TÍNH</p>
                                </label>
                                <div class="choose-sex">
                                    <div class="male">
                                        <input type="checkbox" class="check_gt" data-id="1" name="sex" <?php
                                                                                                        if ($_SESSION['user']['sex'] == 1) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                        <p>Nam</p>
                                    </div>

                                    <div class="female">
                                        <input type="checkbox" class="check_gt" data-id="2" name="sex" <?php
                                                                                                        if ($_SESSION['user']['sex'] == 2) {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                        <p>Nữ</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="" id="sex" value="<?php echo $_SESSION['user']['sex'] ?>">
                            <div class="row">
                                <label for="">
                                    <p>EMAIL</p>
                                </label>
                                <input type="email" name="email" id="email" placeholder="Email của bạn" value="<?php
                                                                                                                if ($_SESSION['user']['email'] != "") {
                                                                                                                    echo $_SESSION['user']['email'];
                                                                                                                }
                                                                                                                ?>">
                            </div>

                            <div class="row">
                                <label for="">
                                    <p>SỐ ĐIỆN THOẠI</p>
                                </label>
                                <input type="text" name="phonenumber" id="phonenumber" placeholder="Số điện thoại của bạn" value="<?php
                                                                                                                                    if ($_SESSION['user']['phone'] != null) {
                                                                                                                                        echo $_SESSION['user']['phone'];
                                                                                                                                    } ?>">
                            </div>

                            <div class="row">
                                <label for="">
                                    <p>NGÀY SINH</p>
                                </label>
                                <input type="date" name="birthday" id="birthday" placeholder="Ngày sinh của bạn" value="<?php
                                                                                                                        if ($_SESSION['user']['birthday'] != "") {
                                                                                                                            echo date('Y-m-d', $_SESSION['user']['birthday']);
                                                                                                                        } ?>">
                            </div>

                            <div class="row ">
                                <label for="">
                                    <p>ĐỊA CHỈ</p>
                                </label>
                                <input type="text" name="address" id="address" placeholder="Địa chỉ của bạn" value="<?php
                                                                                                                    if ($_SESSION['user']['address'] != "") {
                                                                                                                        echo $_SESSION['user']['address'];
                                                                                                                    } ?>">
                            </div>

                        </div>

                        <div class="box-right">
                            <div class="avatar">
                                <div class="avatar-img">
                                    <h3>ẢNH ĐẠI DIỆN</h3>
                                    <img src="<?= site_main() ?><?php if (isset($_SESSION['user']['avatar']) && $_SESSION['user']['avatar'] !== "") {
                                                    echo   $_SESSION['user']['avatar'];
                                                } else {
                                                    echo 'images/quanly/avt2.png';
                                                }
                                                ?>" class="img_avt" alt="avt2">
                                </div>
                                <div class="text-avatar">
                                    <p class="upload_btn">
                                        Đăng tải ảnh đại diện của bạn
                                    </p>
                                    <input onchange="preview_image(event,this)" type="file" name="avatar" id="avatar" hidden>
                                    <span>Tải lên ảnh từ thiết bị của bạn. Ảnh nên cắt thành hình vuông, kích thước ít nhất 184px x 184px.</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="last-row">
                        <div class="last-btn">
                            <!-- <button class="cancel-btn">Hủy bỏ</button> -->
                            <button class="save-btn">Lưu</button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- spin history -->
            <div class="spin-history-box">
                <div class="spin-history-container">
                    <table>
                        <tr class="head-table">
                            <td class="stt">
                                <p>#</p>
                            </td>
                            <td>
                                <p>LOẠI VÒNG QUAY</p>
                            </td>
                            <td>
                                <p>GIẢI THƯỞNG</p>
                            </td>
                            <td>
                                <p>THỜI GIAN QUAY</p>
                            </td>
                        </tr>

                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                        ?>

                            <tr class="body-table">
                                <td class="stt">
                                    <p>1</p>
                                </td>
                                <td>
                                    <p class="green">VÒNG QUAY CÔNG NGHỆ</p>
                                </td>
                                <td>
                                    <p class="green">9999 QUÂN HUY</p>
                                </td>
                                <td>
                                    <p>00:00:00 31/03/2022</p>
                                </td>
                            </tr>
                        <?php } ?>

                    </table>

                </div>
            </div>

            <!-- change pass page -->

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
            <!-- mã giới thiệu-->

            <div class="box_code">
                <div class="change_pass_container">
                    <form id="inp_code_gt">
                        <div class="row_change_pass">
                            <label for="">
                                <span class="span_code">Mã giới thiệu của bạn: </span><span class=" span_code span_text_code"><?php echo $_SESSION['user']['username']; ?></span>
                            </label>


                        </div>

                        <div class="row_change_pass">
                            <label for="">
                                <p>Nhập nhã giới thiệu</p>
                            </label>

                            <input type="text" placeholder="Nhập mã giới thiệu của bạn bè" id="code_gt" name="code_gt" value="">
                        </div>
                        <div class="change_pass_btn">
                            <div class="last-btn">
                                <button class="save-btn">Nhận quà</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- đổi zen -->

            <div class="box_zen">
                <div class="change_pass_container">
                    <form id="inp_change_zen">
                        <div class="row_change_pass">
                            <p class="p_text_zen">Tỉ lệ quy đổi tiền ra Zen: 100đ được 1 Zen: <span class="span_vidu"> Ví dụ bạn đổi 10.000đ bạn sẽ nhận được 100 Zen.</span> </p>
                            <p class="p_text_zen">Bạn có thể dùng Zen để chơi <a href="/ve-so-may-man/" target="_blank">Vé số may mắn</a> hoặc chơi <a href="/vong-quay-lien-quan/" target="_blank">Vòng quay liên quân</a> hoặc có thể sử dụng tất cả dịch vụ trên Shoptrungroll97 Shop.</p>
                        </div>

                        <div class="row_change_pass">
                            <label for="">
                                <p class="p_text_zen">Nhập số Zen bạn muốn quy đổi</p>
                            </label>

                            <input type="number" placeholder="Nhập số zen..." id="amount_zen" name="amount_zen" value="">
                        </div>
                        <div class="change_pass_btn">
                            <div class="last-btn">
                                <button class="save-btn">Đổi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>
</div>
<!-- thông báo chọn voucher -->
<div class="box_noti_gif popup_voucher">
    <div class="body_gif">
        <div class="title_noti_gif">
            <span class="noti_title_gif">THẤT BẠI</span>
        </div>
        <div class="body_noti_gif">
            <div class="body_gif_nav">
                <img class="img_error" src="<?= site_main()  ?>images/vqlq/error.svg" alt="lỗi">
                <div class="div_img_noti">
                    <div class="box_left_img">
                        <div class="box_img_free">
                            <img class="img-small" src="<?= site_main()  ?>images/vqlq/star.svg" alt="chúc mừng">
                        </div>
                        <div class="box_img_free">
                            <img class="img_big" src="<?= site_main()  ?>images/vqlq/star.svg" alt="chúc mừng">
                        </div>
                    </div>
                    <div class="box_left_img">
                        <div class="box_img_free">
                            <img class="img_big" src="<?= site_main()  ?>images/vqlq/star.svg" alt="chúc mừng">
                        </div>
                        <div class="box_img_free">
                            <img class="img-small" src="<?= site_main()  ?>images/vqlq/star.svg" alt="chúc mừng">
                        </div>
                    </div>
                </div>
                <div class="box_text_noti_gif">
                    <div class="type_gif">
                        <p class="happy_gif">Bạn chưa đăng nhập. Vui lòng đăng nhập!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="box_close_gif">
            <span class="span_close_gif" onclick="$('.popup_voucher').hide();">Đóng</span>
            <span class="span_close_gif btn_lg" style="background: #e67300 " onclick="window.location.href = '/vong-quay-lien-quan/'">Đến vòng quay</span>
        </div>
    </div>
</div>