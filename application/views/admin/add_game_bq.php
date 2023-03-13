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

    <input type="text" name='id' id="id" value="<?= (isset($id)) ? $id : "0" ?>" hidden>

    <div class="form-group mb-3">

        <label class="label" for="name">Tên Game</label>

        <input type="text" name="name" id="name" value="<?= (isset($list)) ? $list['name'] : ''; ?>" class="form-control" />

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Giá</label>

        <input type="number" name="price" id="price" value="<?= (isset($list)) ? $list['price'] : ''; ?>" class="form-control">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Đường dẫn</label>

        <input type="text" name="url" id="url" value="<?= (isset($list)) ? $list['alias'] : ''; ?>" class="form-control">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Ảnh đại diện</label>

        <input type="file" accept="image/*" name="image" value="">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Loại</label>

        <select name="type" id="type">

            <option <?= (isset($list) && $list['type'] == 1)?'selected':'' ?> value="1"> Game bản quyền</option>



            <option <?= (isset($list) && $list['type'] == 2)?'selected':'' ?> value="2"> Phần mềm bản quyền</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Mô tả</label>

        <textarea rows="5" cols="70" name="des" id="editor" class="form-control"><?= (isset($list)) ? $list['des'] : ''; ?></textarea>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Quan trọng (nếu có)</label>

        <textarea rows="5" cols="70" name="note" id="note" class="form-control"><?= (isset($list)) ? $list['note'] : ''; ?></textarea>

    </div>

    <div class="form-group">

        <button type="submit" class="form-control btn btn-primary submit px-3"><?= (isset($id)) ? "Sửa" : "Thêm mới" ?></button>

    </div>



</form>

<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>

<script src="/ckeditor/ckeditor.js"></script>

<!-- Tích hợp jck soạn thảo-->

<script defer type="text/javascript">

    //<![CDATA[

    CKEDITOR.replace('editor');

    //]]>

</script>

<script defer type="text/javascript">

    //<![CDATA[

    CKEDITOR.replace('note');

    //]]>

</script>

<script>

    $("#form").validate({

        onclick: false,

        rules: {

            "keyword": {

                required: true,

            },

        },

        messages: {

            "keyword": {

                required: "Chưa nhập keyword.",

            },

        },

        submitHandler: function(form) {

            var data = new FormData($("#form")[0]);

            $.ajax({

                url: '/admin/ajax_game_bq',

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
                            window.location = '/sitemap/?type=game';

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