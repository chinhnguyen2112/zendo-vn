<style>
    .form_change_pass {
        width: 800px;
        margin: auto;
    }


    .error {
        font-size: 14px;
        color: red;
    }


    @media only screen and (max-width: 1024px) {
        .form_change_pass {
            width: 100%;
        }
    }
</style>



<link rel="stylesheet" href="/assets/css/sweetalert.css">

<form id="form" class="form_change_pass">
    <input type="text" id="id" value="<?= (isset($id)) ? $id : "0" ?>" hidden>
    <div class="form-group mb-3">
        <label class="label" for="name">Loại lỗi</label>
        <select name="" id="tp_error" style="width:100%;">
                <option value="">Chọn loại lỗi</option>
            <?php if ($list_parent != null) {
                foreach ($list_parent as $key => $val) { ?>
                    <option <?= (isset($id) && $parent == $val['id']  )?'selected'  : '' ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
            <?php }
            } ?>
        </select>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="name">Tên lỗi</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Tên lỗi..." value="<?= (isset($name)) ? $name : "" ?>">
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary submit px-3"><?= (isset($id)) ? "Sửa" : "Thêm mới" ?></button>
    </div>

</form>

<script src="/assets/js/jquery.min.js"></script>

<script src="/assets/js/jquery.validate.min.js"></script>

<script src="/assets/js/sweetalert.min.js"></script>

<script>
    $("#form").validate({
        onclick: false,
        rules: {
            "name": {
                required: true,
            },
        },
        messages: {
            "name": {
                required: "Vui lòng nhập tên lỗi.",
            },
        },
        submitHandler: function(form) {
            var name = $('#name').val();
            var id = $('#id').val()
            var type_error = $('#tp_error').val()
            var data = new FormData();
            data.append('name', name);
            data.append('id', id);
            data.append('type_error', type_error);
            data.append('type', 0);
            $.ajax({
                url: '/Error_ctr/add_error',
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
                            window.location.href = "/danh-sach-loi/";
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