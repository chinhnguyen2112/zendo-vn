<div class="home_boby">
    <div class="content_body">
        <div class="z_content ">
            <div class="z_maxwith">
                <div class="z_main_content">
                    <div class="box-game-bq commom-row">
                        <div class="entry-header">
                            <div class="left-title dis-flex">
                                <div class="title_vip"></div>
                                <h2 class="font_size32 font_clor_w">NHIỆM VỤ MỖI NGÀY</h2>
                                <img class="img_title_vip" src="<?= site_main() ?>images/home/gia-re.png" alt="vé sô may mắn">
                            </div>
                            <div class="des_vs">
                                <div class="list_text_vs ">
                                    <p>1. Mỗi ngày bạn sẽ nhận được 1 nhiệm vụ ngẫu nhiên.</p>
                                    <p>2. Bạn cần làm theo hướng dẫn của nhiệm vụ để nhận được mã code phần thưởng.</p>
                                    <p>3. Sau khi có mã code phần thưởng, nhập vào ô bên dưới để nhận phần thưởng may mắn.</p>
                                    <p>4. Phần thưởng là 50 Zen hoặc 1 lượt quay acc liên quân hoặc là 1 lượt quay quân huy.</p>
                                    <p>5. Nếu bạn không sử dụng phần thưởng thì sẽ bị xóa khi hết ngày.</p>
                                </div>
                                <div class="box_hide_show_des_vs">
                                    <span class="span_text_hide_vs" onclick="show_des_vs(0,this)">Ẩn bớt</span>
                                </div>
                            </div>
                            <div class="content_form_vs">
                                <form id="form_vs">
                                    <div class="box_input_form_vs">
                                        <p class="text_title_input_vs">Nhập mã code:</p>
                                        <div class="box_input_vs">
                                            <input type="text" name="number_vs" id="number_vs" placeholder="Nhập mã code phần thưởng...">
                                            <p class="error_input_vs">(Mã code nhận được sau khi hoàn thành nhiệm vụ)</p>
                                        </div>

                                    </div>
                                    <div class="box_btn_vs">
                                        <button type="submit">Nhận thưởng</button>
                                    </div>
                                </form>
                            </div>
                            <div class="list_vs">
                                <p class="title_your_vip">Hướng dẫn nhiệm vụ</p>
                                <div class="box_his_vs">
                                <?= ($check_his['des'] != '') ? str_replace('/assets',site_main().'assets', $check_his['des']) : '' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>