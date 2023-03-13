<div class="home_boby">
    <div class="content_body">
        <div class="z_content ">
            <div class="z_maxwith">
                <div class="z_main_content">
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_vip"></div>
                                <h2 class="font_size32 font_clor_w">VÉ SỐ MAY MẮN</h2>
                                <img class="img_title_vip" src="<?= site_main() ?>images/home/gia-re.png" alt="vé sô may mắn">
                            </div>
                            <div class="des_vs">
                                <div class="list_text_vs ">
                                    <p>1. Dự đoán 2 số cuối của tất cả các giải. Nếu về thì bạn trúng ăn 3.4 (Nếu về 2 lần thì bạn được x2, về 3 lần thì bạn được x3...)</p>
                                    <p>2. Thời gian cược bắt đầu từ 0h đến 18h mỗi ngày. Mọi lệnh đặt ngoài thời gian trên sẽ bị tịch thu</p>
                                    <p>3. Bạn tham gia trò chơi bằng đồng Zen. Zen sẽ được trừ ngay lập tức khỏi tài khoản của bạn sau khi đặt. Nếu trúng, Zen sẽ được tự động chuyển về tài khoản của bạn vào 20h cuối ngày hoặc 8h sáng ngày hôm sau.</p>
                                    <p>4. Lấy kết quả xổ số miền Bắc làm chuẩn. Có tất cả 27 giải = 27 số</p>
                                    <p>5. Tham gia nhóm <a href="https://zalo.me/g/zphlpr603" target="_blank" rel="noopener noreferrer">Đổi Zen ZENDO SHOP</a> để được hỗ trợ đổi Zen</p>
                                </div>
                                <div class="box_hide_show_des_vs">
                                    <span class="span_text_hide_vs" onclick="show_des_vs(0,this)">Ẩn bớt</span>
                                </div>
                            </div>
                            <div class="content_form_vs">
                                <form id="form_vs">
                                    <div class="box_input_form_vs">
                                        <p class="text_title_input_vs">Chọn số :</p>
                                        <div class="box_input_vs">
                                            <input type="number" name="number_vs" id="number_vs" placeholder="Nhập số">
                                            <p class="error_input_vs">Dự đoán 2 số cuối của tất cả các giải</p>
                                        </div>

                                    </div>
                                    <div class="box_input_form_vs">
                                        <p class="text_title_input_vs">Giá trị (Zen) :</p>
                                        <div class="box_input_vs">
                                            <input type="number" name="amount_zen" id="amount_zen" placeholder="Giá trị (Zen)">
                                            <p class="error_input_vs">Tối thiểu 20 Zen. Trúng ăn 3.4</p>
                                        </div>

                                    </div>
                                    <div class="box_btn_vs">
                                        <button type="submit">Đặt cược</button>
                                    </div>
                                </form>
                            </div>
                            <div class="list_vs">
                                <p class="title_your_vip">Lịch sử đặt cược</p>
                                <div class="box_his_vs">

                                    <table class="table_dq_vip">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Con số may mắn</th>
                                                <th>Zen</th>
                                                <th>Ngày cược</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($lichsu) > 0) {
                                                foreach ($lichsu as $key => $val) { ?>
                                                    <tr>
                                                        <td><?= ++$key ?></td>
                                                        <td><?= $val['number'] ?></td>
                                                        <td><?= $val['zen'] ?></td>
                                                        <td><?= date('d-m-Y H:i:s', $val['created_at']) ?></td>
                                                        <td><?php if ($val['status'] == 0) {
                                                                echo 'Chờ kết quả';
                                                            } elseif ($val['status'] == 1) {
                                                                echo 'Trúng thưởng';
                                                            } elseif ($val['status'] == 2) {
                                                                echo 'Trượt';
                                                            } ?></td>
                                                    </tr>
                                            <?php  }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>