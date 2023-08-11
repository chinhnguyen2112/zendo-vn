<div class="content_page">
    <div class="body_content">
        <div class="left_page">
            <p class="title_box">Danh sách người chơi</p>
            <div class="list_user list_user_left">
                <?php if ($my_friend == null) {
                    echo '<p class="no_data" >Danh sách trống</p>';
                } else {
                    foreach ($list_user as $val) { ?>
                        <div class="this_user_list">
                            <img src="/<?= ($val['avatar'] != null) ? $val['avatar'] : 'images/avt.png' ?>" alt="<?= $val['name'] ?>">
                            <div class="detail_user">
                                <p class="name_user"><?= $val['name'] ?></p>
                                <div class="list_box_user" data-id="<?= $val['id'] ?>">
                                    <p onclick="check_thaotac(this,'<?= $val['id'] ?>','add')" class="btn_user">Thêm bạn bè</p>
                                    <a class="btn_user chat_user" href="/message?user=<?= $val['id'] ?>">Nhắn tin</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
            <p class="load_more" onclick="show_friend(this,1)">Xem thêm</p>
        </div>
        <div class="center_page">
            <p class="title_box">Danh sách Playdoul</p>
            <div class="list_kol">
                <?php $CI = get_instance();
                foreach ($list_kol as $val) {
                    $list_img_cate = '';
                    if ($val['cate'] != '') {
                        $arr = explode(',', $val['cate']);
                        $i = "";
                        foreach ($arr as $key2 =>  $val2) {
                            if ($key2 < 4) {
                                $cate = $CI->Account->query_sql_row("SELECT * FROM category WHERE id = $val2 ");
                                $list_img_cate .= '<img src="/' . $cate['image'] . '" alt="' . $cate['name'] . '">';
                            } else {
                                $i = '<p class="hide_cate">+' . ($key2 - 3) . '</p>';
                            }
                        }
                    } ?>
                    <div class="box_list_danhmuc">
                        <a href="/idol-6386/">
                            <div class="box_detail_danhmuc">
                                <img src="/<?= $val['avatar'] ?>" alt="<?= $val['name'] ?>">
                                <p class="num_count"><?= number_format($val["price"], 0, '.', '.') ?> đ/giờ</p>
                            </div>
                            <p class="name"><?= $val['name'] ?></p>
                            <p class="intro"><?= $val['text_intro'] ?></p>
                            <div class="box_data_detail">
                                <div class="list_cate">
                                    <?= $list_img_cate . $i ?>
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
            <?php if ($list_kol == null) {
                echo '<p class="no_data">Danh sách trống.</p>';
            } else { ?><a class="show_all" href="/danh-sach-idol/">Xem tất cả</a>
            <?php } ?>
        </div>
        <div class="right_page">
            <p class="title_box">Danh sách bạn bè</p>
            <div class="list_user list_user_right">
                <?php if ($my_friend == null) {
                    echo '<p class="no_data" >Chưa có bạn bè</p>';
                } else {
                    foreach ($my_friend as $val) {
                        if ($val['type_fr'] == 1) {
                            $type = 'del';
                        } elseif ($val['type_fr'] == 0) {
                            $type = 'ok';
                        } ?>
                        <div class="this_user_list">
                            <img src="/<?= ($val['avatar'] != null) ? $val['avatar'] : 'images/avt.png' ?>" alt="<?= $val['name'] ?>">
                            <div class="detail_user">
                                <p class="name_user"><?= $val['name'] ?></p>
                                <div class="list_box_user" data-id="<?= $val['id'] ?>">
                                    <p class="btn_user" onclick="check_thaotac(this,'<?= $val['id'] ?>','del')">Xóa bạn bè</p>
                                    <a class="btn_user chat_user" href="/message?user=<?= $val['id'] ?>">Nhắn tin</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <p class="load_more" onclick="show_friend(this,2)">Xem thêm</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>