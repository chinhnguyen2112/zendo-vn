<link href="/assets/css/select2.min.css" rel="stylesheet" type="text/css" />
<style>
    .form_change_pass {
        width: 800px;
        margin: auto;
    }

    .error {
        font-size: 14px;
        color: red;
    }

    .label {
        width: 100%;
    }

    .select2-container--default .select2-selection--multiple {
        background: unset !important;
        border: unset !important;
        outline: none !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: black !important;
    }

    .select2-selection.select2-selection--multiple {
        padding: 10px 0 10px 10px !important;
        width: 100%;
        box-shadow: inset 0px 2px 4px rgb(0 0 0 / 50%) !important;
        border-radius: 5px !important;
        color: #fff !important;
        margin-bottom: 0 !important;
    }

    .unset_padding_left {
        padding-left: 0 !important;
    }

    .select2-container--default .select2-results__option--selected {
        background: #6c6969 !important;
        margin: 5px 0px;
        border-radius: 3px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        padding-left: 7px;
        padding-right: 6px;
        padding-top: 6px;
        height: 33px;
        border: none;
        background: #EEF9FF;
        font-size: 15px;
        display: flex;
        color: #000;
        flex-direction: row-reverse;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        width: 20px;
        height: 20px;
        background-color: #307DF1;
        border: none;
        border-radius: 90em;
        line-height: 18px;
        color: #FFFFFF;
        font-size: 15px;
        font-weight: bold;
        left: unset;
        right: 4px;
        top: 16px;
        display: flex;
        justify-content: center;
        padding: 0;
        margin-left: 5px;
    }

    .select2-container .select2-selection--multiple {
        text-align: left;
        min-height: 37px;
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid #1F1F1F;
        border-radius: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered,
    .select2-container--default.select2-container--focus .select2-selection--multiple .select2-selection__rendered {
        padding-left: unset;
    }

    .select2-selection__choice__remove span {
        margin-top: -1px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background-color: red;
        color: yellow;
    }


    @media only screen and (max-width: 1024px) {
        .form_change_pass {
            width: 100%;
        }
    }
</style>



<?php
    $arr_skin = [];
    $arr_tuong = [];
if (isset($id) && $id > 0) {
    $arr = explode('|', $list['skins']);



    foreach ($arr as $key => $value) {

        $impl = explode('-', $arr[$key]);

        array_push($arr_skin, $impl[0]);
    }
    $arr2 = explode('|', $list['champs']);



    foreach ($arr2 as $key => $value) {

        $impl = explode('-', $arr2[$key]);

        array_push($arr_tuong, $impl[0]);
    }
}
?>
<form id="form" class="form_change_pass">
    <input type="hidden" name="type_account" value="Liên Quân Mobile">


    <input type="hidden" name="id_post" value="<?= $id ?>">


    <div class="form-group mb-3">

        <label for="username" class="font-size17">Tên đăng nhập <span style="color:#ff0000">*</span></label>

        <input class="form-control" type="text" id="username" name="username" placeholder="Tên đăng nhập Garena" value="<?= isset($list['username']) ? $list['username'] : ""; ?>">

        <p class="error err_username mg_bottom_uset"></p>

    </div>


    <div class="form-group mb-3">

        <label for="password" class="font-size17">Mật khẩu <span style="color:#ff0000">*</span></label>

        <input class="form-control" type="text" id="password" name="password" placeholder="Nhap Pass" value="<?= isset($list['password']) ? $list['password'] : ""; ?>">

        <p class="error err_password mg_bottom_uset"></p>

    </div>


    <div class="form-group mb-3">

        <label for="price" class="font-size17">Giá mong muốn <span style="color:#ff0000">*</span></label>

        <input class="form-control" type="number" id="price" name="price" placeholder="" value="<?= isset($list['price']) ? $list['price'] : ""; ?>">

        <p class="error err_price mg_bottom_uset"></p>

    </div>


    <div class="form-group mb-3">

        <label for="ip_count" class="font-size17">Bậc ngọc</label>

        <input class="form-control" type="number" id="ip_count" name="ip_count" placeholder="" value="<?= isset($list['ip_count']) ? $list['ip_count'] : ""; ?>">

    </div>


    <div class="form-group mb-3">

        <label for="rank" class="font-size17">Rank</label>

        <select class="form-control" name="rank">

            <?php
            for ($i = 0; $i < 10; $i++) {
                if (isset($list) && $i == $list['rank']) {
                    echo '<option value="' . $i . '" selected>' . get_string_rank($i) . '</option>';
                } else {
                    echo '<option value="' . $i . '">' . get_string_rank($i) . '</option>';
                }
            }
            ?>

        </select>

    </div>



    <div class="form-group mb-3">

        <label for="champs_count" class="font-size17">Số tướng</label>

        <input class="form-control" type="champs_count" id="champs_count" name="champs_count" placeholder="" value="<?= isset($list['champs_count']) ? $list['champs_count'] : ""; ?>">

    </div>

    <div class="form-group mb-3">

        <label for="champs" class="font-size17">Danh sách tướng</label>

        <select class="form-control select2-multiple" name="champs[]" id="champs" multiple style="width:100%;">
            <option value="">Chọn skill</option>
            <?php foreach (arr_tuong() as $key => $val) {
            ?>
                <option value="<?= ($key + 1); ?>" <?= in_array($key + 1, $arr_tuong) ? 'selected' : '' ?>><?= $val; ?></option>

            <?php } ?>
        </select>

    </div>

    <div class="form-group mb-3">

        <label for="champs_count" class="font-size17">Số Skin</label>

        <input class="form-control" type="text" id="skins_count" name="skins_count" placeholder="" value="<?= isset($list['skins_count']) ? $list['skins_count'] : ""; ?>">

    </div>



    <div class="form-group mb-3">

        <label for="skin" class="control-label font-size17">Danh sách skin</label>

        <select id="skin" name="skins[]" class="form-control select2-multiple" multiple onchange="//count_skin(this);" style="width:100%;">
            <option value="">Chọn skill</option>
            <?php foreach (arr_skin() as $key => $val) {
            ?>
                <option value="<?= ($key + 1); ?>" <?= in_array($key + 1, $arr_skin) ? 'selected' : '' ?>><?= $val; ?></option>

            <?php } ?>
        </select>
    </div>
    <!--------------->
    <div class="form-group mb-3">
        <label class="col-xs-12 font-size17" for="thumb">Ảnh minh họa <b data-toggle="tooltip" data-placement="right" title="Ảnh hiện ở trang chủ"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
        <div class="col-xs-12">
            <input class=" form-control" type="file" name="thumb" accept="image/jpeg" style="display: block;" />
            <p class="error err_thumb mg_bottom_uset"></p>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="col-xs-12 font-size17" for="gem">Ảnh thông tin<b data-toggle="tooltip" data-placement="right" title="Mỗi ảnh sẽ là một bảng ngọc, có thể up nhiều ảnh"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>
        <div class="col-xs-12">
            <input class=" form-control" type="file" name="gem[]" accept="image/jpeg" multiple style="display: block;" />
            <p class="error err_gem mg_bottom_uset"></p>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="col-xs-12 font-size17" for="note">Ghi chú <b data-toggle="tooltip" data-placement="right" title="Hiển thị ở trang chủ khi để chuột vào"><i class="fa fa-question-circle"></i></b></label>
        <div class="col-xs-12">
            <textarea class="form-control" id="note" name="note" rows="4" placeholder="Enter để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= isset($list['note']) ? $list['note'] : ""; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="type_post">Loại</label>
        <select class="form-control" name="type_post">
            <option <?= (isset($list) && $list['type_post'] == 3) ? 'selected' : ""; ?> value="3"> Bình Thường</option>
            <option <?= (isset($list) && $list['type_post'] == 0) ? 'selected' : ""; ?> value="0"> Quảng Cáo</option>
            <option <?= (isset($list) && $list['type_post'] == 2) ? 'selected' : ""; ?> value="2"> Acc NGON</option>
            <option <?= (isset($list) && $list['type_post'] == 1) ? 'selected' : ""; ?> value="1"> Acc VIP</option>
            <option <?= (isset($list) && $list['type_post'] == 4) ? 'selected' : ""; ?> value="4"> Acc chưa định giá</option>
        </select>
    </div>
    <!--------------->
    <div class="form-group mb-3">
        <div class="col-xs-10">
            <button class="btn btn-sm btn-success" id="submit" data-action="<?= isset($type_action) ? $type_action : ""; ?>"><?= isset($type_action) ? "Cập nhật" : "Đăng bán"; ?></button>
        </div>
    </div>
</form>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>
<script>
    $('#champs').change(function() {
        var champs_count = $('#champs').find(":selected").length;
        $('#champs_count').val(champs_count);
    })
    $('#skin').change(function() {
        var skins_count = $('#skin').find(":selected").length;
        $('#skins_count').val(skins_count);
    })
    $('.select2-multiple').select2();
    $("#form").validate({
        onclick: false,

        rules: {

            "username": {

                required: true,


            },

            "password": {

                required: true,


            }

            ,

            "price": {

                required: true,

                maxlength: 8

            },

        },

        messages: {

            "username": {

                required: "Vui lòng nhập tên đăng nhập tài khoản của bạn.",
            },

            "password": {

                required: "Vui lòng nhập mật khẩu tài khoản của bạn.",


            },

            "price": {

                required: "Vui lòng nhập giá mong muốn.",

                maxlength: "Giá bán của bạn quá lớn. Xin vui lòng kiểm tra lại"

            },

        },

        errorPlacement: function(error, element) {



            if (element.attr("name") == "username") {

                $(".err_username").html(error);

            }

            if (element.attr("name") == "password") {

                $(".err_password").html(error);

            }

            if (element.attr("name") == "price") {

                $(".err_price").html(error);

            }

        },

        submitHandler: function() {

            var formData = new FormData($('#form')[0]);

            $.ajax({

                url: '/admin/ajax_post_acc',

                type: 'POST',

                data: formData,

                async: false,

                dataType: 'json',

                success: function(data) {

                    if (data.status == 1) {
                        swal({
                            title: "Thành công",
                            type: "success",
                            text: data.msg
                        }, function() {
                            window.location = '/sitemap/?type=account';
                        });
                    } else {
                        swal({
                            title: "Thất bại",
                            type: "error",
                            text: data.msg
                        });
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
</script>



</body>




</html>