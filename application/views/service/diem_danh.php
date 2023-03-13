<div class="home_boby">
    <div class="content_body">
        <div class="z_content ">
            <div class="z_maxwith">
                <div class="z_main_content">
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_dd"></div>
                                <h2 class="font_size32 font_clor_w">ĐIỂM DANH NHẬN QUÀ</h2>
                                <img class="img_title_dd" src="<?= site_main() ?>images/home/diemdanh.png" alt="ảnh tiêu đề">
                            </div>
                            <div class="box_time_dd">
                                <p class="p_time_dd">Thời gian: <?= date('01/m/Y') ?> - <?= date('t/m/Y') ?></p>
                            </div>
                        </div>
                        <input type="hidden" name="" id="this_day" value="<?= $row ?>">
                        <input type="hidden" name="" id="check_dd" value="<?= $check ?>">
                        <div class="content_dd">
                            <div class="list_dd">
                                <?php for ($i = 1; $i <= 30; ++$i) { ?>
                                    <div class="box_day_dd" data-day="<?= $i ?>">
                                        <div class="data_day_dd">
                                            <?php
                                            if ($i == 3) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_3.png" alt="điểm danh">
                                                <p>Voucher 5%</p>';
                                            } elseif ($i == 7) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_7.png" alt="điểm danh">
                                                <p>Voucher 10k</p>';
                                            } elseif ($i == 10) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_10.png" alt="điểm danh">
                                                <p>Voucher 10%</p>';
                                            } elseif ($i == 15) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_15.png" alt="điểm danh">
                                                <p>Vòng quay acc</p>';
                                            } elseif ($i == 21) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_21.png" alt="điểm danh">
                                                <p>Voucher 15%</p>';
                                            } elseif ($i == 30) {
                                                echo '<img src="' . site_main() . 'images/diemdanh/d_30.png" alt="điểm danh">
                                                <p>Voucher 50k</p>';
                                            } else {
                                            ?>
                                                <img src="<?= site_main() ?>images/diemdanh/star_dd.png" alt="điểm danh">
                                                <p>5 EXP</p>
                                            <?php } ?>
                                        </div>
                                        <div class="amount_day_dd">
                                            <p>Ngày <?= $i ?></p>
                                        </div>
                                        <?php if ($i < $row) { ?>
                                            <img class="da_diem_danh" src="<?= site_main() ?>images/diemdanh/da_diemdanh.png" alt="đã điểm danh">
                                        <?php } ?>

                                    </div>
                                <?php } ?>
                            </div>
                            <div class="list_detail">
                                <div class="box_get_dd"><span onclick="diemdanh(this)">Điểm danh</span></div>
                                <div class="box_list_detail_dd">
                                    <p class="title_detail_dd">ĐIỂM DANH HÀNG NGÀY</p>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_3.png" alt="3 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 3</p>
                                            <p class="text_gift_dd">Voucher giảm giá 5% khi mua hàng</p>
                                        </div>
                                    </div>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_7.png" alt="7 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 7</p>
                                            <p class="text_gift_dd">Voucher giảm 10k trực tiếp khi mua hàng</p>
                                        </div>
                                    </div>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_10.png" alt="10 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 10</p>
                                            <p class="text_gift_dd">Voucher giảm giá 10% khi mua hàng</p>
                                        </div>
                                    </div>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_15.png" alt="15 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 15</p>
                                            <p class="text_gift_dd">Tặng vòng quay Account game</p>
                                        </div>
                                    </div>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_21.png" alt="21 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 21</p>
                                            <p class="text_gift_dd">Voucher giảm giá 15% khi mua hàng</p>
                                        </div>
                                    </div>
                                    <div class="box_detail_dd">
                                        <img src="<?= site_main() ?>images/diemdanh/d_30.png" alt="30 ngày">
                                        <div class="text_detail_dd">
                                            <p class="text_day_dd">Ngày 30</p>
                                            <p class="text_gift_dd">Voucher giảm 50k trực tiếp khi mua hàng</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>