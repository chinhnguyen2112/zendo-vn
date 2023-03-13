<div class="content_list">
    <div class="container_list">
        <div class="left_content">
            <input type="text" id="id_kol" value="<?= $kol['id'] ?>" hidden>
            <img class="avt_kol" src="/<?= $kol['avatar'] ?>" onerror="this.onerror=null;this.src='/images/avt.png';" alt="avatar">
            <p class="name_idol"><?= $kol['name'] ?></p>
            <p class="data_lh">Thông tin liên hệ</p>
            <div class="list_img_lh">
                <?php
                if ($kol['facebook'] != '') {
                    echo '<a alt="Facebook" target="_blank" href="' . $kol['facebook'] . '"><img src="/images/home/fb.svg" alt="Facebook"></a>';
                }
                if ($kol['youtube'] != '') {
                    echo '<a alt="Youtube" target="_blank" href="' . $kol['youtube'] . '"><img src="/images/home/yt.svg" alt="Youtube"></a>';
                }
                if ($kol['tiktok'] != '') {
                    echo '<a alt="Tiktok" target="_blank" href="' . $kol['tiktok'] . '"><img src="/images/home/tt.svg" alt="Tiktok"></a>';
                }
                if ($kol['instagram'] != '') {
                    echo '<a alt="Instagram" target="_blank" href="' . $kol['instagram'] . '"><img src="/images/home/insta.svg" alt="Instagram"></a>';
                }
                ?>
            </div>
            <p class="date_created">Ngày tham gia: <span class="time_created"><?= date('d/m/Y', $kol['created_at']) ?></span></p>
            <p class="price_thue"><?= number_format($kol['price']) ?> đ/h</p>
            <div class="box_btn_kol">
                <p class="chat_now" data-id="<?= $kol['id'] ?>">Chát ngay</p>
                <p class="thue_user">Thuê ngay</p>
            </div>
        </div>
        <div class="body_list">
            <div class="box_cate">
                <p class="title_cate">Các loại game</p>
                <div class="list_cate">
                    <?php $CI = &get_instance();
                    if ($kol['cate'] != '') {
                        $cate = explode(',', $kol['cate']);
                        foreach ($cate as $val) {
                            $this_cate = $CI->Account->query_sql_row("SELECT * FROM category WHERE id = $val");
                            echo '<p class="this_cate">' . $this_cate['name'] . '</p>';
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="box_thongtin">
                <p class="title_cate">Giới thiệu</p>
                <p class="intro_user"><?= $kol['text_intro'] ?></p>
                <div class="list_img_detail">
                    <?php
                    if ($kol['list_img'] != '') {
                        $list_img = explode(',', $kol['list_img']);
                        foreach ($list_img as $val) {
                            echo '<img src="/' . $val . '" alt="mạng xã hội">';
                        }
                    }
                    ?>
                </div>
                <div class="p_des">
                    <p><?= str_replace("\n", "</p><p>", nl2br($kol['des'])); ?> </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup_detail">
    <div class="main_popup_detail">
        <div class="box_img_show">
            <img src="/images/home/close.svg" alt="đóng" class="close_popup">
            <img src="/upload/kol/6386/avatar/6386-avatar-20221013180500.jpg" alt="mạng xã hội" class="img_full_show">
        </div>
    </div>
</div>