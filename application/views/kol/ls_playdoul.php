<style>
    .list_atm {
        margin: 20px auto;
        padding: 20px;
        background: #bfd7f5;
        width: max-content;
        border-radius: 10px;
    }

    .none_page {
        display: none;
    }

    body,
    html {
        height: 100%;
        position: relative;
    }

    .main_content {
        background: #1f2334;
    }

    .list_buy {
        overflow: auto;
        max-height: 800px;
    }

    footer {
        width: 100%;
    }

    .content.content-boxed {
        min-height: 500px;
    }

    .active {
        border-top: none;
    }

    .main_content a {
        color: #fff;
    }

    .bg-info {
        background-color: #70b9eb;
    }

    a:focus,
    a:hover {
        color: #23527c;
        text-decoration: underline;
    }

    .btn_kol {
        background: red;
        border-radius: 5px;
        margin: 0 5px;
        padding: 2px 5px;
        cursor: pointer;
    }

    .btn_ok {
        background: #90c83c;
    }
</style>

<div class="main_content">
    <div class="content content-boxed">
        <div class=" block-themed">
            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                <li class="li_ls active" data-page="buy">
                    <a href="#">Lịch sử Playdoul</a>
                </li>
            </ul>
            <div class="block-content tab-content" style="padding-top: 0px;">
                <div class="tab-pane active" id="buy">
                    <div style="display: block;    overflow: auto;" class="list_buy">
                        <?php if ($list != null) { ?>
                            <table class="table_cash">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <?php if (is_playdoul()) { ?><th>Người thuê</th><?php } ?>
                                        <th>Playdoul</th>
                                        <th>Giá thuê</th>
                                        <th>Giờ thuê</th>
                                        <th>Ngày thuê</th>
                                        <th>Trạng thái</th>
                                        <?php if (is_playdoul()) { ?><th>Hành động</th><?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $key => $val) { ?>
                                        <tr>
                                            <td class="text-center"><?= ++$key ?></td>
                                            <?php if (is_playdoul()) { ?><td><?= $val['name'] ?></td><?php } ?>
                                            <td><a href="/idol-<?= $val['id_kol'] ?>/"><?= (is_playdoul()) ? $_SESSION['user']['name'] : $val['name'] ?></a></td>
                                            <td><?= $val['price'] ?></td>
                                            <td><?= $val['hours'] ?></td>
                                            <td><?= date('d-m-Y H:i:s', $val['created_at']) ?></td>
                                            <td><?php if ($val['status'] == 0) {
                                                    echo "Chờ duyệt";
                                                } else if ($val['status'] == 1) {
                                                    echo "Thành công";
                                                } else if ($val['status'] == 2) {
                                                    echo "Từ chối";
                                                } ?></td>
                                            <?php if (is_playdoul()) { ?><td><?php
                                                                                if ($val['status'] == 0 && $val['id_kol'] == $_SESSION['user']['id']) {
                                                                                    echo '<span class="btn_kol btn_ok" onclick="pass_yc(this,' . $val['id'] . ')">Chấp nhận</span><span class="btn_kol" onclick="fail_yc(this,' . $val['id'] . ')">Từ chối</span>';
                                                                                }  ?></td><?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <p class="content-mini content-mini-full bg-info text-white">Lịch sử chơi trống.</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>