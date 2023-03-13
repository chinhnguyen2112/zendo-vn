function load_history_card() {
    $(".list_card").hide();
    $("#loading").show();
    $.post("/history_card", {
            page2: page2
        })
        .done(function(data) {
            $(".box_table_cash").html('');
            $('.box_table_cash').empty().append(data);
            $("#loading").hide();
            $(".box_table_cash").show();
        });
}
load_history_card();
$(document).ready(function() {


    $('input[name="option_payment"]').bind('click', function() {
        $('.list-content li').removeClass('active');
        $(this).parent().parent('li').addClass('active');
    });
});
var type = "";

function val_type(e,type_val) {
    $('.img_active').removeClass('img_active');
    $(e).addClass('img_active');
    $('.hi').val(type_val);
    type = type_val;
}
function change_type(e,type){
    if($(e).hasClass('active')){
        
    }else{
        $('.active').removeClass('active');
        $(e).addClass('active');
        $('.card,.atm,.momo').css({
            'display': 'none'
        });
        
        $('.bot_atm_momo').hide();
        if(type == "card"){
            $('.card').css({
                'display': 'block'
            });
        }else{
            $('.'+type).css({
                'display': 'flex'
            });
            $('.bot_atm_momo').show();
        }
    }
}
$(document).ready(function() {
    $("#form").validate({
        rules: {
            type: {
                required: true
            },
            serial: {
                required: true,
                minlength: 6
            },
            code: {
                required: true,
                minlength: 6
            },
            menhgia: {
                required: true

            }
        },
        messages: {
            type: 'Bạn chưa chọn loại thẻ',
            serial: 'Bạn vui lòng nhập serial của thẻ',
            code: 'Bạn vui lòng nhập mã thẻ'
        },submitHandler: function(e) {
            if (type == "") {
                alert('Bạn chưa chọn loại thẻ');
                return false;
            }
            $('button[type="submit"]').html("ĐANG XỬ LÝ...");
            var data = new FormData();
            data.append("type", type);
            data.append("serial", $('#serial').val());
            data.append("code", $('#code').val());
            data.append("menhgia", $('#menhgia').val());
            $.ajax({
                url: "/card",
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                data: data,
                success: function(response) {
                    $('button[type="submit"]').html("NẠP THẺ");
                    swal(response.title, response.msg, response.status);
                    // swal({
                    //   title: "SweetAlert!",
                    //   text: "Here's my sweet alert!",
                    //   type: "error",
                    //   confirmButtonText: "Cool"
                    // });
                },
                error: function(xhr) {
                    alert("Thất bại");
                },
            });
            return false;
        }
    });
});