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

    <input type="text" id="id" value="<?= (isset($id)) ? $id : "0" ?>" hidden>

    <div class="form-group mb-3">

        <label class="label" for="name">Keyword</label>

        <input type="text" name="keyword" id="keyword" value="<?= (isset($list)) ? $list['keyword'] : ''; ?>" class="form-control" />

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Type</label>

        <select name="type"  id="type" value="<?= (isset($list)) ? $list['type'] : ''; ?>" class="form-control">

            <option <?= (isset($list) && $list['type'] == '0') ?  "selected" : '' ?> value="0">Thưởng vòng quay acc</option>

            <option <?= (isset($list) && $list['type'] == '1') ?  "selected" : '' ?> value="1">Thưởng vòng quay quân huy</option>

            <option <?= (isset($list) && $list['type'] == '2') ?  "selected" : '' ?> value="2">Thưởng Zen</option>

        </select>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Mô tả</label>

        <textarea rows="5" cols="70" name="des" id="editor"  class="form-control"><?= (isset($list)) ? $list['des'] : ''; ?></textarea>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Trạng thái</label>

        <select name="status" id="status">

            <option <?= (isset($list) && $list['status'] == '0') ?  "selected" : '' ?> value="0">Tắt</option>

            <option <?= (isset($list) && $list['status'] == '1') ?  "selected" : '' ?> value="1">Bật</option>

        </select>

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

            var keyword = $('#keyword').val();

            var id = $('#id').val()

            var type = $('#type').val();

            var des = CKEDITOR.instances.editor.getData();

            var status = $('#status').val()

            var data = new FormData();

            data.append('keyword', keyword);

            data.append('id', id);

            data.append('type', type);

            data.append('des', des);

            data.append('status', status);

            $.ajax({

                url: '/admin/ajax_traffic',

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

                            window.location.href = "/admin/traffic";

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