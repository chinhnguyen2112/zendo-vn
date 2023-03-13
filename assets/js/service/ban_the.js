$('.box_card').click(function() {
    if ($(this).hasClass('active_card')) {} else {
        $('#count_card').val(1);
        var type = $(this).data('val');
        var val_atm = type * 0.95;
        var val_card = val_atm * 1.25;
        $('.money_card').text(val_card.toLocaleString('en-US') + ' VNĐ');
        $('.money_atm').text(val_atm.toLocaleString('en-US') + ' VNĐ');
    }
    $('.active_card').removeClass('active_card');
    $(this).addClass('active_card');
})
$('#count_card').keypress(function() {
    if ($(this).val() > 1000) {
        $('#count_card').val(1000)
    } else if ($(this).val() < 1) {
        $('#count_card').val(1)
    }
    var val_ap = $('#count_card').val();
    var type = $('.active_card').data('val');
    var val_atm = type * 0.95 * val_ap;
    var val_card = val_atm * 1.25;
    $('.money_card').text(val_card.toLocaleString('en-US') + ' VNĐ');
    $('.money_atm').text(val_atm.toLocaleString('en-US') + ' VNĐ');
})

function up_val(e) {
    var amount = $('#count_card').val();
    var val_ap = parseInt(parseInt(amount) + 1);
    if (amount <= 999) {
        $('#count_card').val(val_ap)
        var type = $('.active_card').data('val');
        var val_atm = type * 0.95 * val_ap;
        var val_card = val_atm * 1.25;
        $('.money_card').text(val_card.toLocaleString('en-US') + ' VNĐ');
        $('.money_atm').text(val_atm.toLocaleString('en-US') + ' VNĐ');
    }
}

function down_val(e) {
    var amount = $('#count_card').val();
    var val_ap = parseInt(parseInt(amount) - 1);
    if (amount > 1) {
        $('#count_card').val(val_ap)
        var type = $('.active_card').data('val');
        var val_atm = type * 0.95 * val_ap;
        var val_card = val_atm * 1.25;
        $('.money_card').text(val_card.toLocaleString('en-US') + ' VNĐ');
        $('.money_atm').text(val_atm.toLocaleString('en-US') + ' VNĐ');
    }
}


$('.buy_card').click(function() {
    if (confirm('Bạn muốn mua đơn hàng này?')) {
        if (parseInt(id_user) > 0) {
            var type = $('.active_card').data('val');
            var amount = $('#count_card').val();
            data = new FormData();
            data.append('type', type);
            data.append('amount', amount);

            $.ajax({
                type: 'post',
                url: '/assets/ajax/buy_garena.php',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function(feedback) {
                    if (feedback.status == 1) {
                        swal({
                            title: "Thành công",
                            type: "success",
                            text: feedback.msg
                        }, function() {
                            window.location = '/lich-su-mua-hang/';
                        });
                    } else if (feedback.status == 2) {
                        swal({
                            title: "Có lỗi xảy ra",
                            type: "error",
                            text: "Bạn chưa đăng nhập!"
                        }, function() {
                            window.location = '/dang-nhap/';
                        });
                    }else{
                        swal({
                            title: "Có lỗi xảy ra",
                            type: "error",
                            text: feedback.msg
                        }, function() {
                        });
                    }

                }
            });
        } else {
            swal({
                title: "Có lỗi xảy ra",
                type: "error",
                text: "Bạn chưa đăng nhập!"
            }, function() {
                window.location = '/dang-nhap/';
            });
        }
    }
})