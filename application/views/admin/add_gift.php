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



<link rel="stylesheet" href="/assets/css/sweetalert.css">

<form id="form" class="form_change_pass">
    <input type="hidden" name="id" hidden value="<?= $id ?>" />
    <div class="form-group mb-3">
        <td width="150"><label>name</label>
            <input type="text" name="name" value="<?= (isset($list)) ? $list['name'] : ''; ?>" class="form-control" />
    </div>
    <div class="form-group mb-3">
        <label>Ảnh phần quà</label>

        <img src="/<?= (isset($list)) ? $list['image'] : ''; ?>" id="img_gift" alt="Img" class="q-header-logo img-max" style="width:100px;height:100px">
        <input id="image" name="image" class="fileupload img_random" onchange="preview_image(event, this);" type="file" accept="image/*">

    </div>
    <div class="form-group mb-3">
        <label>Type</label>
        <select class="form-control"  name="type" value="<?= (isset($list)) ? $list['type'] : ''; ?>">
            <option <?= (isset($list) && $list['type'] == 'luotquay_free') ?  "selected" : '' ?> value="luotquay_free">Lượt quay free</option>
            <option <?= (isset($list) && $list['type'] == 'luotquay') ?  "selected" : '' ?> value="luotquay">Lượt quay acc</option>
            <option <?= (isset($list) && $list['type'] == 'luotquay9k') ?  "selected" : '' ?> value="luotquay9k">Lượt quay quân huy</option>
            <option <?= (isset($list) && $list['type'] == 'luotquay20k') ?  "selected" : '' ?> value="luotquay20k">Lượt quya skins</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label>Tỉ lệ (%)</label>
        <input class="form-control" type="text" name="vip" value="<?= (isset($list)) ? $list['vip'] : ''; ?>">
    </div>
    <div class="form-group mb-3">
        <label>Số thứ tự</label>
        <input class="form-control" type="number" name="stt" value="<?= (isset($list)) ? $list['stt'] : ''; ?>">
    </div>

    <div class="form-group mb-3">
        <label>Giá bán Zen</label>
        <input class="form-control" type="number" name="zen" value="<?= (isset($list)) ? $list['zen'] : 0; ?>">
    </div>

    <div class="form-group mb-3">
        <label>Mức áp dụng (áp dụng với các loại voucher hoặc số lượng mảnh đổi đổi quà) </label>
        <input class="form-control" type="number" name="value_use" value="<?= (isset($list)) ? $list['value_use'] : 0; ?>">
    </div>
    <div class="form-group mb-3">
        <label>Giá trị áp dụng (áp dụng với các loại voucher...) </label>
        <input class="form-control" type="number" name="value" value="<?= (isset($list)) ? $list['value'] : 0; ?>">
    </div>
    <div class="form-group mb-3">
        <label>Loại vật phẩm (1 là vật phẩm trong game, 2 là vật phẩm ngoài game, 0 là vật phẩm không hiển thị như lượt quay, zen ... ) </label>
        <input class="form-control" type="number" name="type_item" value="<?= (isset($list)) ? $list['type_item'] : 0; ?>">
    </div>
    <div class="form-group mb-3">
        <label>Mô tả </label>
        <textarea class="form-control" style="width:100%;height:200px" name="des" value=""><?= (isset($list)) ? $list['des'] : ""; ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary submit px-3"><?= (isset($id)) ? "Sửa" : "Thêm mới" ?></button>
    </div>
</form>
<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>
<script>
    function preview_image(e, element) {
        var _URL = window.URL || window.webkitURL;
        var file, img;
        preview_before_upload(e, element);
    }

    function preview_before_upload(event, elem) {
        if (typeof FileReader == "undefined") return true;
        var elem = $(elem);
        var files = event.target.files;
        for (var i = 0, file; file = files[i]; i++) {
            if (file.type.match('image.*')) {
                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(event) {
                        var image = event.target.result;
                        $('#img_gift').attr("src", image);
                    };
                })(file);
                reader.readAsDataURL(file);
            }
        }
    }
    $("#form").validate({
        onclick: false,
        rules: {
            "name": {
                required: true,
            },
        },
        messages: {
            "name": {
                required: "Chưa nhập tên.",
            },
        },
        submitHandler: function(form) {
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url: '/admin/ajax_add_gift',
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
                            text: response.msg
                        }, function() {
                            window.location.href = "/admin/gift";
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
            return false;
        }
    });
</script>



</body>



</html>