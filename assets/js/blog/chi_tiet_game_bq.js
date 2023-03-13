
var id_voucher = 0;
var val_voucher = 0;



var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];

function strtonum(num) {
    return parseInt(num, 10);
}

mini_des_more = 4;


function format_price(div) {
    x = $(div).val();
    x = x.replace(/\./g, '');
    num = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    $(div).val(num);
}

// function alert_acc(id) {
//     swal({
//         title: "Tài Khoản Số #" + id,
//         text: "Bạn có chắc chắn muốn mua tài khoản này ?",
//         type: "info",
//         showCancelButton: true,
//         confirmButtonColor: "#DD6B55",
//         confirmButtonText: "Có",
//         cancelButtonText: "Không",
//         closeOnConfirm: false,
//         showLoaderOnConfirm: true
//     }, function() {
//         $.post("/assets/ajax/check_buy.php", {
//             id: id,
//             id_voucher: $('#id_voucher').val(),
//             val_voucher: $('#val_voucher').val()
//         }, function(data) {
//             if (data.status == "success") {
//                 swal(data.title, data.message, data.status);
//                 setTimeout(function() {
//                     window.location.href = "/lich-su-mua-hang/";
//                 }, 3000);
//             } else {
//                 swal({
//                     title: "Có lỗi xảy ra",
//                     type: "error",
//                     text: data.message
//                 }, function() {
//                     window.location = data.link;
//                 });
//             }
//         }, "json");
//     });
// }

function test_cart(id) {
    swal({
        title: "Tài Khoản Số #" + id,
        text: "Bạn có chắc chắn muốn mua tài khoản này ?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function() {
        $.post("/assets/ajax/check_buy.php", {
            id: id,
            id_voucher: $('#id_voucher').val(),
            val_voucher: $('#val_voucher').val(),
            gio_hang: 4
        }, function(data) {
            if (data.status == 1) {
                window.location.href = "/gio-hang/";
            } else {
                swal({
                    title: "Có lỗi xảy ra",
                    type: "error",
                    text: data.message
                }, function() {
                    if (data.status == 0) {
                        window.location.href = "/gio-hang/";
                    } else {
                        window.location.href = "/dang-nhap/";
                    }
                });
            }
        }, "json");
    });
}

function setCookies(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}