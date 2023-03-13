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
$arr_skin = arr_skin();
$arr_tuong = arr_tuong();
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
                <div class="box_fillter_mb" onclick="show_filter(this,1)">
                    <img alt="bộ lọc" src="<?= site_main() ?>images/list/filter.svg"> <span>Lọc sản phẩm</span>
                </div>

                <div class="box_ms">
                    <div class="title_search" onclick="show_gia(this,1)">
                        <span>Mã số</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_search">
                        <span>Nhập mã</span>
                        <input type="text" name="id_acc" id="id_ac" placeholder="Nhập mã số...">
                        <img onclick=search_id(this) src="<?= site_main() ?>images/list/search.svg" alt="tim kiếm">
                    </div>

                </div>
                <div class="box_price">
                    <div class="title_search" onclick="show_box_skin(this,1)">
                        <span>Trang phục</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_skin select_skin">
                        <div class="box_nav_skin">
                            <select class="select_2" name="list_skin" onchange="active_skin(this)">
                                <option>Chọn trang phục</option>
                                <?php
                                foreach ($arr_skin as $key => $val) { ?>
                                    <option value="<?= $val ?>"><?= $val ?></option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="list_active_skin" id="skin_list_active">

                        </div>

                    </div>
                </div>
                <div class="box_price">
                    <div class="title_search" onclick="show_box_skin(this,1)">
                        <span>Tướng</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_skin select_tuong">
                        <div class="box_nav_skin">
                            <select class="select_2" name="list_tuong" onchange="active_tuong(this)">
                                <option>Chọn tướng</option>
                                <?php
                                foreach ($arr_tuong as $key => $val) { ?>
                                    <option value="<?= $val ?>"><?= $val ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="list_active_skin" id="tuong_list_active">

                        </div>


                    </div>
                </div>
                <div class="box_price">
                    <div class="title_search" onclick="show_gia(this,1)">
                        <span>Mức giá</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_search" data-type="gia">
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="0" data-max="100000" id="100" class="gia_list">
                            <span>0k - 100k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="100000" data-max="200000" id="200" class="gia_list">
                            <span>100k - 200k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="200000" data-max="400000" id="400" class="gia_list">
                            <span>200k - 400k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="400000" data-max="600000" id="600" class="gia_list">
                            <span>400k - 600k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="600000" data-max="800000" id="800" class="gia_list">
                            <span>600k -800k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="800000" data-max="1000000" id="1000" class="gia_list">
                            <span>800k - 1000k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="1000000" data-max="10000000" id="1100" class="gia_list">
                            <span>Trên 1000k</span>
                        </div>
                    </div>
                </div>
                <div class="box_price">
                    <div class="title_search" onclick="show_gia(this,1)">
                        <span>Ngọc 90</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_search">
                        <div class="box_nav_price">
                            <input type="checkbox" data-ngoc="90" name="co" id="co" class="ngoc_list">
                            <span>Có</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-ngoc="1" name="khong" id="khong" class="ngoc_list">
                            <span>Không</span>
                        </div>
                    </div>
                </div>
                <div class="box_price">
                    <div class="title_search" onclick="show_gia(this,1)">
                        <span>Rank</span>
                        <img src="<?= site_main() ?>images/list/crow_top.svg" alt="xem thêm">
                    </div>
                    <div class="content_search">
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="2" name="dong" class="rank_list">
                            <span>Đồng đoàn</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="3" name="bac" class="rank_list">
                            <span>Bạc đoàn</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="4" name="vang" class="rank_list">
                            <span>Vàng đoàn</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="5" name="bachkim" class="rank_list">
                            <span>Bạch kim</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="6" name="kimcuong" class="rank_list">
                            <span>Kim cương</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="9" name="tinhanh" class="rank_list">
                            <span>Tinh anh</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="7" name="caothu" class="rank_list">
                            <span>Cao thủ</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" data-rank="8" name="thachdau" class="rank_list">
                            <span>Thách đấu</span>
                        </div>
                    </div>
                </div>
                <div class="box_close_fillter">
                    <span onclick="fitler(0)">Xóa bộ lọc</span>
                </div>



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