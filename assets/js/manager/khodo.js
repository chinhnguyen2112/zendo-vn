 // dong popup des
 $('.close_des_popup').click(function() {
    $('.des_items_popup').removeClass('des_popup_open')
    $('.des_items_popup').addClass('des_popup_none')
});

// dong popup lienhe
$('.close_popup_lienhe').click(function() {
    $('.popup_lienhe').removeClass('popup_notice_open')
    $('.popup_lienhe').addClass('popup_notice_none')
});

// dong popup ban vat pham
$('.close_popup_sell').click(function() {
    $('.popup_sell_item').removeClass('popup_notice_open')
    $('.popup_sell_item').addClass('popup_notice_none')
});

// dong pup rut vat pham
$('.close_rut_vp').click(function() {
    $('.popup_rut_vp').removeClass('popup_notice_open')
    $('.popup_rut_vp').addClass('popup_notice_none')
});
// dong popup thong bao khong the rut vat pham
$('.close_disable_item').click(function() {
    $('.popup_disable_item').removeClass('popup_notice_open')
    $('.popup_disable_item').addClass('popup_notice_none')
});

// dong popup thong bao khong du so luong de rut vat pham
$('.close_count_amount').click(function() {
    $('.popup_count_amount').removeClass('popup_notice_open')
    $('.popup_count_amount').addClass('popup_notice_none')
});


// lay thuoc tinh src cua anh
var type_item = "";

function click_img(e) {
    $('.border_item').removeClass('border_item')
    $(e).addClass('border_item')
    $('.des_items_popup').removeClass('des_popup_none')
    $('.des_items_popup').addClass('des_popup_open')
    var src_img_item = $(e).find('.img_item').attr('src')
    var item_name = $(e).find('.img_item').data('name');
    type_item = $(e).data('type')
    var count_item = $(e).find('.quantity').text();
    $('.des_img_item').attr('src', src_img_item)
    if (type_item == 1) {
        $('.item_name').text(count_qh + ' quân huy')
        $('.item_name_popup').text(count_qh + ' quân huy')
    } else {
        $('.item_name').text(item_name)
        $('.item_name_popup').text(item_name)
    }
    if (count_item != 0) {
        $('.count_item').text(count_item)

    } else {
        $('.count_item').text('x1')
    }

    var zen = $(e).data('zen');
    var des_item = $(e).data('des');
    console.log(des_item)
    $('.zen_item').text(zen.toLocaleString('en-US'));
    $('.des').text(des_item);
}

// chuc nang tim kiem
function search_item() {
    var data = new FormData();
    data.append('name', $('#search_item').val());
    data.append('type', 1);
    $.ajax({
        type: 'post',
        url: '/tim-kiem-kho-do',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,

        success: function(feedback) {
            if (feedback.status == 1) {
                $('.list_items_bag').html(feedback.html);
                $('.des_img_item').attr('src', site_main+feedback.image);
                if (feedback.type_item == 1) {
                    $('.item_name').text(feedback.qhuy + ' quân huy')
                } else {
                    $('.item_name').text(feedback.name);
                }
                $('.des').text(feedback.des);
                $('.zen_item').text(feedback.zen);
                $('.send_item').show();
            }else {
                $('.list_items_bag').html('');
                $('.des_img_item').attr('src', site_main+'images/khodo/lq_img.png');
                $('.des').text('');
                $('.zen_item').text('');
                $('.item_name').text('');
                $('.send_item').hide();
            }
        }
    });
}

// thay đổi sự kiện click bằng enter cho chức năng tìm kiếm
$('.inp_search_item').keypress(function(event) {
    if (event.keyCode == 13 || event.which == 13) {
        search_item()
    }
});

// gui du lieu len database

$('.send_item_btn').click(function() {

    var count_item = $('.border_item').find('.quantity').data('count');
    var value_use = $('.border_item').data('value_use')
    if (value_use > 1) {
        $('.notice_value_use').text('(Số lượng vật phẩm rút phải chia hết cho ' + value_use + ')')
    } else {
        $('.notice_value_use').text('(Bạn có thể rút số lượng tùy thích)')
    }
    if (value_use > 50) {
        $('.popup_disable_item').removeClass('popup_notice_none')
        $('.popup_disable_item').addClass('popup_notice_open')
    } else {
        if (count_item >= value_use) {
            $('.popup_rut_vp').removeClass('popup_notice_none')
            $('.popup_rut_vp').addClass('popup_notice_open')
        } else {

            $('.popup_count_amount').removeClass('popup_notice_none')
            $('.popup_count_amount').addClass('popup_notice_open')
        }
    }

});

$('.confirm_rut_vp').click(function() {
    $('.popup_rut_vp').removeClass('popup_notice_open')
    $('.popup_rut_vp').addClass('popup_notice_none')
    var data = new FormData();
    var id_item = $('.border_item').find('.img_item').data('id');
    var count_item = $('.border_item').find('.quantity').data('count');
    var value_use = $('.border_item').data('value_use');
    var type_item = $('.border_item').data('type');
    var qty = $('.input_qty_rut').val();
    var boi_so = qty % value_use;
    console.log(boi_so)

    if (qty > count_item) {
        $('.popup_count_amount').removeClass('popup_notice_none')
        $('.popup_count_amount').addClass('popup_notice_open')
    } else {

        if (boi_so == 0) {
            data.append('id_item', id_item);
            data.append('name', name);
            data.append('count_item', count_item);
            data.append('value_use', value_use);
            data.append('id', $('.border_item').find('.img_item').data('id'));
            data.append('type_item', type_item);
            data.append('qty', qty);
            data.append('type', 2);
            console.log(qty);
            $.ajax({
                type: 'post',
                url: '/rut-vat-pham',
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                data: data,

                success: function(feedback) {
                    if (feedback.status == 0) {
                        alert(feedback.mess)
                    } else {
                        $('.border_item').find('.quantity').text(feedback.last_count)
                        $('.popup_lienhe').removeClass('popup_notice_none')
                        $('.popup_lienhe').addClass('popup_notice_open')
                        $('.des_items_popup').removeClass('des_popup_open')
                        $('.des_items_popup').addClass('des_popup_none')
                        // $('.close_popup_lienhe').click(function() {
                        //     window.location.reload()
                        // });
                    }
                }
            });
        } else {
            $('.popup_count_amount').removeClass('popup_notice_none')
            $('.popup_count_amount').addClass('popup_notice_open')
        }
    }
})

// ban vat pham
$('.sell_item_btn').click(function() {
    $('.popup_sell_item').removeClass('popup_notice_none')
    $('.popup_sell_item').addClass('popup_notice_open')
});

$('.confirm_sell_item').click(function() {
    var count_item = parseInt($('.border_item').find('.quantity').text());
    var qty = $('.input_qty_ban').val();
    var data = new FormData();
    var zen = $('.border_item').data('zen');
    var type_item = $('.border_item').data('type');
    var count_qh = $('.border_item').data('val_item');
    // var count_item = $('.border_item').find('.quantity').text();
    // var qty = $('.input_qty_ban').val();
    data.append('zen', zen);
    data.append('qty', qty);
    data.append('type_item', type_item); 
    data.append('count_item', count_item);  
    data.append('count_qh', count_qh);
    data.append('type', 3);
    data.append('id', $('.border_item').find('.img_item').data('id'));

    $.ajax({
        type: 'post',
        url: '/ban-vat-pham',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,

        success: function(feedback) {
            if (feedback.status == 0) {
                $('.popup_count_amount').removeClass('popup_notice_none')
                $('.popup_count_amount').addClass('popup_notice_open')
            } else {
                $('.popup_sell_item').removeClass('popup_notice_open')
                $('.popup_sell_item').addClass('popup_notice_none')
                $('.border_item').find('.quantity').text(feedback.last_count)
                $('.total_zen').text('Zen: ' + feedback.zen)
                if (feedback.last_count <= 0) {
                    $('.border_item').removeClass('open_item')
                    $('.border_item').addClass('none_item')
                } else {
                    $('.border_item').removeClass('none_item')
                    $('.border_item').addClass('open_item')
                }
            }
        }
    });
})

// js input tang giam so luong
$('input.input-qty').each(function() {
    var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
    if (min == 0) {
        var d = 0
    } else d = min
    $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
            if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
            var x = Number($this.val()) + 1
            if (x <= max) d += 1
        }
        $this.attr('value', d).val(d)
    })
})