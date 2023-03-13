var page = 1;
$('.select_skin').find('.select2-selection__rendered').text('Chọn trang phục');

// select2
$('.select_2').select2({
    'width': '100%',
    placeholder: "Chọn loại game",
    // multiple: true,
});
$('.select2-container--default .select2-selection--multiple').css({
    'background-color': 'unset',
    'border': '1px solid #6ea70c',
})
$('.select2-selection__rendered').css({
    'max-height': '80px',
    'overflow-y': 'auto',
})
$('.select2-container--default .select2-selection--multiple .select2-selection__choice').css({
    'background-color': 'unset',
    'border': 'none'
})

function load_kol() {
    $(".list_result").hide();
    $("#loading").show();
    $.post("/get_list_kol", {
        price: price,
        ms: ms,
        game: game,
        min_price: min_price,
        max_price: max_price,
        order: order,
        server: server,
        page: page
    })
        .done(function (data) {
            $(".list_result").html('');
            $('.list_result').html(data);
            $("#loading").hide();
            $(".list_result").show();
            $(".box_count_rsl").focus();
            if ($('.tam_count').text() == '2 kết quả') {
                $(".list_result").css({
                    'display': 'flex',
                    'flex-wrap': 'wrap'
                })
            } else {
                $(".list_result").css({
                    'display': 'grid'
                })
            }
            var text_count = '<span>' + $('.tam_count').text() + '</span>'
            $('.box_count_rsl').html(text_count);
        });
}

function search_id(e) {
    ms = $('#id_ac').val();
    $("input[type='checkbox']").prop('checked', false);
    load_account_full();
}

function load_account_full() {
    $(".list_result").hide();
    $("#loading").show();
    $.post("/get_list_lienquan", {
        status: status,
        // price: price,
        ms: ms,
        ngoc: ngoc,
        min_price: 0,
        max_price: 10000000,
        int_1: 0,
        int_2: 0,
        int_3: 0,
        int_4: 0,
        int_5: 0,
        int_6: 0,
        high_light: "",
        varchar_1: "",
        varchar_2: "",
        varchar_3: "",
        varchar_4: "",
        varchar_5: "",
        longtext_1: "",
        longtext_2: "",
        longtext_3: "",
        server: server,
        page: page
    })
        .done(function (data) {
            $('.list_result').html(data);
            $("#loading").hide();
            $(".list_result").show();
        });
}

function format_price(div) {
    x = $(div).val();
    x = x.replace(/\./g, '');
    num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $(div).val(num);
}

function fitler(type) {
    ms = $('#id_ac').val();
    price = $("#price").val();
    ngoc = $("#ngoc").val();
    int_5 = $("#int_5 option:selected").val();
    longtext_1 = $("#longtext_1").val();
    longtext_2 = $("#longtext_2").val();
    min_price = 0;
    max_price = 10000000;
    if (type == 1) {
        load_kol();
    } else {
        setCookies('list_buy', 0, 1);
        location.reload();
    }
}
$(document).ready(function () {
    $(".only_num").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    $(".middle ul li").click(function () {
        $(".middle ul li").removeClass("active");
        $(this).addClass("active");
        status = $(this).attr("target");
        load_kol();
    });
});


$(".content_search input[name='sex']").click(function () {
    if ($(this).prop('checked')) {
        $(".content_search input[name='sex']").prop('checked', false);
        $(this).prop('checked', true);
    }
});

function show_skin(e, type) {
    if (type == 1) {
        $(e).parent().find('.auto_skin').show();
        $(e).attr('onclick', 'show_skin(this,2)');
    } else {
        $(e).parent().find('.auto_skin').hide();
        $(e).attr('onclick', 'show_skin(this,1)');
    }
}
function active_skin(e) {
    var text_active = $(e).find('option:selected').text();
    var val_select = $(e).val();
    var html = ` <div class="box_active_skin"> <input hidden name="list_cate[]" value="` + val_select + `">
                                    <span>` + text_active + `</span>
                                    <img onclick="unactive_skin(this,'` + $.trim(text_active) + `',1)" src="` + site_main + `images/list/close.svg" alt="xóa">
                                </div>`;
    $('#skin_list_active').append(html);
    $(e).parent().find('.select2-selection__rendered').text('Chọn trang phục');
    ms = 0;
    $('#id_ac').val('');
    // load_kol();

}
// function unactive_skin(e, class_rm, type) {
//     $(e).parent('.box_active_skin').remove();
//     if (type == 1) {
//         longtext_1 = longtext_1.replace(class_rm + ',', "");
//     } else {
//         longtext_2 = longtext_2.replace(class_rm + ',', "");
//     }
//     load_kol();
// }


function show_gia(e, type) {
    if (type == 1) {
        $(e).parent().find('.content_search').hide();
        $(e).attr('onclick', 'show_gia(this,2)')
    } else {
        $(e).parent().find('.content_search').show();
        $(e).attr('onclick', 'show_gia(this,1)')
    }
}

function show_box_skin(e, type) {
    if (type == 1) {
        $(e).parent().find('.content_skin').hide();
        $(e).attr('onclick', 'show_box_skin(this,2)')
    } else {
        $(e).parent().find('.content_skin').show();
        $(e).attr('onclick', 'show_box_skin(this,1)')
    }
}

// / show lọc mobile
function show_filter(e, type) {
    if (type == 1) {
        $('.box_price, .box_ms, .box_close_fillter').show();
        $(e).attr('onclick', 'show_filter(this,2)');
    } else {
        $('.box_price, .box_ms, .box_close_fillter').hide();
        $(e).attr('onclick', 'show_filter(this,1)');
    }
}

function order_rsl(e) {
    order = $('#xap_xep').val();
    load_kol();
}
function search_kol() {
    $(".list_result").hide();
    $("#loading").show();
    var formData = new FormData($('#search_kol')[0]);
    formData.append('page', page);
    $.ajax({
        url: '/search_kol',
        type: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            $('.list_result').html(data);
            $("#loading").hide();
            $(".list_result").show();

        },
        error: function (xhr) {
            alert('Thất bại');

        }
    });
}
search_kol();