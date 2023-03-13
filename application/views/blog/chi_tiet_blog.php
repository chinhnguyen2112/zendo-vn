

<style>

    #main-container {
        overflow-x: unset;

    }



    .c_menu {
        position: unset;

    }



    body {
        background-color: #ffffff;

    }

</style>

<div class="t_detail q-detail-pc">

    <div class="t_detail_link">
        <a class="t_link_detail" href="/">Trang chủ</a>
        <i class=" t_icon"></i>
        <a class="t_link_detail" href="/blog/">Blog</a>
        <?php if ($blog['chuyenmuc'] > 1) { ?>
            <i class=" t_icon"></i>
            <a class="t_link_detail" href="/<?= $chuyenmuc['alias'] ?>"><?= $chuyenmuc['name'] ?></a>
        <?php } ?>
        <i class=" t_icon"></i>
        <p class="t_link_home"><?= $blog['title'] ?></p>

    </div>

    <div class="t_detail_link_tablet">
        <a class="t_link_detail" href="/">Trang chủ</a>
        <div class="t_detail_link_icon"><i class="t_icon"></i></div>
        <a class="t_link_detail" href="/blog/">Blog</a>
        <?php if ($blog['chuyenmuc'] > 1) { ?>
            <div class="t_detail_link_icon"><i class="t_icon"></i></div>
            <a class="t_link_detail" href="/<?= $chuyenmuc['alias'] ?>"><?= $chuyenmuc['name'] ?></a>
        <?php } ?>
        <div class="t_detail_link_icon"><i class="t_icon"></i></div>
        <p class="t_link_home"><?= $blog['title'] ?></p>

    </div>

</div>

<div class="t_body_detail ">

    <div class="t_detail_left ">
        <div class="t_group_title">
            <h1 class="t_title_detail"><?= $blog['title'] ?></h1>
            <div class="t_detail_info">


                <div class="t_info_icon icon_time"><img src="/images/blog/t_icontime.svg" alt="image" width="18" height="18" class="t_info_icon lazyload"></div>
                <p class="t_info_time"><?= date('d-m-Y', $blog['created_at']) ?></p>
            </div>
        </div>

    </div>

    <div class="t_detail_right t-detail-tablet t_fix">
        <div class="t_socical_group">
            <p class="t_socical_title">CHIA SẺ BÀI VIẾT</p>
            <div class="t_socical_item">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= base_url() . substr($_SERVER['REQUEST_URI'], 1); ?>" target="_blank" class="t_icon_socical"></a>
                <a href="http://www.linkedin.com/share?url=<?= base_url() . substr($_SERVER['REQUEST_URI'], 1); ?>" target="_blank" class="t_icon_socical"></a>
                <a href="http://www.twitter.com/share?url=<?= base_url() . substr($_SERVER['REQUEST_URI'], 1); ?>" target="_blank" class="t_icon_socical"></a>
            </div>
        </div>

    </div>

</div>

<div class="t_body_detail t_view_tablet ">



    <!-- phần mục lục -->

    <div class="ml t_detail_right" id="mucluc">
        <div id="muc-luc-content-thu" class="t_appendix_group">
            <div class="t_socical_title" id="tieudemucluc" style="text-align:center;">
            </div>
            <div class="t_appendix_content">
                <ul id="content-mucluc"> </ul>
            </div>
        </div>

    </div>

    <div class="content_blog t_detail_left" id="t_detail_content">
        <div class="q-content_suggest">
            <div class="content_suggest_v2"><?= $blog['sapo'] ?></div>
        </div>
        <div name="content-thu t_detail_content" id="content-thu">
            <?php
            $replace_http =  $blog['content'];
            $replace_http = str_replace('/assets',site_main().'assets',$replace_http);
            echo str_replace('font-size:14px', '', $replace_http);
            ?>
        </div>
        <!-- hết phần mục lục -->

    </div>

    <div class="t_dasher_gr">
        <span class="t_dasher"></span>

    </div>





    <div class="t_dasher_gr">
        <span class="t_dasher"></span>

    </div>

</div>

<script type="text/javascript">

    var urlHref = "<?= base_url() . substr($_SERVER['REQUEST_URI'], 1); ?>";

</script>