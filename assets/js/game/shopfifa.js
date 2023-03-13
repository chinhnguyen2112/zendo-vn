var min_price = 0; // mức giá
var max_price = 100000000;  // mức giá 
var page = 1; // số trang
var ms = ""; //id tài khoản
var order = 0;
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
    $.post("/get_list_fifa", {
        min_price: min_price,
        max_price: max_price,
        order: order,
        page: page
    })
        .done(function (data) {
            $(".list_result").html('');
            $('.list_result').empty().append(data);
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
    $.post("/get_list_fifa", {

        ms: ms,
    })
        .done(function (data) {
            $(".list_result").html('');
            $('.list_result').empty().append(data);
            $("#loading").hide();
            $(".list_result").show();
            var text_count = '<span>' + $('.tam_count').text() + '</span>'
            $('.box_count_rsl').html(text_count);
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
    source_signup = $("#source").val();
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
        max_price = 100000000;
    }
    ms = 0;
    $('#id_ac').val('');
    load_account();
});
function show_gia(e, type) {
    if (type == 1) {
        $(e).parent().find('.content_search').hide();
        $(e).attr('onclick', 'show_gia(this,2)')
    } else {
        $(e).parent().find('.content_search').show();
        $(e).attr('onclick', 'show_gia(this,1)')
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