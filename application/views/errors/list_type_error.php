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
        width: calc(100% - 100px);
        height: 35px;
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
    }


    .active:before {
        content: "";
        width: 100%;
        position: absolute;
        top: 0;
        background: red;
        height: 5px;
    }


    .active_user a {
        background: #6fc700;
        padding: 3px 5px;
        color: #fff !important;
        cursor: pointer;
    }


    .del_user {
        background: red;
        padding: 3px 5px;
        color: #fff;
        cursor: pointer;
    }


    .edit_user a {
        background: #6fc700;
        padding: 3px 5px;
        color: #fff !important;
        text-decoration: auto !important;
        cursor: pointer;
    }

    .del_list a {
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



<link rel="stylesheet" href="/assets/css/sweetalert.css">



<div class="change_content">
    <div class="main_change">
        <div class="doing">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách loại lỗi</h4>
                        <span class="del_list"><a href="/them-loai-loi/">Thêm loại lỗi</a> </span>
                        <div class="box_search_forrm">
                            <p>Bộ lọc</p>
                            <input type="" id="filter_key" placeholder="Nhập tên loại lỗi" value="<?= $this->input->get('keyword') ?>">

                            <button class="filter_btn" onclick="filter_ds()"><span>Lọc</span></button>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên loại lỗi</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($error as $key => $val) { ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $val['name'] ?></td>
                                            <td><?= date('d-m-Y H:i:s', $val['created_at']) ?></td>


                                            <td>
                                                <span class="edit_user"><a href="/sua-loi/<?= $val['id'] ?>"> Sửa</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="del_user" data-id="<?= $val['id'] ?>">Xóa</span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $this->pagination->create_links() ?>
                    </div>
                </div>
            </div>
        </div>


    </div>

</div>

<script src="/assets/js/jquery.min.js"></script>

<script src="/assets/js/jquery.validate.min.js"></script>

<script src="/assets/js/sweetalert.min.js"></script>

<script>
    function filter_ds() {
        var keyword = $('#filter_key').val();
        var url = '/danh-sach-loai-loi?keyword=' + keyword
        window.location.href = url;
    }
    $('.del_user').click(function() {
        if (confirm('Bạn muốn xóa lỗi này')) {
            var id = $(this).data('id');
            var e = $(this);
            var data = new FormData();
            data.append('id', id);
            $.ajax({
                url: '/Error_ctr/del_error',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: data,
                success: function(response) {
                    if (response.status == 1) {
                        swal({
                            title: "Thành Công",
                            type: "success",
                            text: response.msg
                        }, function() {
                            e.parents('tr').remove();
                        });
                    } else {
                        swal({
                            title: "Thất bại",
                            type: "error",
                            text: response.msg
                        });
                    }
                },
                error: function(xhr) {
                    alert('Thất bại');


                }
            });
        }
    })
</script>



</body>



</html>