<?php
$CI = &get_instance();
?>
<div id="main_blog">
    <div class="main_blog">
        <div class="t_detail_link">
            <a class="t_link_detail" href="/">Trang chủ</a>
            <i class=" t_icon"></i>
            <a class="t_link_detail" href="/blog/">Blog</a>
            <i class=" t_icon"></i>
            <a class="t_link_detail" href="#"><?= $name ?></a>
        </div>

        <div class="blog_header">
            <h2><?= $name ?></h2>
            <div class="count_blog mb20">
                <img class="edit_btn" src="<?= site_main() ?>images/cayrank/edit.svg" alt="edit_icon">
                <span style="font-size: 20px; padding-left: 10px;"><?= $row ?> Bài viết</span>
            </div>

            <div class="des_header">
                <p>Zendo Blog mang đến cho bạn mọi thông tin, thủ thuật, mẹo chơi game của những tựa game hàng đầu như Liên Quân, Liên Minh, Fifa, Free Fire...</p>
            </div>
        </div>

        <div class="body_blog">
            <div class="content_blog">
                <div class="box_nav_list_dm">
                    <?php
                    foreach ($count_category as $key => $val) {
                        $sql_count_blog = "SELECT id FROM baiviet WHERE chuyenmuc = '{$val['id']}'";
                        $count_blog = $CI->Account->query_sql_num($sql_count_blog);
                    ?>
                        <div class="box_dm">
                            <a href="/<?= $val['alias']?>#bai-viet">
                                <img class="icon_category" src="<?= site_main().$val['image'] ?>" alt="blog_img">
                                <p class="tit_category"><?= $val['name'] ?></p>
                                <div class="count_blog">
                                    <img class="edit_btn" src="<?= site_main() ?>images/cayrank/edit.svg" alt="edit_icon">
                                    <span style="padding-left: 10px;"><?= $count_blog ?> bài viết</span>
                                </div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="title_box" id="bai-viet"><span>BÀI VIẾT MỚI NHẤT</span></div>

                <div class="box_list_blog">
                </div>

        

            </div>
        </div>

    </div>
</div>

<script>
var uri_tam = '<?= $uri_tam ?>';
</script>