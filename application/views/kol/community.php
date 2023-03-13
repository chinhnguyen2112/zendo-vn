<div class="content_page">
    <div class="body_content">
        <div class="left_page">
            <p class="title_box">Danh sách người chơi</p>
            <div class="list_user">
                <?php
                foreach ($list_user as $val) { ?>
                    <div class="this_user_list">
                        <img src="/<?= ($val['avatar'] != null) ? $val['avatar'] : 'images/avt.png' ?>" alt="<?= $val['name'] ?>">
                        <div class="detail_user">
                            <p class="name_user"><?= $val['name'] ?></p>
                            <div class="list_box_user" data-id="<?= $val['id'] ?>">
                                <p class="btn_user">Thêm bạn bè</p>
                                <p class="btn_user chat_user">Nhắn tin</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <p class="load_more">Xem thêm</p>
        </div>
        <div class="center_page">
            <p class="title_box">Danh sách Playdoul</p>
            <div class="list_kol">
                <?php for ($i = 0; $i < 50; $i++) { ?>
                    <div class="box_list_danhmuc">
                        <a href="/idol-6386/">
                            <div class="box_detail_danhmuc">
                                <img src="/upload/kol/6386/avatar/6386-avatar-20221013180500.jpg" alt="chi tiết idol">
                                <p class="num_count">1.234 đ/giờ</p>
                            </div>
                            <p class="name">Chỉnh nè</p>
                            <p class="intro">OFF Nghỉ ngơi ăn sashimi rùi 🍣</p>
                            <div class="box_data_detail">
                                <div class="list_cate">
                                    <img src="/images/home/icon_lq.png" alt="Liên Quân Mobile"><img src="/images/home/icon_pubg.png" alt="Pubg Mobile"><img src="/images/home/icon_pubg.png" alt="Pubg PC">
                                </div>
                                <div class="list_star">
                                    <img src="/images/list/star.png" atl="đánh giá sao">
                                    <p class="p_avg_star">0</p>
                                    <p class="p_count_amount">(0)</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <a class="show_all" href="/danh-sach-idol/">Xem tất cả</a>
        </div>
        <div class="right_page">
            <p class="title_box">Danh sách bạn bè</p>
            <div class="list_user">
                <?php if ($my_friend == null) {
                    echo '<p class="none_data" style="text-alight:center">Chưa có bạn bè</p>';
                } else {
                    foreach ($my_friend as $val) { ?>
                        <div class="this_user_list">
                            <img src="/<?= ($val['avatar'] != null) ? $val['avatar'] : 'images/avt.png' ?>" alt="<?= $val['name'] ?>">
                            <div class="detail_user">
                                <p class="name_user"><?= $val['name'] ?></p>
                                <div class="list_box_user" data-id="<?= $val['id'] ?>">
                                    <p class="btn_user">Xóa bạn bè</p>
                                    <p class="btn_user chat_user">Nhắn tin</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <p class="load_more">Xem thêm</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>