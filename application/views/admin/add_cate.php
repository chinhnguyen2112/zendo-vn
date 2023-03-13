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

        <label>Tên Chuyên Mục</label>

        <input type="text" class="form-control" id="name_category" name="name_category" placeholder="Tên Chuyên Mục" required="" value="<?= ($id > 0) ? $list['name'] : '' ?>">

    </div>



    <div class="form-group">

        <label>Đường dẫn</label>

        <input type="text" class="form-control" id="alias" name="alias" placeholder="Đường dẫn" required="" value="<?= ($id > 0) ? $list['alias'] : '' ?>">

    </div>



    <div class="form-group">

        <label>Title</label>

        <input type="text" class="form-control" id="title" name="title" placeholder="Title" required="" value="<?= ($id > 0) ? $list['title'] : '' ?>">

    </div>

    <div class="form-group">

        <label>Thêm ảnh</label>

        <input onchange="preview_image(event,this)" type="file" accept="image/*" class="form-control" id="image" name="image" <?php if ($id > 0 && $list['id'] > 0) {

                                                                                                                                    echo '';

                                                                                                                                } else {

                                                                                                                                    echo 'required=""';

                                                                                                                                } ?>>

        <img style="width: 375px; height: 200px;" class="category_img mt20" src="/<?= ($id > 0) ? $list['image'] : '/' ?>" alt="category_img">

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

            var formData = new FormData($('#form')[0]);

            $.ajax({

                url: '/admin/ajax_add_cate',

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
                            window.location = '/sitemap/?type=chuyenmuc';
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