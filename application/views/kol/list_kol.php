<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: unset;
        border: none;
        font-size: 15px;

        font-weight: 500;

    }


    .select2-dropdown {
        background-color: #1f2334 !IMPORTANT;

        border: 1px solid #6ea70c !IMPORTANT;

    }


    .select2-search__field {

        background: none;

    }


    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #fff;

        line-height: 36px;

    }


    .select2-container--default .select2-results__option--highlighted[aria-selected] {

        background-color: #5c90d2;

    }


    .select2-container--default .select2-results__option[aria-selected=true] {

        background-color: unset;

    }


    .select2-container--default .select2-selection--single {
        background-color: unset;
        height: 40px;

        border: 1px solid #8ac02c;

    }
</style>

<?php

$CI = &get_instance();

$arr_cate = $CI->Account->query_sql("SELECT * FROM category ORDER BY name");

?>

<div class="content_list">
    <div class="container_list">
        <div class="breadcrump">
            <div class="box_count_rsl">
                <span>250 kết quả</span>
            </div>
            <div class="box_xx_list">
                <select name="xap_xep" id="xap_xep" onchange="order_rsl(this)">
                    <option value="0">Sắp xếp</option>
                    <option value="1">Giá từ thấp tới cao</option>
                    <option value="2">Giá từ cao tới thấp</option>
                </select>
            </div>
        </div>
        <div class="body_list">
            <div class="box_fillter">
                <form id="search_kol" method="POST" onsubmit="return false">
                    <div class="box_fillter_mb" onclick="show_filter(this,1)">
                        <img alt="bộ lọc" src="<?= site_main() ?>images/list/filter.svg"> <span>Tìm kiếm</span>
                    </div>
                    <div class="box_ms">
                        <div class="title_search" onclick="show_gia(this,1)">
                            <span>Tên idol</span>
                            <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                        </div>
                        <div class="content_search">
                            <span>Tên idol</span>
                            <input type="text" name="name" id="name" placeholder="Nhập tên idol...">
                        </div>
                    </div>
                    <div class="box_price">
                        <div class="title_search" onclick="show_box_skin(this,1)">
                            <span>Loại game</span>
                            <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                        </div>
                        <div class="content_skin select_skin">
                            <div class="box_nav_skin">
                                <select class="select_2" name="list_skin" onchange="active_skin(this)">
                                    <option>Chọn loại game</option>
                                    <?php
                                    foreach ($arr_cate as $key => $val) { ?>
                                        <option value="<?= $val['id'] ?>" data-name="<?= $val['name'] ?>"><?= $val['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="list_active_skin" id="skin_list_active">

                            </div>
                        </div>
                    </div>
                    <div class="box_price">
                        <div class="title_search" onclick="show_gia(this,1)">
                            <span>Mức giá</span>
                            <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                        </div>
                        <div class="content_search" data-type="gia">
                            <input type="number" name="price_min" value="0" id="price_min" class="gia_list" placeholder="Giá tối thiểu">
                            <input type="number" name="price_max" id="price_max" class="gia_list" placeholder="Giá tối đa">
                        </div>
                    </div>
                    <div class="box_price">
                        <div class="title_search" onclick="show_gia(this,1)">
                            <span>Giới tính</span>
                            <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                        </div>
                        <div class="content_search">
                            <div class="box_nav_price">
                                <input type="checkbox" value="1" name="sex" class="ngoc_list">
                                <span>Nam</span>
                            </div>
                            <div class="box_nav_price">
                                <input type="checkbox" value="2" name="sex" class="ngoc_list">
                                <span>Nữ</span>
                            </div>
                            <div class="box_nav_price">
                                <input type="checkbox" value="3" name="sex" class="ngoc_list">
                                <span>Khác</span>
                            </div>
                        </div>
                    </div>
                    <div class="box_close_fillter">
                        <span class="search_kol" onclick="search_kol()">Tìm kiếm</span>
                    </div>
                    <div class="box_close_fillter">
                        <span onclick="fitler(0)">Xóa bộ lọc</span>
                    </div>

                </form>
            </div>
            <div class="box_list_content">
                <div class="list_result">
                </div>
                <!--<div class="pagenation"></div>-->
                <div id="loading">
                    <img src="<?= site_main() ?>images/vqlq/load.gif" alt="loading" title="loading" />
                </div>
            </div>

        </div>

    </div>

</div>