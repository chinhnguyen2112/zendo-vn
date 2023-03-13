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
<form id="form" class="form_change_pass">
    <div class="form-group padding_chung">
        <div class="mb20 ml50">Nhập list acc theo định dạng ( tk|pass và mỗi dòng 1 là acc ) </div>
        <div class="col-xs-12">
            <textarea rows="10" cols="70" class="form-control" name="list_acc" style="border: 1px solid;">Nhập List acc</textarea><br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Free"> Liên Quân Free<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 9k"> Liên Quân Mobile Random 9k<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 20k"> Liên Quân Mobile Random 20k<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 50k"> Liên Quân Mobile Random 50k<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 100k"> Liên Quân Mobile Random 100k<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 200k"> Liên Quân Mobile Random 200k<br>
            <input class="mb10" type="radio" name="type_account" value="Liên Quân Mobile Random 500k"> Liên Quân Mobile Random 500k<br>

        </div>

    </div>
    <!--------------->
    <div class="form-group mb-3">
        <div class="col-xs-10">
            <button class="btn btn-sm btn-success" id="submit" data-action="<?= isset($type_action) ? $type_action : ""; ?>">Đăng</button>
        </div>
    </div>
</form>
<script src="<?= site_main() ?>assets/js/jquery.validate.min.js"></script>
<script>
    $("#form").validate({
        onclick: false,

        rules: {

            "list_acc": {

                required: true,


            },

        },

        messages: {

            "list_acc": {

                required: "Bạn chưa nhập",
            }

        },

        submitHandler: function() {
            var formData = new FormData($('#form')[0]);

            $.ajax({

                url: '/admin/ajax_post_ld_random',

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
                            window.location = '/admin/ds_acc';
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