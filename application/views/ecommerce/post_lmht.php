<?php

/**

 * Lấy value Rank: 

 * @param : $ColumnTable là cột trong bảng `posts`

 * @param : $val là giá trị của value trong cặp thẻ <select><option>

 * mục đích để xem giá trị của $val truyền vào trong DisInfoAcc() có.

 * 

 * */
function DisInfoAcc($acc='',$ColumnTable, $val)
{
    echo (isset($acc[$ColumnTable]) && $acc[$ColumnTable] == $val) ? "selected" : "";
}
?><div id="main">
    <div class="content content-ban-acc">
        <div class="main-content2">
            <div class="block block-themed" style="background: none;">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active"> <a href="#lmht">Đăng LMHT</a> </li>
                </ul>
                <div class="block-content tab-content wrapper-form borderra_10px">
                    <div class="tab-pane active" id="lmht">
                        <form id="data-lmht" class="common-form-acc dis-flex flex-dir-col" method="post" enctype="multipart/form-data" class="form-horizontal push-5-t" novalidate="novalidate"> <input type="hidden" name="type_account" value="Liên Minh Huyền Thoại"> <?php if (isset($type_action) && $type_action == 'update') { ?> <input type="hidden" name="type_action" value="update"> <input type="hidden" name="id_post" value="<?= $acc['id_post']; ?>"> <?php } ?> <div class="user_pass_cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="username" class="font-size17">Tên đăng nhập <span style="color:#ff0000">*</span></label> <input class="form-control" type="text" id="username" name="username" placeholder="Tên đăng nhập Garena" value="<?= isset($acc['username']) ? $acc['username'] : ""; ?>">
                                        <p class="error err_username mg_bottom_uset"></p>
                                    </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="password" class="font-size17">Mật khẩu <span style="color:#ff0000">*</span></label> <input class="form-control" type="text" id="password" name="password" placeholder="Nhap Pass" value="<?= isset($acc['password']) ? $acc['password'] : ""; ?>">
                                        <p class="error err_password mg_bottom_uset"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row">
                                <div class="col-xs-12"> <label for="price" class="font-size17">Giá mong muốn <span style="color:#ff0000">*</span></label> <input class="form-control" type="number" id="price" name="price" placeholder="" value="<?= isset($acc['price_atm']) ? $acc['price_atm'] : ""; ?>">
                                    <p class="error err_price mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="skin_tuong_cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="champs_count" class="font-size17">Số tướng</label> <input class="form-control" type="champs_count" id="champs_count" name="champs_count" placeholder="" value="<?= isset($acc['champs_count']) ? $acc['champs_count'] : ""; ?>"> </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="champs_count" class="font-size17">Số Skin</label> <input class="form-control" type="text" id="skins_count" name="skins_count" placeholder="" value="<?= isset($acc['skins_count']) ? $acc['skins_count'] : ""; ?>"> </div>
                                </div>
                            </div>
                            <div class="rank-khung-cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="champs_count" class="font-size17">Rank</label> <select class="form-control" name="rank">
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 0); ?> value="0">Chưa Rank</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 1); ?> value="1">Sắt</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 2); ?> value="2">Đồng</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 3); ?> value="3">Bạc</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 4); ?> value="4">Vàng</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 5); ?> value="5">Bạch Kim</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 6); ?> value="6">Kim Cương</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 7); ?> value="7">Cao Thủ</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 8); ?> value="8">Đại cao thủ</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 9); ?> value="9">Thách Đấu</option>
                                        </select> </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form_uset_padd"> <label for="frame" class="font-size17">Khung</label> <select class="form-control" name="frame">
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 0); ?> value="0">Không Khung</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 1); ?> value="1">Khung Sắt</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 2); ?> value="2">Khung Bạc</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 3); ?> value="3">Khung Vàng</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 4); ?> value="4">Khung Bạch Kim</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 5); ?> value="5">Khung Kim Cương</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 6); ?> value="6">Khung Thách Đấu</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 7); ?> value="7">Khung Cao Thủ</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 8); ?> value="8">Khung Đại Cao Thủ</option>
                                            <option <?php DisInfoAcc((isset($acc) ? $acc : ''),'frame', 9); ?> value="9">Khung Thách Đấu</option>
                                        </select> </div>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row row2"> <label class="col-xs-12 font-size17" for="thumb">Ảnh minh họa <b data-toggle="tooltip" data-placement="right" title="Ảnh hiện ở trang chủ"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
                                <div class="col-xs-12"> <input class="currency form-control" type="file" name="thumb" accept="image/jpeg" style="display: block;" />
                                    <p class="error err_thumb mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row row2"> <label class="col-xs-12 font-size17" for="gem">Ảnh thông tin<b data-toggle="tooltip" data-placement="right" title="Mỗi ảnh sẽ là một bảng ngọc, có thể up nhiều ảnh"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
                                <div class="col-xs-12"> <input class="currency form-control" type="file" name="gem[]" accept="image/jpeg" multiple style="display: block;" />
                                    <p class="error err_gem mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row"> <label class="col-xs-12 font-size17" for="note">Ghi chú <b data-toggle="tooltip" data-placement="right" title="Hiển thị ở trang chủ khi để chuột vào"><i class="fa fa-question-circle"></i></b></label>
                                <div class="col-xs-12"> <textarea class="form-control" id="note" name="note" rows="4" placeholder="Enter để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= isset($acc['note']) ? $acc['note'] : ""; ?></textarea> </div>
                            </div>
                            <div class="col-xs-12 group-form mg_bottom_10 row"><label for="source">Loại Nick</label> <select class="form-control" name="source" id="source">
                                    <option value="0" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 0); ?>> Liên Minh Huyền Thoại Việt </option>
                                    <option value="1" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 1); ?>> Liên Minh Huyền Thoại Hàn Quốc </option>
                                    <option value="2" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 2); ?>> Liên Minh Huyền Thoại NA </option>
                                    <option value="3" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 3); ?>> Liên Minh Huyền Thoại PBE </option>
                                </select> </div>
                            <div class="group-form mg_bottom_10 row">
                                <div class="col-xs-10"> <button class="btn btn-sm btn-success" id="submit" data-action="<?= isset($type_action) ? $type_action : ""; ?>"><?= isset($type_action) ? "Cập nhật" : "Đăng bán"; ?></button> </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>