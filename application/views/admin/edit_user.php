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
    <div class="form-group">
        <label>Username</label>
        <input disabled type="text" class="form-control" id="name_category" name="namename_category" placeholder="usrename" value="<?= ($id > 0) ? $account['username'] : '' ?>">
    </div>
    <div class="form-group">
        <label>Tên</label>
        <input type="text" class="form-control" id="name_category" name="namename_category" placeholder="usrename" value="<?= ($id > 0) ? $account['name'] : '' ?>">
    </div>
    <div class="form-group">
        <label>pass</label>
        <input type="text" class="form-control" id="pass" name="pass" placeholder="Mật khẩu">
    </div>
    <div class="form-group">
        <label>Tiền</label>
        <input type="number" class="form-control" id="cash" name="cash" placeholder="Tiền" value="<?= ($id > 0) ? $account['cash'] : '' ?>">
    </div>
    <div class="form-group">
        <label>Zen</label>
        <input type="number" class="form-control" name="zen" id="zen" placeholder="Zen" value="<?= ($id > 0) ? $account['zen'] : '' ?>">
    </div>
    <div class="form-group">
        <label>Loại tài khoản</label>
        <select class="form-control" name="admin" id="">
            <option <?= ($id > 0 && $account['admin'] == 0 && $account['user_type'] == 0) ? 'selected' : '' ?> value="0">user</option>
            <option <?= ($id > 0 && $account['admin'] == 1) ? 'selected' : '' ?> value="1">admin</option>
            <option <?= ($id > 0 && $account['admin'] == 0 && $account['user_type'] == 1) ? 'selected' : '' ?> value="2">Người bán</option>
            <option <?= ($id > 0 && $account['admin'] == 0 && $account['user_type'] == 2) ? 'selected' : '' ?> value="3">KOL</option>
        </select>
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
                        $('.category_img').attr("src", image);
                    };
                })(file);
                reader.readAsDataURL(file);
            }
        }
    }
    $("#form").validate({
        onclick: false,
        submitHandler: function(form) {
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url: '/admin/ajax_edit_user',
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
                            window.location = '/admin/member';
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