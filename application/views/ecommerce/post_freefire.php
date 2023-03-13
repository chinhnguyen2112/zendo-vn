<?php

/** 
 * * Lấy value Rank:  * @param : $ColumnTable là cột trong bảng `posts` 
 * * @param : $val là giá trị của value trong cặp thẻ <select><option> 
 * * mục đích để xem giá trị của $val truyền vào trong DisInfoAcc() có. *  
 **/
function DisInfoAcc($acc='',$ColumnTable, $val)
{
    echo (isset($acc[$ColumnTable]) && $acc[$ColumnTable] == $val) ? "selected" : "";
} ?><div id="main">
    <div class="content content-ban-acc">
        <div class="main-content2">
            <div class="block block-themed" style="background: none;">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                    <li class="active"> <a href="#lmht">Đăng FreeFire</a> </li>
                </ul>
                <div class="block-content tab-content wrapper-form borderra_10px">
                    <div class="tab-pane active" id="lmht">
                        <form id="data-freefire" class="common-form-acc dis-flex flex-dir-col" method="post" enctype="multipart/form-data" class="form-horizontal push-5-t" novalidate="novalidate"> <input type="hidden" name="type_account" value="Free Fire"> <?php if (isset($type_action) && $type_action == 'update') { ?> <input type="hidden" name="type_action" value="update"> <input type="hidden" name="id_post" value="<?= $acc['id_post']; ?>"> <?php } ?> <div class="user_pass_cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-username"> <label for="username" class="font-size17">Tên đăng nhập <span style="color:#ff0000">*</span></label> <input class="form-control" type="text" id="username" name="username" placeholder="Tên đăng nhập Garena" value="<?= isset($acc['username']) ? $acc['username'] : ""; ?>">
                                        <p class="error err_username mg_bottom_uset"></p>
                                    </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-pass"> <label for="password" class="font-size17">Mật khẩu <span style="color:#ff0000">*</span></label> <input class="form-control" type="text" id="password" name="password" placeholder="Nhap Pass" value="<?= isset($acc['password']) ? $acc['password'] : ""; ?>">
                                        <p class="error err_password mg_bottom_uset"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row">
                                <div class="col-xs-12"> <label for="price" class="font-size17">Giá mong muốn <span style="color:#ff0000">*</span></label> <input class="form-control" type="text" id="price" name="price" placeholder="" value="<?= isset($acc['price_atm']) ? $acc['price_atm'] : ""; ?>">
                                    <p class="error err_price mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="rank-khung-cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-pet"> <label for="have_pet" class="font-size17">Pet</label> <select class="form-control" name="pet">
                                            <option value="1" <?php DisInfoAcc((isset($acc) ? $acc : ''),'pet', 1); ?>>Có</option>
                                            <option value="0" <?php DisInfoAcc((isset($acc) ? $acc : ''),'pet', 0); ?>>Không</option>
                                        </select> </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-type-acc"> <label for="source" class="font-size17">Đăng ký</label> <select class="form-control" name="source" id="source">
                                            <option value="" disabled>Mời chọn</option>
                                            <option value="0" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 0); ?>>Facebook</option>
                                            <option value="1" <?php DisInfoAcc((isset($acc) ? $acc : ''),'source', 1); ?>>Vkontakate</option>
                                        </select> </div>
                                </div>
                            </div>
                            <div class="rank-khung-cont dis-flex">
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-rank"> <label for="champs_count" class="font-size17">Rank</label> <select class="form-control style_select" name="rank">
                                            <option value="0" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 0); ?>>Chưa Rank</option>
                                            <option value="1" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 1); ?>>Chưa xác định</option>
                                            <option value="2" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 2); ?>>Đồng</option>
                                            <option value="3" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 3); ?>>Bạc</option>
                                            <option value="4" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 4); ?>>Vàng</option>
                                            <option value="5" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 5); ?>>Bạch Kim</option>
                                            <option value="6" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 6); ?>>Kim Cương</option>
                                            <option value="7" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 7); ?>>Cao Thủ</option>
                                            <option value="8" <?php DisInfoAcc((isset($acc) ? $acc : ''),'rank', 8); ?>>Thách Đấu</option>
                                        </select> </div>
                                </div>
                                <div class="group-form mg_bottom_10 row col-xs-6">
                                    <div class="col-xs-12 form-code2fa"> <label for="password" class="font-size17">Code 2fa</label> <input class="form-control" type="text" id="code_2fa" name="code_2fa" placeholder="Nhập Code 2fa" value="<?= isset($acc['2fa']) ? $acc['2fa'] : ""; ?>"> </div>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row row2"> <label class="col-xs-10 font-size17" for="thumb">Ảnh minh họa <b data-toggle="tooltip" data-placement="right" title="Ảnh hiện ở trang chủ"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
                                <div class="col-xs-12"> <input class="currency form-control" type="file" name="thumb" accept="image/jpeg" style="display: block;" />
                                    <p class="error err_thumb mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row row2"> <label class="col-xs-10 font-size17" for="gem">Ảnh thông tin<b data-toggle="tooltip" data-placement="right" title="Mỗi ảnh sẽ là một bảng ngọc, có thể up nhiều ảnh"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
                                <div class="col-xs-12"> <input class="currency form-control" type="file" name="gem[]" accept="image/jpeg" multiple style="display: block;" />
                                    <p class="error err_gem mg_bottom_uset"></p>
                                </div>
                            </div>
                            <div class="group-form mg_bottom_10 row"> <label class="col-xs-10 font-size17" for="note">Ghi chú <b data-toggle="tooltip" data-placement="right" title="Hiển thị ở trang chủ khi để chuột vào"><i class="fa fa-question-circle"></i></b></label>
                                <div class="col-xs-12"> <textarea class="form-control" id="note" name="note" rows="4" placeholder="Enter để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= isset($acc['note']) ? $acc['note'] : ""; ?></textarea> </div>
                            </div>
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