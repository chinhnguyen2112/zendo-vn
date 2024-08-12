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

<?php $CI = &get_instance();

$sql = "SELECT * FROM chuyenmuc";



$count = $CI->Account->query_sql($sql);

?>

<form id="form" class="form_change_pass">

    <input type="text" name='id' id="id" value="<?= $id ?>" hidden>

    <div class="form-group mb-3">

        <label class="label" for="name">H1 (50 > 70 kí tự)</label>

        <input type="text" name="title" value="<?= (isset($list)) ? $list['title'] : ''; ?>" class="form-control" />

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Title (50 > 60 kí tụ)</label>

        <input type="text" name="meta_title" value="<?= (isset($list)) ? $list['meta_title'] : ''; ?>"
            class="form-control">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Keyword</label>

        <input type="text" name="meta_key" id="meta_key" value="<?= (isset($list)) ? $list['meta_key'] : ''; ?>"
            oninput="show_alias(this.value)" class="form-control">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Đường dẫn thân thiện</label>

        <input type="text" name="alias" value="<?= (isset($list)) ? $list['alias'] : ''; ?>" id="alias" readonly
            class="form-control">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Chuyên mục</label>

        <select name="category" id="category" class="form-control">

            <?php foreach ($count as $key => $val) { ?>

            <option <?php if (isset($list) &&  $list['chuyenmuc'] == $val['id']) {

                            echo 'selected';

                        } else {

                            echo '';

                        } ?> value="<?= $val['id'] ?>"><?= $val['name'] ?></option>

            <?php } ?>



        </select>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">SEO Description (140 > 155 kí tự)</label>

        <textarea rows="4" cols="70" name="meta_des"> <?= (isset($list)) ? $list['meta_des'] : ''; ?></textarea>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Ảnh đại diện</label>

        <input type="file" accept="image/*" name="image" value="">

        <input hidden name="images" value="<?= (isset($list)) ? $list['image'] : ''; ?>">

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Mô tả</label>

        <textarea rows="5" cols="90" name="sapo" id="sapo" /><?= (isset($list)) ? $list['sapo'] : ''; ?></textarea>

    </div>

    <div class="form-group mb-3">

        <label class="label" for="name">Nội dung</label>

        <textarea rows="5" cols="70" name="content"
            id="editor"><?= (isset($list)) ? $list['content'] : ''; ?></textarea>

    </div>

    <div class="form-group">

        <button type="submit"
            class="form-control btn btn-primary submit px-3"><?= (isset($id)) ? "Sửa" : "Thêm mới" ?></button>

    </div>



</form>

<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>

<script src="/ckeditor/ckeditor.js"></script>

<script defer type="text/javascript">
//<![CDATA[

CKEDITOR.replace('editor');

//]]>
</script>

<script defer type="text/javascript">
//<![CDATA[

CKEDITOR.replace('sapo');

//]]>
</script>

<script>
function get_alias(str) {

    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");

    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");

    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");

    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");

    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");

    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");

    str = str.replace(/đ/g, "d");

    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");

    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");

    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");

    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");

    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");

    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");

    str = str.replace(/Đ/g, "D");

    str = str.replace(/[^0-9a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, ' ');

    str = str.replace(/\s+/g, '-');

    str = str.toLowerCase();

    return str;

}



function show_alias(str) {

    var alias = get_alias(str);

    $("#alias").val(alias);

}

$("#form").validate({

    onclick: false,

    rules: {

        "alias": {

            required: true,

        },

    },

    messages: {

        "alias": {

            required: "Chưa nhập alias.",

        },

    },

    submitHandler: function(form) {

        var data = new FormData($("#form")[0]);
        data.append("content", CKEDITOR.instances.editor.getData());
        data.append("sapo", CKEDITOR.instances.sapo.getData());
        $.ajax({

            url: '/admin/ajax_add_blog',

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
                        window.location = '/sitemap/?type=blog';
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