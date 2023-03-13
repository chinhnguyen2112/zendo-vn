<style>
    * {
        font-family: "Poppins", sans-serif;
    }

    .white_text {
        border-radius: 5px;
        width: max-content;
        height: 100%;
        border: none;
        background: linear-gradient(95.83deg, #8AC02C 68.93%, #398100 113.08%);
        color: #fff;
    }

    .box_search_forrm {
        border: 1px solid #ddd;
        margin: 10px auto;
        padding: 10px;
        max-width: 100%;
        width: max-content;
    }

    .box_search_forrm p {
        text-align: center;
        font-size: 25px;
    }

    .box_search_forrm input,
    .box_search_forrm select {
        width: calc((100% - 100px)/5);
        height: 35px;
        margin-bottom: 5px;
    }

    input:focus {
        border: 1px solid;
    }

    .box_search_forrm button {
        border-radius: 5px;
        width: 80px;
        height: 35px;
        border: none;
        background: linear-gradient(95.83deg, #8AC02C 68.93%, #398100 113.08%);
        color: #fff;
    }


    .change_content_ul {
        display: flex;
        justify-content: space-between;
        padding: 0;
    }

    .change_content_li {
        position: relative;
        text-align: center;
        background: #844fc1;
        width: 100%;
        height: 60px;
        font-weight: 700;
        font-size: 18px;
        line-height: 29px;
        text-transform: uppercase;
        color: #ffffff;
        justify-content: center;
        display: flex;
        align-items: center;
    }

    .change_content_li:hover {
        cursor: pointer;
        background: #ff2b2b;
    }

    .active:before {
        content: "";
        width: 100%;
        position: absolute;
        top: 0;
        background: red;
        height: 5px;
    }

    .edit_job a,
    .edit_job {
        background: #6fc700;
        padding: 3px 5px;
        color: #fff !important;
        cursor: pointer;
        text-decoration: auto !important;
    }

    .del_job,
    .delete_job,
    .del_list {
        background: red;
        padding: 3px 5px;
        color: #fff;
        cursor: pointer;
    }

    .link_add a {
        background: #6fc700;
        padding: 3px 5px;
        color: #fff;
        cursor: pointer;
    }

    .input-group select,
    .input-group input {
        width: 100%;
        height: 100%;
        border: 1px solid #ccc !important;
    }

    @media only screen and (max-width: 540px) {

        .box_search_forrm input,
        .box_search_forrm select {
            width: 100%;
        }

        .change_content_li {
            /* width: 107.67px; */
            height: 40px;
            font-size: 12px;
            line-height: 18px;
            font-weight: 400;
        }

        .change_content_li:last-child {
            margin-right: 0;
        }

        .card .card-body {
            padding: 10px;
        }
    }

    @media only screen and (max-width: 375px) {
        .change_content_li {
            font-size: 10px;
        }
    }
</style>
<?php $CI = &get_instance();  ?>
<div class="change_content">
    <ul class="change_content_ul">
        <li class="change_content_li" val-active="1">Danh sách acc</li>
    </ul>
    <div class="main_change">
        <div class="doing">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row flex_center">
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Mã số" id="id" name="id" value="<?= $id ?>">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <input class="form-control" placeholder="Tên tài khoản" id="name" name="name" value="<?= $name ?>">
                                </div>
                            </div>
                            <span class="input-group-btn mt7"> <button class="btn btn-default white_text" type="button" onclick="fitler();"><i class="si si-magnifier"></i>Tìm kiếm</button> </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">ID</th>
                                        <th>Username/password</th>
                                        <th>Game</th>
                                        <th>Giá bán</th>
                                        <th>Ngày đăng</th>
                                        <th>Người đăng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $key  => $val) {
                                        $type_account = 'post_lq';
                                        if ($val['type_account'] == 'Free Fire') {
                                            $type_account = 'post_freefire';
                                        } elseif ($val['type_account'] == 'Liên Minh Huyền Thoại') {
                                            $type_account = 'post_lmht';
                                        } elseif ($val['type_account'] == 'Tốc Chiến') {
                                            $type_account = 'post_lmtc';
                                        } elseif ($val['type_account'] == 'Pubg') {
                                            $type_account = 'post_pubg';
                                        } elseif ($val['type_account'] == 'Fifa') {
                                            $type_account = 'post_fifa';
                                        } elseif ($val['type_account'] == 'CF') {
                                            $type_account = 'post_cf';
                                        } elseif ($val['type_account'] == 'Valorant') {
                                            $type_account = 'post_valorant';
                                        }
                                    ?>
                                        <tr>
                                            <td><a href="<?= site_main(); ?>tai-khoan-<?= $val['id_post']; ?>/" title="<?= $val['type_account']; ?>" target="_blank">#<?= $val['id_post']; ?></a></td>
                                            <td><?= $val['username']; ?>/<?= $val['password']; ?></td>
                                            <td><a href="<?= site_main(); ?>tai-khoan-<?= $val['id_post']; ?>/" target="_blank"><?= $val['type_account']; ?></a></td>
                                            <td><?= number_format($val['price'], 0, '.', '.'); ?>đ</td>
                                            <td><?= $val['date_posted']; ?></td>
                                            <td><?= ($val['user_id'] > 0) ? $val['user_id'] : 'Admin' ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="/admin/<?= $type_account ?>?id=<?= $val['id_post']; ?>" target="_blank">
                                                        <button class="btn btn-xs btn-default" type="button" val-toggle="tooltip" title="Sửa tài khoản"><i class="fa fa-pencil"></i>Sửa</button>
                                                    </a>
                                                    <a href="#" onclick="delete_acc(<?= $val['id_post']; ?>)">
                                                        <button class="btn btn-xs btn-default" type="button" val-toggle="tooltip" title="Xóa tài khoản"><i class="fa fa-times"></i>Xóa</button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?= $this->pagination->create_links() ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>
<script>
    function fitler() {
        id = $("#id").val();
        name = $("#name").val();
        var url = '/admin/ds_acc?id=' + id + '&name=' + name;
        window.location.href = url;
    }
</script>