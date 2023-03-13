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







    @media only screen and (max-width: 1024px) {

        .form_change_pass {

            width: 100%;

        }

    }

</style>









<form id="form" class="form_change_pass">

    <input type="hidden" name="type_account" value="Tốc Chiến">





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



        <label for="champs_count" class="font-size17">Số tướng</label> <input class="form-control" type="champs_count" id="champs_count" name="champs_count" placeholder="" value="<?= isset($list['champs_count']) ? $list['champs_count'] : ""; ?>">



        <p class="error err_price mg_bottom_uset"></p>



    </div>





    <div class="form-group mb-3">

        <label for="champs_count" class="font-size17">Số Skin</label> <input class="form-control" type="text" id="skins_count" name="skins_count" placeholder="" value="<?= isset($list['skins_count']) ? $list['skins_count'] : ""; ?>">

    </div>



    <div class="form-group mb-3">



        <label for="rank" class="font-size17">Rank</label>



        <label for="rank">Rank</label>

        <select class="form-control" name="rank">

            <option <?= (isset($list) && $list['rank'] == 0) ? 'selected' : ""; ?> value="0">Chưa Rank</option>

            <option <?= (isset($list) && $list['rank'] == 1) ? 'selected' : ""; ?> value="1">Sắt</option>

            <option <?= (isset($list) && $list['rank'] == 2) ? 'selected' : ""; ?> value="2">Đồng</option>

            <option <?= (isset($list) && $list['rank'] == 3) ? 'selected' : ""; ?> value="3">Bạc</option>

            <option <?= (isset($list) && $list['rank'] == 4) ? 'selected' : ""; ?> value="4">Vàng</option>

            <option <?= (isset($list) && $list['rank'] == 5) ? 'selected' : ""; ?> value="5">Bạch Kim</option>

            <option <?= (isset($list) && $list['rank'] == 6) ? 'selected' : ""; ?> value="6">Ngọc lục bảo</option>

            <option <?= (isset($list) && $list['rank'] == 7) ? 'selected' : ""; ?> value="7">Kim Cương</option>

            <option <?= (isset($list) && $list['rank'] == 8) ? 'selected' : ""; ?> value="8">Cao Thủ</option>

            <option <?= (isset($list) && $list['rank'] == 9) ? 'selected' : ""; ?> value="9">Đại cao thủ</option>

            <option <?= (isset($list) && $list['rank'] == 10) ? 'selected' : ""; ?> value="10">Thách Đấu</option>

        </select>

    </div>

    <div class="form-group">

        <label class="col-xs-12" for="skins">Nhập danh sách tên Skins <b data-toggle="tooltip" data-placement="right" title="Phẩy để xuống dòng"><i class="fa fa-question-circle"></i></b></label>

        <div class="col-xs-12">

            <textarea class="form-control" id="skins" name="skins" rows="4" placeholder="Nhập danh sách tên vào đây, mỗi tên cách nhau bởi dấu phẩy để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= (isset($list) && $list['skins'] !='' )?$list['skins'] : '' ?></textarea>

        </div>

    </div>



    <div class="form-group">

        <label class="col-xs-12" for="champs">Nhập danh sách tên tướng <b data-toggle="tooltip" data-placement="right" title="Phẩy xuống dòng"><i class="fa fa-question-circle"></i></b></label>

        <div class="col-xs-12">

            <textarea class="form-control" id="champs" name="champs" rows="4" placeholder="Nhập danh sách tên vào đây, mỗi tên cách nhau bởi dấu phẩy để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= (isset($list) && $list['champs'] !='' )?$list['champs'] : '' ?></textarea>

        </div>

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

        <option <?= (isset($list)&& $list['type_post'] == 3) ? 'selected' : ""; ?> value="3"> Bình Thường</option>

            <option <?= (isset($list)&& $list['type_post'] == 0) ? 'selected' : ""; ?> value="0"> Quảng Cáo</option>

            <option <?= (isset($list)&& $list['type_post'] == 2) ? 'selected' : ""; ?> value="2"> Acc NGON</option>

            <option <?= (isset($list)&& $list['type_post'] == 1) ? 'selected' : ""; ?> value="1"> Acc VIP</option>

            <option <?= (isset($list)&& $list['type_post'] == 4) ? 'selected' : ""; ?> value="4"> Acc chưa định giá</option>

        </select>

    </div>

    <!--------------->

    <div class="form-group mb-3">

        <div class="col-xs-10">

            <button class="btn btn-sm btn-success" id="submit" data-action="<?= isset($type_action) ? $type_action : ""; ?>"><?= isset($type_action) ? "Cập nhật" : "Đăng bán"; ?></button>

        </div>

    </div>

</form>

<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>

<script>

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