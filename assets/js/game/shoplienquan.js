
var status = 1;
var int_1 = 0;
var int_2 = 0;
var int_3 = 0;
var int_4 = 0;
var int_5 = 0;
var int_6 = 0;
var order = 0;
var varchar_1 = "";
var varchar_2 = "";
var varchar_3 = "";
var varchar_4 = "";
var varchar_5 = "";
var longtext_1 = "";
var longtext_2 = "";
var longtext_3 = "";
var server = 1;
var game = 1;
var page = 1;
var price = "";
var ms = "";
var ngoc = "";
$('.select_tuong').find('.select2-selection__rendered').text('Chọn tướng');
$('.select_skin').find('.select2-selection__rendered').text('Chọn trang phục');

// select2
$('.select_2').select2({
    'width': '100%',
    placeholder: "Chọn trang phục",
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



function setCookies(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


var min_price = 0;
var max_price = 10000000;
$(".game_opt_" + server).show();

var list_buy = getCookie('list_buy');
if (list_buy == 100000) {
    min_price = 100000;
    max_price = 199999;
} else if (list_buy == 200000) {
    min_price = 200000;
    max_price = 299999;
} else if (list_buy == 300000) {
    min_price = 300000;
    max_price = 399999;
} else if (list_buy == 400000) {
    min_price = 400000;
    max_price = 499999;
} else if (list_buy == 500000) {
    min_price = 500000;
    max_price = 999999;
} else if (list_buy == 1000000) {
    min_price = 1000000;
    max_price = 10000000;
} else if (list_buy == 50000) {
    min_price = 50000;
    max_price = 100000;
}

function fitler_div(button) {
    if ($(".fitler").css("display") == "block") {
        $(button).removeClass("active");
        $(".fitler").slideUp(1000);
    } else {
        $(button).addClass("active");
        $(".fitler").slideDown(1000);
    }

}

function load_account() {
    $(".list_result").hide();
    $("#loading").show();
    $.post("/get_list_lienquan", {
        status: status,
        price: price,
        ms: ms,
        ngoc: ngoc,
        min_price: min_price,
        max_price: max_price,
        int_1: int_1,
        int_2: int_2,
        int_3: int_3,
        int_4: int_4,
        int_5: int_5,
        int_6: int_6,
        order: order,
        varchar_1: varchar_1,
        varchar_2: varchar_2,
        varchar_3: varchar_3,
        varchar_4: varchar_4,
        varchar_5: varchar_5,
        longtext_1: longtext_1,
        longtext_2: longtext_2,
        longtext_3: longtext_3,
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
        load_account();
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
        load_account();
    });
});


load_account();

$('.gia_list').click(function () {
    if ($(this).prop('checked')) {
        $(".gia_list").prop('checked', false);
        $(this).prop('checked', true);
        min_price = $(this).data('min');
        max_price = $(this).data('max');
    } else {
        min_price = 0;
        max_price = 10000000;
    }
    ms = 0;
    $('#id_ac').val('');
    load_account();
});
$('.ngoc_list').click(function () {
    if ($(this).prop('checked')) {
        $(".ngoc_list").prop('checked', false);
        $(this).prop('checked', true);
        ngoc = $(this).data('ngoc');
    } else {
        ngoc = "";
    }
    ms = 0;
    $('#id_ac').val('');
    load_account();
});
$('.rank_list').click(function () {
    if ($(this).prop('checked')) {
        $(".rank_list").prop('checked', false);
        $(this).prop('checked', true);
        int_5 = $(this).data('rank');
    } else {
        int_5 = 0;
    }
    ms = 0;
    $('#id_ac').val('');
    load_account();
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
    var text_active = $(e).val();
    var html = ` <div class="box_active_skin">
                                    <span>` + text_active + `</span>
                                    <img onclick="unactive_skin(this,'` + $.trim(text_active) + `',1)" src="/images/sanacc/list/close.svg" alt="xóa">
                                </div>`;
    $('#skin_list_active').append(html);
    longtext_1 += $.trim(text_active) + ',';

    $(e).parent().find('.select2-selection__rendered').text('Chọn trang phục');
    ms = 0;
    $('#id_ac').val('');
    load_account();

}

function active_tuong(e) {
    var text_active = $(e).val();
    var html = ` <div class="box_active_skin ">
                                    <span>` + text_active + `</span>
                                    <img onclick="unactive_skin(this,'` + $.trim(text_active) + `',2)" src="/images/sanacc/list/close.svg" alt="xóa">
                                </div>`;
    $('#tuong_list_active').append(html);
    longtext_2 += $.trim(text_active) + ',';
    $(e).parent().find('.select2-selection__rendered').text('Chọn tướng');

    $('#id_ac').val('');
    ms = 0;
    load_account();

}

function unactive_skin(e, class_rm, type) {
    $(e).parent('.box_active_skin').remove();
    if (type == 1) {
        longtext_1 = longtext_1.replace(class_rm + ',', "");
    } else {
        longtext_2 = longtext_2.replace(class_rm + ',', "");
    }
    load_account();
}


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
    load_account();
}