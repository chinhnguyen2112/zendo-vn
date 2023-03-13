<style>
    * {
        font-family: "Poppins", sans-serif;
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
        height: 40px;
        margin-bottom: 5px;
        border-radius: 3px;
        border: 1px solid #aaaaaa;
    }

    input:focus {
        border: 1px solid;
    }

    .box_search_forrm button {
        border-radius: 5px;
        width: 80px;
        height: 40px;
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
    .delete_job {
        background: red;
        padding: 3px 5px;
        color: #fff;
        cursor: pointer;
    }

    @media only screen and (max-width: 540px) {

        .box_search_forrm input,
        .box_search_forrm select {
            width: 100%;
            margin-bottom: 5px;
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

<?php

$CI = &get_instance();

?>

<link rel="stylesheet" href="/assets/css/sweetalert.css">



<div class="change_content">
    <div class="main_change">
        <div class="doing">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thống kê lỗi</h4>
                        <div class="box_search_forrm">
                            <p>Bộ lọc</p>
                            <input type="" id="filter_key" placeholder="Nhập keyword,feedback" value="<?= $this->input->get('keyword') ?>">
                            <select name="" id="filter_project">
                                <option value="0">Chọn dự án</option>
                                <?php
                                $list_project = $CI->Same->get_table('', 'project');
                                if ($list_project != null) {
                                    foreach ($list_project as $val) {
                                ?>
                                        <option <?= ($this->input->get('project') == $val['id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <select name="" id="filter_duyet">
                                <option value="">Người duyệt</option>
                                <?php
                                $list_u = $CI->Same->get_nv();
                                if ($list_u != null) {
                                    foreach ($list_u as $val) {
                                ?>
                                        <option <?= ($this->input->get('duyet') == $val['id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <select name="" id="filter_types" onchange="type_error(this)" class="select2_this">
                                <option value="">Chọn loại lỗi</option>
                                <?php
                                $wheres = [
                                    'parent' => 0
                                ];
                                $list_parent =  $CI->Same->get_table_error($wheres);
                                if ($list_parent != null) {
                                    foreach ($list_parent as $key => $val) { ?>
                                        <option <?= ($this->input->get('type') == $val['id']) ? 'selected' : ''  ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                            <select name="" id="filter_error" class="select2_this">
                                <option value="">Chọn lỗi</option>
                                <?php if ($this->input->get('type') > 0) {
                                    $where = [
                                        'parent' => $this->input->get('type')
                                    ];
                                    $error =  $CI->Same->get_table_error($where);
                                    foreach ($error as $key => $val) { ?>
                                        <option <?= ($this->input->get('error') == $val['id']) ? 'selected' : ''  ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                                <?php }
                                } ?>

                            </select>
                            <button class="filter_btn" onclick="filter_ds()"><span>Lọc</span></button>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Từ khóa</th>
                                        <th>Dự án</th>
                                        <th>Người kiểm duyệt</th>
                                        <th>Ngày kiểm duyệt</th>
                                        <th>Feedback</th>
                                        <th>Danh sách lỗi</th>
                                    </tr>
                                </thead>
                                <tbody> <?php foreach ($feedback as $key => $val) { ?> <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $val['keyword'] ?></td>
                                            <td><?= $val['name_project'] ?></td>
                                            <td><?= $val['name_user'] ?></td>
                                            <td><?= date('d-m-Y H:i:s', $val['created_at']) ?></td>
                                            <td><?= $val['text'] ?></td>
                                            <td>
                                                <div class="list_box"><?php foreach ($val['list_er'] as $key => $value) { ?> <div class="this_error" style="justify-content: center;"><span><?= $value ?></span></div> <?php }  ?> </div>
                                            </td>

                                        </tr> <?php } ?> </tbody>
                            </table>
                        </div>
                        <?php echo $this->pagination->create_links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<input type="hidden" name="" id="id_u_list" value="<?= $id_u_list ?>">
<script src="/assets/js/jquery.min.js"></script>

<script src="/assets/js/jquery.validate.min.js"></script>

<script src="/assets/js/sweetalert.min.js"></script>

<script>
    function filter_ds() {
        var id = $('#id_u_list').val();
        var keyword = $('#filter_key').val();
        var project = $('#filter_project').val();
        var duyet = $('#filter_duyet').val();
        var type = $('#filter_types').val();
        var error = $('#filter_error').val();
        var url = '/lich-su-loi/' + id + '?keyword=' + keyword + '&project=' + project + '&duyet=' + duyet + '&type=' + type + '&error=' + error
        window.location.href = url;
    }

    function type_error(e) {
        var id_error = $(e).val();
        $.ajax({
            type: "post",
            url: "/Error_ctr/get_error",
            data: {
                "id": id_error
            },
            success: function(data) {
                data = JSON.parse(data.replace('gi', ''));
                if (data.length > 0) {
                    var i = 0;
                    var html = "<option value=''></option>";
                    for (i = 0; i < data.length; i++) {
                        html = html + `<option value="` + data[i].id + `">` + data[i].name + `</option>`;
                    }
                    $('#filter_error').html(html);
                }
            }
        });
    };
</script>



</body>



</html>