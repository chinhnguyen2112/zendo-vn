<style>
    .form_change_pass {
        width: 800px;
        margin: auto;
    }

    .error {
        font-size: 14px;
        color: red;
    }

    .label,
    .name_flex {
        width: 100%;
    }

    .flex_input {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .input_fl {
        width: 49%;
    }

    .box_flex {
        display: flex;
        justify-content: space-between;
    }

    .box_vip {
        padding: 10px;
        background: #e4e4e4;
    }


    .add_hv {
        color: #2758dd;
        cursor: pointer;
        font-weight: 600;
    }

    .name_gr {
        font-size: 18px;
        font-weight: 600;
    }

    .box_relative {
        position: relative;
        margin-bottom: 30px !important;
    }

    .nav_list_skill {
        position: absolute;
        display: none;
        max-height: 200px;
        max-width: 320px;
        right: calc(50% - 160px);
        z-index: 1;
    }

    .sl_skill {
        display: none;
    }

    .box_add_skill {
        display: flex;
        justify-content: space-between;
        gap: 0 20px;
        flex-wrap: wrap;
    }

    .sweet-alert {
        box-shadow: 0px 12px 22px rgb(0 0 0 / 44%);
    }

    .list_show_skill {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px 16px;
    }

    .this_skill {
        display: flex;
        justify-content: space-between;
        position: relative;
        width: calc(50% - 8px);
        align-items: center;
        border: 1px solid #ccc;
        padding-left: 3px;
        flex-wrap: wrap;
        height: 42px;
        position: relative;
    }

    .this_skill label {
        width: 100%;
        position: absolute;
        bottom: -30px;
    }

    .this_skill img {
        position: absolute;
        background: red;
        right: -7px;
        border-radius: 50%;
        top: -7px;
        cursor: pointer;
        width: 17px;
    }

    .this_skill p {
        margin: 0;
    }

    .nav_p_input {
        position: absolute;
        right: 5px;
        font-size: 16px;
        top: calc(50% - 11px);
    }

    .this_skill input {
        padding: 10px 35px 10px 10px;
        padding-right: 35px;
        font-size: 16px;
        height: auto;
        text-align: right;
    }

    .close {
        font-size: 14px;
        background: red;
        padding: 5px;
        color: #fff;
        font-weight: 600;
        opacity: 1;
        cursor: pointer;
        text-shadow: unset;
    }

    .this_hv,
    .this_kn {
        padding: 5px;
        border: 5px solid #fff;
        margin-bottom: 10px;
    }

    .this_skill input {
        border: none;
        width: calc(100% - 100px);
        text-align: left;
        padding: 10px 5px 10px 10px;
    }

    @media only screen and (max-width: 1024px) {
        .form_change_pass {
            width: 100%;
        }
    }
</style>
<link rel="stylesheet" href="/assets/css/sweetalert.css">
<form id="form" class="form_change_pass">
    <input type="hidden" id="id_uv" name="id" hidden value="<?= (isset($id) && $id > 0) ? $id : '' ?>" />
    <div class="form-group mb-3" style="text-align: center;">
        <label for="avatar">
            <img src="/<?= (isset($data) && $data['avatar'] != '') ? $data['avatar'] : 'images/candidate/avt1.png' ?>" style="border-radius: 50%;cursor:pointer" id="mainImage" width="200px" height="200px" alt=" ảnh sản phẩm">
        </label>
        <p>Ảnh đại diện</p>
        <input type="file" style="width: 0;" accept="image/png, image/jpeg" onchange="document.getElementById('mainImage').src = window.URL.createObjectURL(this.files[0])" id="avatar" name="avatar">
    </div>
    <div class="form-group mb-3">
        <p>Tên ứng viên</p>
        <input type="text" name="name_uv" class="form-control" placeholder="Tên ứng viên" value="<?= (isset($data) && $data['name'] != '') ? $data['name'] : '' ?>" />
    </div>
    <div class="flex_input form-group mb-3">
        <div class="box_input input_fl">
            <p>Kinh nghiệm làm việc</p>
            <select class="form-control" name="exp_work">
                <option <?= (!isset($data)) ? 'selected' : '' ?> value="">Kinh nghiệm làm việc</option>
                <?php $list_exp = list_exp();
                foreach ($list_exp as $key => $val) {
                ?>
                    <option <?= (isset($data) && $data['exp_work'] == $key && $data['exp_work'] != '') ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="box_input input_fl">
            <p>Email</p>
            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= (isset($data) && $data['email'] != '') ? $data['email'] : '' ?>" />
        </div>
    </div>
    <div class="flex_input form-group mb-3">
        <div class="box_input input_fl">
            <p>Ngành nghề ứng tuyển</p>
            <select class="form-control" name="cate">
                <option value="">Ngành nghề ứng tuyển</option>
                <?php $list_cate = list_cate();
                foreach ($list_cate as $val) {
                ?>
                    <option <?= (isset($data) && $data['cate'] == $val['id']) ? 'selected' : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="box_input input_fl">
            <p>Vị trí ứng tuyển</p>
            <select class="form-control" name="vtri">
                <option value="">Vị tri ứng tuyển</option>
                <?php $list_vt = list_vt();
                foreach ($list_vt as $key => $val) {
                ?>
                    <option <?= (isset($data) && $data['ung_tuyen'] == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="flex_input form-group mb-3">
        <div class="box_input input_fl">
            <p>Địa điểm làm việc mong muốn</p>
            <select class="form-control" name="cit">
                <option value="">Địa điểm</option>
                <?php $list_cit = list_cit();
                foreach ($list_cit as $key => $val) {
                ?>
                    <option <?= (isset($data) && $data['dia_diem'] == $key) ? 'selected' : '' ?> value="<?= $key ?>"><?= $val ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="box_input input_fl">
            <p>Giới tính</p>
            <select class="form-control" name="sex">
                <option value="">Giới tính</option>
                <option <?= (isset($data) && $data['sex'] == 1) ? 'selected' : '' ?> value="1">Nam</option>
                <option <?= (isset($data) && $data['sex'] == 2) ? 'selected' : '' ?> value="2">Nữ</option>
            </select>
        </div>
    </div>
    <div class="flex_input form-group mb-3">
        <div class="box_input input_fl">
            <p>Ngày, tháng, năm sinh</p>
            <input class="form-control" type="date" name="birthday" id="birthday" value="<?= (isset($data) && $data['birthday'] != '') ? date('Y-m-d', $data['birthday']) : '' ?>">
        </div>
        <div class="box_input input_fl">
            <p>Số điện thoại</p>
            <input class="form-control" type="text" name="phone" placeholder="Sô điện thoại" value="<?= (isset($data) && $data['phone'] != '') ? $data['phone'] : '' ?>">
        </div>
    </div>
    <div class="form-group mb-3">
        <p>Địa chỉ hiện tại</p>
        <input class="form-control" type="text" name="address_ht" placeholder="Địa chỉ hiện tại" value="<?= (isset($data) && $data['address_ht'] != '') ? $data['address_ht'] : '' ?>">
    </div>
    <div class="form-group mb-3">
        <p>Quê quán</p>
        <input class="form-control" type="text" name="address_qq" placeholder="Quê quán" value="<?= (isset($data) && $data['address_qq'] != '') ? $data['address_qq'] : '' ?>">
    </div>
    <div class="form-group mb-3">
        <p>Tóm tắt bản thân</p>
        <textarea class="form-control" style="width:100%;height:200px" name="note_uv"><?= (isset($data) && $data['note'] != '') ? $data['note'] : '' ?></textarea>
    </div>
    <div class="form-group mb-3">
        <p>Mục tiêu công việc</p>
        <textarea class="form-control" style="width:100%;height:200px" name="target"><?= (isset($data) && $data['target'] != '') ? $data['target'] : '' ?></textarea>
    </div>
    <div class="form-group mb-3 box_relative">
        <div class="box_flex">
            <p>Kỹ năng</p>
            <p class="add_hv" id="add_skill">+ Thêm kỹ năng</p>
        </div>
        <div class="list_show_skill">
            <input type="hidden" name="del_skill" id="del_skill" value="">
            <?php if (isset($list_skill) && $list_skill != null) {
                foreach ($list_skill as $key => $val) {
            ?>
                    <div class="this_skill" data-id="<?= $val['id'] ?>">
                        <input class="inp_name" name="name_skill[]" placeholder="tên kỹ năng" value="<?= $val['name'] ?>">
                        <input class="form-control" type="text" name="skill[]" id="skill<?= $val['id'] ?>" value="<?= $val['value'] ?>" style="max-width:90px" placeholder="Số %">
                        <input class="form-control" type="text" name="id_skill[]" value="<?= $val['id'] ?>" hidden>
                        <p class="nav_p_input">| %</p>
                        <img onclick="delete_skill(this)" src="/images/train/close.svg">
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <div class="form-group mb-3 box_vip">
        <div class="box_flex">
            <p class="name_gr">Học vấn</p>
            <p class="add_hv" id="add_hv">+ Thêm học vấn</p>
        </div>
        <div class="list_hv">
            <input type="hidden" name="del_hv" id="del_hv" value="">
            <?php if (isset($edu) && $edu != null) {
                foreach ($edu as $key => $val) { ?>
                    <div class="this_hv">
                        <div class="box_input form-group mb-3"><input type="text" name="id_hv[]" id="id_hv<?= $key ?>" value="<?= $val['id'] ?>" hidden>
                            <div class="box_flex">
                                <p>Tên trường</p>
                                <p class="close close_hv" onclick="del_hv(this)">Xóa</p>
                            </div>
                            <input class="form-control" type="text" name="name_truong[]" id="name_truong<?= $key ?>" placeholder="Tên trường" value="<?= $val['name_school'] ?>">
                        </div>
                        <div class="flex_input form-group mb-3">
                            <div class="box_input input_fl">
                                <p>Bắt đầu</p>
                                <input class="form-control" type="date" name="tg_start[]" id="tg_start<?= $key ?>" value="<?= date('Y-m-d', $val['time_start']) ?>">
                            </div>
                            <div class="box_input input_fl">
                                <p>Kết thúc</p>
                                <input class="form-control" type="date" name="tg_end[]" id="tg_end<?= $key ?>" value="<?= date('Y-m-d', $val['time_end']) ?>">
                            </div>
                        </div>
                        <div class="flex_input form-group mb-3">
                            <div class="box_input input_fl">
                                <p>Ngành học</p>
                                <input class="form-control" type="text" name="cate_hoc[]" id="cate_hoc<?= $key ?>" placeholder="Ngành học" value="<?= $val['cate'] ?>">
                            </div>
                            <div class="box_input input_fl">
                                <p>Bằng cấp</p>
                                <select name="level[]" id="level<?= $key ?>" class="form-control">
                                    <option value="">Chọn xếp loại</option>
                                    <option <?= ($val['degree'] == 1) ? 'selected' : '' ?> value="1">Giỏi</option>
                                    <option <?= ($val['degree'] == 2) ? 'selected' : '' ?> value="2">Khá</option>
                                    <option <?= ($val['degree'] == 3) ? 'selected' : '' ?> value="3">Trung bình</option>
                                    <option <?= ($val['degree'] == 4) ? 'selected' : '' ?> value="4">Yếu</option>
                                    <option <?= ($val['degree'] == 5) ? 'selected' : '' ?> value="5">Kém</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <p>Thông tin bổ sung</p>
                            <textarea class="form-control" style="width:100%;height:200px" name="note_hoc[]" id="note_hoc<?= $key ?>"><?= $val['note'] ?></textarea>
                        </div>
                    </div>
            <?php     }
            } ?>
        </div>
    </div>
    <div class="form-group mb-3 box_vip">
        <div class="box_flex">
            <p class="name_gr">Kinh nghiệm làm việc</p>
            <p class="add_hv" id="add_kn">+ Thêm kinh nghiệm</p>
        </div>
        <div class="list_kn">
            <input type="hidden" name="del_kn" id="del_kn">
            <?php if (isset($exp) && $exp != null) {
                foreach ($exp as $key => $val) { ?><div class="this_kn">
                        <div class="box_input form-group mb-3"><input type="text" name="id_kn[]" id="id_kn<?= $key ?>" value="<?= $val['id'] ?>" hidden>
                            <div class="box_flex">
                                <p>Công ty</p>
                                <p class="close close_kn" onclick="del_kn(this)">Xóa</p>
                            </div>
                            <input class="form-control" type="text" name="name_cty[]" id="name_cty<?= $key ?>" placeholder="Công ty" value="<?= $val['name_com'] ?>">
                        </div>
                        <div class="flex_input form-group mb-3">
                            <p class="name_flex">Thời gian</p>
                            <div class="box_input input_fl">
                                <p>Bắt đầu</p>
                                <input class="form-control" type="date" name="start_lam[]" id="start_lam<?= $key ?>" value="<?= date('Y-m-d', $val['time_start']) ?>">
                            </div>
                            <div class="box_input input_fl">
                                <p>Kết thúc</p>
                                <input class="form-control" type="date" name="end_lam[]" id="end_lam<?= $key ?>" value="<?= date('Y-m-d', $val['time_end']) ?>">
                            </div>
                        </div>
                        <div class="box_input form-group mb-3">
                            <p>Vị trí làm việc</p>
                            <input class="form-control" type="text" name="level_lam[]" id="level_lam<?= $key ?>" placeholder="Vị trí làm việc" value="<?= $val['position'] ?>">
                        </div>
                        <div class="box_input form-group mb-3">
                            <p>Mô tả công việc</p>
                            <textarea class="form-control" style="width:100%;height:200px" name="note_lam[]" id="note_lam<?= $key ?>"><?= $val['note'] ?></textarea>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
    <div class="form-group mb-3">
        <p>Hoạt động</p>
        <textarea class="form-control" style="width:100%;height:200px" name="hoat_dong"><?= (isset($data) && $data['hoat_dong'] != '') ? $data['hoat_dong'] : '' ?></textarea>
    </div>
    <div class="form-group mb-3">
        <p>Dự án/ sản phẩm (cách nhau bằng dấu phẩy)</p>
        <input class="form-control" placeholder="Dự án/ sản phẩm" name="project" value="<?= (isset($data) && $data['project'] != '') ? $data['project'] : '' ?>">
    </div>
    <div class="form-group mb-3">
        <p>Loại ứng viên</p>
        <select name="type_uv" id="type_uv" class="form-control">
            <option <?= ($val['type_user'] == 0) ? 'selected' : '' ?> value="0">Thường</option>
            <option <?= ($val['type_user'] == 1) ? 'selected' : '' ?> value="1">Ứng viên được đề xuất</option>
            <option <?= ($val['type_user'] == 2) ? 'selected' : '' ?> value="2">Ứng viên hàng đầu</option>
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary submit px-3"><?= (isset($id)) ? "Sửa" : "Thêm mới" ?></button>
    </div>
</form>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/sweetalert.min.js"></script>
<script>
    var check_avt = ($('#id_uv').val() > 0) ? false : true;
    $("#form").validate({
        onclick: false,
        rules: {
            "avatar": {
                required: check_avt,
            },
            "email": {
                required: true,
            },
            "name_uv": {
                required: true,
            },
            "exp_work": {
                required: true,
            },
            "cate": {
                required: true,
            },
            "vtri": {
                required: true,
            },
            "cit": {
                required: true,
            },
            "sex": {
                required: true,
            },
            // "birthday": {
            //     required: true,
            // },
            "phone": {
                required: true,
            },
            "address_ht": {
                required: true,
            },
            // "address_qq": {
            //     required: true,
            // },
            // "note_uv": {
            //     required: true,
            // },
            "target": {
                required: true,
            },
            "name_skill[]": {
                required: true,
            },
            "name_truong[]": {
                required: true,
            },
            // "tg_start[]": {
            //     required: true,
            // },
            // "tg_end[]": {
            //     required: true,
            // },
            "cate_hoc[]": {
                required: true,
            },
            "level[]": {
                required: true,
            },
            // "note_hoc[]": {
            //     required: true,
            // },
            "name_cty[]": {
                required: true,
            },
            // "start_lam[]": {
            //     required: true,
            // },
            // "end_lam[]": {
            //     required: true,
            // },
            "level_lam[]": {
                required: true,
            },
            // "note_lam[]": {
            //     required: true,
            // },
        },
        messages: {
            "avatar": {
                required: "Vui lòng chọn ảnh đại diện",
            },
            "email": {
                required: "Vui lòng nhập email",
            },
            "exp_work": {
                required: "Vui lòng chọn kinh nghiệm làm việc",
            },
            "name_uv": {
                required: "Vui lòng nhập tên ứng viên",
            },
            "cate": {
                required: "Vui lòng chọn ngành nghề",
            },
            "vtri": {
                required: "Vui lòng chọn vị trí",
            },
            "cit": {
                required: "Vui lòng chọn thành phố",
            },
            "sex": {
                required: "Vui lòng chọn giới tính",
            },
            // "birthday": {
            //     required: "Vui lòng nhập ngày , tháng, năm sinh",
            // },
            "phone": {
                required: "Vui lòng nhập số điện thoại",
            },
            "address_ht": {
                required: "Vui lòng nhập địa chỉ hiện tại",
            },
            // "address_qq": {
            //     required: "Vui lòng nhập quê quán",
            // },
            // "note_uv": {
            //     required: "Vui lòng nhập tóm tắn bản thân",
            // },
            "target": {
                required: "Vui lòng nhập mục tiêu công việc",
            },
            "name_skill[]": {
                required: "Vui lòng tên kỹ năng",
            },
            "name_truong[]": {
                required: "Vui lòng nhập tên trường",
            },
            // "tg_start[]": {
            //     required: "Vui lòng nhập thời gian bắt đầu",
            // },
            // "tg_end[]": {
            //     required: "Vui lòng nhập thời gian kết thúc",
            // },
            "cate_hoc[]": {
                required: "Vui lòng nhập ngành học",
            },
            "level[]": {
                required: "Vui lòng chọn xếp loại",
            },
            // "note_hoc[]": {
            //     required: "Vui lòng nhập thông tin bổ sung",
            // },
            "name_cty[]": {
                required: "Vui lòng nhập tên công ty",
            },
            // "start_lam[]": {
            //     required: "Vui lòng nhập thời gian bắt đầu",
            // },
            // "end_lam[]": {
            //     required: "Vui lòng nhập thời gian kết thúc",
            // },
            "level_lam[]": {
                required: "Vui lòng nhập vị trí làm việc",
            },
            // "note_lam[]": {
            //     required: "vui lòng nhập mô tả công việc",
            // },
        },
        submitHandler: function(form) {
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url: '/addCandi',
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: formData,
                success: function(response) {
                    if (response.status == 1) {
                        swal({
                            title: "Thành Công",
                            type: "success",
                            text: "Thành công"
                        }, function() {
                            window.location.reload();
                        });
                    } else if (response.status == 2) {
                        swal({
                            title: "Thất bại",
                            type: "error",
                            text: "Email hoặc số điện thoại đã được sử dụng"
                        });
                    } else {
                        swal({
                            title: "Thất bại",
                            type: "error",
                            text: "Có lỗi sảy ra"
                        });
                    }
                },
                error: function(xhr) {
                    alert('Thất bại');
                }
            });
            return false;
        }
    });
    $('#sl_skill').click(function() {
        $('.nav_list_skill').show()
    })
    $('#add_skill').click(function() {
        var ind = 'none_' + $(".this_skill").length;
        var count = 'none_' + $(".this_skill").length;
        var html = `<div class="this_skill" >
                            <input class="inp_name" name="name_skill[]" placeholder="tên kỹ năng">
                            <input class="form-control" type="text" name="skill[]" id="skill` + ind + `" value="0" style="max-width:90px" placeholder="Số %" >
                            <input class="form-control" type="text" name="id_skill[]"  value="0" hidden >
                            <p class="nav_p_input">| %</p>
                            <img onlick="delete_skill(this,` + count + `)" src="/images/train/close.svg">
                        </div>`;
        $('.nav_list_skill').hide();
        $('.list_show_skill').append(html)
    })
    $(document).click(function(event) {
        $target = $(event.target);
        if (!$target.closest('.nav_list_skill').length && $('.nav_list_skill').is(":visible") && !$target.closest('#sl_skill').length) {
            $('.nav_list_skill').hide();
        }
        if (!$target.closest('.box_add_skill').length && $('.box_add_skill').is(":visible") && !$target.closest('#add_skill').length) {
            $('.box_add_skill').hide();
        }
    });
    $('#add_group').click(function() {
        var name = $('#skill_new').val();
        if (name != '') {
            $('#error_new_skill').empty();
            swal({
                title: "Xác nhận thêm kỹ năng",
                text: "Bạn muốn thêm kỹ năng mới?",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Có",
                cancelButtonText: "Không",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function() {
                $.ajax({
                    type: "post",
                    url: '/addSkill',
                    dataType: "json",
                    data: {
                        name: name
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            var dv = '<option value="' + response.id + '">' + name + '</option>';
                            swal({
                                title: "Thành công",
                                type: "success",
                                text: "Thêm kỹ năng thành công"
                            });
                            $('.nav_list_skill').append(dv);
                        } else if (response.status == 2) {
                            swal({
                                title: "Thất bại",
                                type: "error",
                                text: "Kỹ năng đã tồn tại. Vui lòng kiểm tra lại"
                            });
                        } else {
                            swal({
                                title: "Có lỗi xảy ra",
                                type: "error",
                                text: "Thêm thất bại"
                            });
                        }
                    }
                });
            })
        } else {
            $('#error_new_skill').empty();
            $('#error_new_skill').html('* Vui lòng nhập tên kxy năng mới *');
        }
    })
    $('#add_hv').click(function() {
        var ind = $(".this_hv").length;
        var html = `<div class="this_hv">
                        <div class="box_input form-group mb-3"><input type="text" name="id_hv[]" id="id_hv` + ind + `" value="0" hidden>
                        <div class="box_flex"><p>Tên trường</p><p class="close close_hv" onclick="del_hv(this)">Xóa</p></div>
                            <input class="form-control" type="text" name="name_truong[]" id="name_truong` + ind + `" placeholder="Tên trường">
                        </div>
                        <div class="flex_input form-group mb-3">
                            <div class="box_input input_fl">
                                <p>Bắt đầu</p>
                                <input class="form-control" type="date" name="tg_start[]" id="tg_start` + ind + `">
                            </div>
                            <div class="box_input input_fl">
                                <p>Kết thúc</p>
                                <input class="form-control" type="date" name="tg_end[]" id="tg_end` + ind + `">
                            </div>
                        </div>
                        <div class="flex_input form-group mb-3">
                            <div class="box_input input_fl">
                                <p>Ngành học</p>
                                <input class="form-control" type="text" name="cate_hoc[]" id="cate_hoc` + ind + `" placeholder="Ngành học">
                            </div>
                            <div class="box_input input_fl">
                                <p>Bằng cấp</p>
                                <select name="level[]" id="level` + ind + `" class="form-control">
                                    <option value="">Chọn xếp loại</option>
                                    <option value="1">Giỏi</option>
                                    <option value="2">Khá</option>
                                    <option value="3">Trung bình</option>
                                    <option value="4">Yếu</option>
                                    <option value="5">Kém</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <p>Thông tin bổ sung</p>
                            <textarea class="form-control" style="width:100%;height:200px" name="note_hoc[]" id="note_hoc` + ind + `"></textarea>
                        </div>
                    </div>`;
        $('.list_hv').append(html)
    })
    $('#add_kn').click(function() {
        var ind = $(".this_kn").length;
        var html = `<div class="this_kn">
                        <div class="box_input form-group mb-3"><input type="text" name="id_kn[]" id="id_kn` + ind + `" value="0" hidden>
                        <div class="box_flex"><p>Công ty</p><p class="close close_kn" onclick="del_kn(this)">Xóa</p></div>
                            <input class="form-control" type="text" name="name_cty[]" id="name_cty` + ind + `" placeholder="Công ty">
                        </div>
                        <div class="flex_input form-group mb-3">
                            <p class="name_flex">Thời gian</p>
                            <div class="box_input input_fl">
                                <p>Bắt đầu</p>
                                <input class="form-control" type="date" name="start_lam[]" id="start_lam` + ind + `">
                            </div>
                            <div class="box_input input_fl">
                                <p>Kết thúc</p>
                                <input class="form-control" type="date" name="end_lam[]" id="end_lam` + ind + `">
                            </div>
                        </div>
                        <div class="box_input form-group mb-3">
                            <p>Vị trí làm việc</p>
                            <input class="form-control" type="text" name="level_lam[]" id="level_lam` + ind + `" placeholder="Vị trí làm việc">
                        </div>
                        <div class="box_input form-group mb-3">
                            <p>Mô tả công việc</p>
                            <textarea class="form-control" style="width:100%;height:200px" name="note_lam[]" id="note_lam` + ind + `"></textarea>
                        </div>
                    </div>`;
        $('.list_kn').append(html)
    })
    var i = 0;
    var j = 0;

    function del_hv(e) {
        swal({
            title: "Xác nhận xóa học vấn",
            text: "Bạn muốn xóa học vấn này",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Có",
            cancelButtonText: "Không",
            // closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            var val_del = $(e).parents('.this_hv').find('input[name="id_hv[]"]').val();
            var conn = '';
            if (i > 0) {
                conn = ',';
            }
            if (val_del > 0) {
                $('#del_hv').val($('#del_hv').val() + conn + val_del);
            }
            $(e).parents('.this_hv').remove();
            i = ++i;

        })
    }

    function del_kn(e) {
        swal({
            title: "Xác nhận xóa kinh nghiệm",
            text: "Bạn muốn xóa kinh nghiệm này",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Có",
            cancelButtonText: "Không",
            // closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            var val_del = $(e).parents('.this_kn').find('input[name="id_kn[]"]').val();
            var conn = '';
            if (j > 0) {
                conn = ',';
            }
            if (val_del > 0) {
                $('#del_kn').val($('#del_kn').val() + conn + val_del);
            }
            $(e).parents('.this_kn').remove();
            j = ++j;

        })
    }

    function delete_skill(e) {
        swal({
            title: "Xác nhận xóa kinh nghiệm",
            text: "Bạn muốn xóa kinh nghiệm này",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Có",
            cancelButtonText: "Không",
            // closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function() {
            var val_del = $(e).parents('.this_skill').find('input[name="id_skill[]"]').val();
            var conn = '';
            if (j > 0) {
                conn = ',';
            }
            if (val_del > 0) {
                $('#del_skill').val($('#del_skill').val() + conn + val_del);
            }
            $(e).parents('.this_skill').remove();
            j = ++j;

        })
    }
</script>
</body>

</html>