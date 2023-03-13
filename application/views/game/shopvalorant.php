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
                    <div class="title_search" onclick="show_gia_ff(this,1)">
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
                    <div class="title_search" onclick="show_gia_ff(this,1)">
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
                            <span>600k - 800k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="800000" data-max="1000000" id="1000" class="gia_list">
                            <span>800k - 1000k</span>
                        </div>
                        <div class="box_nav_price">
                            <input type="checkbox" name="gia" data-min="1000000" data-max="100000000" id="1100" class="gia_list">
                            <span>Trên 1000k</span>
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