<style type="text/css">
    .slider img {

        width: 100%;

        height: 100px;

        object-fit: cover;

        border-radius: 0 0 14px 14px;

    }



    .modal-body {

        color: #222;

    }



    .tab-modal .style_select {

        font-size: 14px;

        line-height: 2;

        color: #2c3338;

        border-color: #8c8f94;

        box-shadow: none;

        border-radius: 3px;

        padding: 0 24px 0 8px;

        min-height: 30px;

        max-width: 25rem;

        -webkit-appearance: none;

        background-size: 16px 16px;

        cursor: pointer;

        vertical-align: middle;

        border: 1px solid #8c8f94;

        background: url('<?= site_main() ?>images/muiten.svg') no-repeat;

        background-position: 94%;

    }



    .content.content-admin {

        padding: unset !important;

    }



    .main-content.tab-admin {

        max-width: 100%;

    }



    .dis_none {

        display: none;

    }



    .top_admin_tab {

        display: flex;

        gap: 10px;

        align-items: center;

        margin-bottom: 10px;

    }



    h2.title-ds-acc {

        margin-bottom: unset !important;

        padding: 15px 8px;

    }



    .top_admin_tab .active {

        background: green;

        color: #fff;

        border-radius: 5px;

    }



    .top_admin_tab a:hover {

        color: unset !important;

    }



    tr.accinfo {

        color: #fff;

    }



    .content-admin tr.accinfo {

        color: #000;

    }
</style>

<div id="main">

    <div class="content <?= (is_admin_vip()) ? 'content-admin' : 'content-user'; ?>">

        <!-- main-content -->

        <div class="main-content <?= (is_admin_vip()) ? 'tab-admin' : 'tab-user'; ?>">

            <?php

            function activeTab($pattern)

            {

                return $result = preg_match($pattern, $_SERVER['REQUEST_URI']);
            }

            ?>

            <div id="tabs">

                <ul class="ul-tab-game">



                    <li class="<?= ($this->input->get('game') == 1 || $this->input->get('game') == '') ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=1">Liên quân &nbsp;<span style="font-weight:bold;"><?= $count_lq; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 2) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=2">FreeFire &nbsp;<span style="font-weight:bold;"><?= $count_ff; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 3) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=3">PUBG &nbsp;<span style="font-weight:bold;"><?= $count_pubg; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 4) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=4">Liên minh huyền thoại &nbsp;<span style="font-weight:bold;"> <?= $count_lmht; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 5) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=5">FIFA &nbsp;<span style="font-weight:bold;"><?= $count_fifa; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 6) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=6">Tốc chiến &nbsp;<span style="font-weight:bold;"><?= $count_tc; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 7) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=7">CrossFire &nbsp;<span style="font-weight:bold;"><?= $count_cf; ?></span></a>

                    </li>

                    <li class="<?= ($this->input->get('game') == 8) ? 'active' : ''; ?>">

                        <a href="/danh-sach-tai-khoan/?game=8">Valorant &nbsp;<span style="font-weight:bold;"><?= $count_valorant; ?></span></a>

                    </li>

                </ul>

                <div class="meta-top dis-flex">

                    <div class="left-item-meta-top dis-flex">

                        <p style="margin-bottom: unset;">Sắp xếp theo</p>



                        <select class="sort-game-1 style_select" data-game="<?= $loai_game; ?>">

                            <option value="">Mặc định</option>

                            <option value="1" <?= ($this->input->get('sort') == 1) ? "selected" : ""; ?>>Đã duyệt</option>

                            <option value="2" <?= ($this->input->get('sort') == 2) ? "selected" : ""; ?>>Chờ duyệt</option>

                            <option value="3" <?= ($this->input->get('sort') == 3) ? "selected" : ""; ?>>Từ chối</option>

                            <option value="4" <?= ($this->input->get('sort') == 4) ? "selected" : ""; ?>>Đã bán</option>



                        </select>

                    </div>

                    <div class="col-xs-8 search-container dis-flex">

                        <input type="text" name="search-game" id="search-game" style="padding:6px; margin-bottom: unset;margin-top: unset;" placeholder="Tìm kiếm theo ID hoặc tên tài khoản..." value="<?= $this->input->get('search') ?>">

                        <img src="<?= site_main() ?>images/detail/search-normal.svg" alt="search-bar-game" class="cursor_pointer btn-search" data-game="<?= $loai_game ?>">

                    </div>

                </div>

                <?php if (is_admin_vip()) { ?>

                    <div class="tablenav-bottom dis-flex">

                        <div class="bulk-action">

                            <select class="sl-action style_select">

                                <option value="">Chọn hành động</option>

                                <option value="1">Duyệt</option>

                                <option value="2">Chờ duyệt</option>

                                <option value="3">Từ chối</option>

                                <option value="4">Chuyển vào thùng rác</option>

                            </select>

                            <button class="bulk-apply button_apply" type="button" data-action="">Apply</button>

                        </div>

                    </div>

                <?php } ?>

                <div id="tabs-1">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th><input type="checkbox" id="cb-select-all-1"></th>

                                <th>Sửa bài</th>

                                <th>ID</th>

                                <?php

                                if (is_admin_vip()) { ?>

                                    <th>ID User</th>
                                    <th>Trả tiền</th>

                                <?php } ?>

                                <th>Giá card</th>
                                <th>Giá ATM</th>

                                <th>Tình trạng</th>

                                <th>Ngày đăng</th>

                                <th class="wdth-20">Tên tài khoản</th>

                                <th>Mật khẩu</th>

                                <?php

                                if (is_admin_vip()) { ?>

                                    <th>Phê duyệt</th>

                                <?php } ?>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($list_acc as $key => $val) {
                                if ($val['type_account'] == 'Liên Quân Mobile' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-lien-quan/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Free Fire' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-freefire/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Pubg' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-pubg/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Liên Minh Huyền Thoại' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-lmht/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Fifa' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-fifa/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Tốc Chiến' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-tocchien/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'CF' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-cf/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } elseif ($val['type_account'] == 'Valorant' && ($val['phe_duyet'] == 2 || $val['phe_duyet'] == 3 || is_admin_vip())) {

                                    $td_edit =  '<td><a target="_bank" href="/dang-ban-acc-valorant/?edit=' . $val['id_post'] . '"> ' . $val['id_post'] . '&#9998;</a></td>';
                                } else {

                                    $td_edit =  '<td>0</td>';
                                }

                            ?>

                                <tr class="accinfo">

                                    <td><input type="checkbox" name="account" value="<?= $val['id_post'] ?>" data-id="" class="check-item" /></td>

                                    <?= $td_edit ?>

                                    <?php if (is_user_seller() && $val['status'] == 1) {

                                        echo '<td class="1">' . $val['id_post'] . '</td>';
                                    } else {

                                        echo '<td><a href="/tai-khoan-' . $val['id_post'] . '/" target="_bank"> ' . $val['id_post'] . '</a></td>';
                                    } ?>
                                    <?php if (is_admin_vip()) { ?>
                                        <td><?= $val['user_id'] ?></td>
                                        <td><input <?= ($val['status'] == 1 && $val['bank'] == 1) ? 'disabled checked' : '' ?> type="checkbox" name="check_ck" onclick="change_checked(this,<?= $val['id_post'] ?>)"></td>
                                    <?php } ?>
                                    <td><?= number_format($val['price']) ?></td>
                                    <td><?= number_format($val['price_atm']) ?></td>

                                    <td> <?php

                                            if ($val['phe_duyet'] == 1 || $val['phe_duyet'] == Null) {

                                                if ($val['status'] == 0) {

                                                    echo '<span class="spn-success">Đã Duyệt</span>';
                                                } elseif ($val['status'] == 1) {

                                                    echo '<span class="spn-warning">Đã bán</span>';

                                                    // $totalRevenue += $acc_price_atm;

                                                }
                                            } elseif ($val['phe_duyet'] == 2) {

                                                echo '<span class="spn-warning">Chờ duyệt</span>';
                                            } elseif ($val['phe_duyet'] == 3) {

                                                echo '

                                                      <span class="spn-failed">

                                                        Từ chối

                                                      </span>

                                                            <p class="myBtn show-reason" style="cursor: pointer; margin-bottom:unset;color:#31afd2;font-weight: 100;font-style: italic;" data-id="' . $val['id_post'] . '">lý do</p>

                                                        ';
                                            } ?>

                                    </td>

                                    <td><?= $val['date_posted'] ?></td>

                                    <td><?= $val['username'] ?></td>

                                    <td><?= $val['password'] ?></td>

                                    <?php if (is_admin_vip() || this_source() == 'verestino') { ?>

                                        <td class="approve_acc">

                                            <select class="xet-duyet style_select">

                                                <option value="">Hành động</option>

                                                <option value="1" <?php echo ($val['phe_duyet'] == 1) ? "selected disable" : ""; ?>>Duyệt</option>

                                                <option value="2" <?php echo ($val['phe_duyet'] == 2) ? "selected disable" : ""; ?>>Chờ duyệt</option>

                                                <option value="3" <?php echo ($val['phe_duyet'] == 3) ? "selected disable" : ""; ?>>Từ chối</option>

                                                <option value="4">Thùng rác</option>

                                            </select>

                                            <select class="dinh_gia_acc style_select dis_none">

                                                <option value="0">AAC Quảng cáo</option>

                                                <option value="1">AAC VIP</option>

                                                <option value="2">AAC Ngon</option>

                                                <option value="3">AAC Thường</option>

                                            </select>

                                            <button type="button" class="submit-acc btn btn-info" data-id="<?= $val['id_post'] ?>" data-action="" data-gia="">Submit</button>

                                            <img src="<?= site_main() ?>images/detail/export.png" alt="export" class="cursor_pointer more-detail" data-id="<?= $val['id_post'] ?>">

                                        </td>

                                    <?php

                                    }

                                    ?>

                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                    <p style="font-size: 16px;">Tổng doanh thu của bạn : <b><?= number_format($count_money); ?> VNĐ</b>

                    <p>

                    <div class="ft-manage-account " style=" justify-content: center;">

                        <?php echo $this->pagination->create_links() ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!------------------MODALS admin viết lý do tại sao acc bị từ chối-------------------------------->

<div id="myModal" class="modal tab-modal">

    <!-- Modal content -->

    <div class="modal-content">

        <div class="modal-header">

            <div class="modal-meta-left">

                <span class="close">&times;</span>

                <h2>Box phản hồi</h2>

            </div>

        </div>

        <div class="modal-body">

            <p>Nội dung</p>

            <?php

            if (is_admin_vip()) { ?>

                <textarea placeholder="nhập lý do..." class="content-reason"></textarea>

            <?php } else { ?>

                <textarea class="content-reason" disabled></textarea>

            <?php } ?>

        </div>

        <div class="modal-footer">

            <?php if (is_admin_vip()) { ?>

                <button class="cursor_pointer submit-reason btn btn-info" data-id="">Gửi ngay</button>

            <?php } ?>

        </div>

    </div>

</div>