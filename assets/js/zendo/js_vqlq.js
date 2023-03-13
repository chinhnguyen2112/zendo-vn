$("#change_type").select2({
  width: "100%",
  allowClear: true,
});

var show_name = "";
if ($(window).width() > 430) {
  show_name = ".left_box span";
  $(".text_buy_spin").text("MUA THÊM LƯỢT QUAY");
} else {
  show_name = ".text_buy_spin";
  $(".text_buy_spin").text("VÒNG QUAY NHIỆM VỤ");
}

$(".buy_spin_btn").hide();
$(".select_spin").select2();
var type_play = "luotquay_free";
var val_type = getCookie("luotquay_free");
$("#type_buy").val(type_play);
$(".li_type_lq").click(function () {
  if (type_play != $(this).data("type")) {
    $(".popup_load").show();
    $(".backg-orange").removeClass("backg-orange");
    $(this).addClass("backg-orange");
    type_play = $(this).data("type");
    setCookies("this_play", type_play, 1);
    val_type = getCookie(type_play);
    $(".span_count_play").text("Lượt: " + val_type);
    setCookies("this_play", type_play, 1);
    $(".sl_luotquay_free,.sl_luotquay,.sl_luotquay_9k,.sl_luotquay_20k").hide();

    if (type_play == "luotquay") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_acc.png");
      //
      $(".buy_by_zen").show();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay").show();
      $(show_name).text("VÒNG QUAY SIÊU PHẨM");
    } else if (type_play == "luotquay9k") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_qh.png");
      //
      $(".buy_by_zen").hide();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay_9k").show();
      $(show_name).text("VÒNG QUAY QUÂN HUY");
    } else if (type_play == "luotquay20k") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_skin.png");
      //
      $(".buy_by_zen").hide();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay_20k").show();
      $(show_name).text("VÒNG QUAY TRANG PHỤC");
    } else if (type_play == "luotquay_free") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_random.png");
      //
      $(".buy_spin_btn").hide();
      $(".sl_luotquay_free").show();
      $(show_name).text("VÒNG QUAY NHIỆM VỤ");
    }
    setTimeout(function () {
      $(".popup_load").hide();
    }, 500);

    $("#type_buy").val(type_play);
  }
});
$("#change_type").change(function () {
  if (type_play != $(this).val()) {
    $(".popup_load").show();
    $(".backg-orange").removeClass("backg-orange");
    type_play = $(this).val();
    val_type = getCookie(type_play);
    $(".span_count_play").text("Lượt: " + val_type);
    setCookies("this_play", type_play, 1);
    $(".sl_luotquay_free,.sl_luotquay,.sl_luotquay_9k,.sl_luotquay_20k").hide();
    if (type_play == "luotquay") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_acc.png");
      //
      $(".buy_by_zen").show();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay").show();
      $(show_name).text("VÒNG QUAY SIÊU PHẨM");
    } else if (type_play == "luotquay9k") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_qh.png");
      //
      $(".buy_by_zen").hide();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay_9k").show();
      $(show_name).text("VÒNG QUAY QUÂN HUY");
    } else if (type_play == "luotquay20k") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_skin.png");
      //
      $(".buy_by_zen").hide();
      $(".buy_spin_btn").css({
        display: "flex",
      });
      $(".sl_luotquay_20k").show();
      $(show_name).text("VÒNG QUAY TRANG PHỤC");
    } else if (type_play == "luotquay_free") {
      $(".img_spin_img").attr("src", site_main+"images/vqlq/vq_random.png");
      //
      $(".buy_spin_btn").hide();
      $(".sl_luotquay_free").show();
      $(show_name).text("VÒNG QUAY NHIỆM VỤ");
    }
    setTimeout(function () {
      $(".popup_load").hide();
    }, 500);
    $("#type_buy").val(type_play);
  }
});

function getRndInteger(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}
var img_flip = "";
var name = "";
var type_gift = "";
var tam = 0;
var vtri = 0;
var vtri_cu = 0;
setCookies("this_play", "luotquay_free", 1);
$(".spin-btn").click(function () {
  val_type = getCookie(type_play);
  setCookies("this_play", type_play, 1);
  if ($(".spin-btn").hasClass("spin_btn_none") == true) {
    return false;
  } else {
    $.ajax({
      url: "/random_lucky",
      type: "POST",
      data: 1,
      async: true,
      dataType: "json",
      success: function (data) {
        if (data.status == 0) {
          setCookies("url_301", "/vong-quay-lien-quan/", 1);
          $(".popup_error")
            .find(".happy_gif")
            .text("Bạn chưa đăng nhập. Vui lòng đăng nhập!");
          $(".popup_error").find(".btn_lg").show();
          $(".popup_error").show();
          return false;
        } else if (data.status == 2) {
          if (type_play == "luotquay_free") {
            $(".popup_error")
              .find(".happy_gif")
              .html(
                "Số lượt quay của bạn đã hết. Để nhận thêm lượt quay vui lòng làm nhiệm vụ theo hướng dẫn tại <a href='https://www.facebook.com/Zendoshopvn/posts/450393420248164'>Fanpage Zendo Shop</a>.<br>Khung giờ vàng Zendo Shop từ 11 giờ đến 12 giờ và từ 20 giờ đến 21 giờ các ngày trong tuần từ thứ 2 đến thứ 7 các bạn nhé!"
              );
            $(".popup_error").find(".btn_lg").hide();
            $(".popup_error").show();
          } else {
            $(".popup_error")
              .find(".happy_gif")
              .text("Số lượt quay của bạn đã hết, vui lòng kiểm tra lại !");
            $(".popup_error").find(".btn_lg").hide();
            $(".popup_error").show();
          }
          return false;
        } else {
          $(this).addClass("spin_btn_none");
          var x = document.getElementById("hi");
          x.play();
          $(".popup_play").show();
          $(".spin-btn").addClass("spin_btn_none");
          type_gift = data.type_gift;
          vtri = getRndInteger((data.stt - 1) * 45 + 1, data.stt * 45 - 1);

          setCookies(type_play, val_type - 1, 1);
          $(".span_count_play").text("Lượt: " + (val_type - 1));
          val_type = val_type - 1;
          img_flip = data.img_vip;
          name = data.name;
          tam = 360 - (tam % 360) + tam + vtri + 7200;
          $(".img_spin_img").css({
            "-webkit-transition": "all 15s ",
            transition: "all 15s",
            "-webkit-transform": "rotate(" + tam + "deg)",
            transform: "rotate(" + tam + "deg)",
            "transition-timing-function": "cubic-bezier(0.1, 0.58, 0, 0.999)",
          });
          vtri_cu = vtri;
          setTimeout(function () {
            $(".spin-btn").removeClass("spin_btn_none");
            $(".img_gif_this").attr("src", site_main + img_flip);
            $(".name_gif").text(name);
            $(".spn_text").text("bạn nhận được " + name);
            $(".popup_play").hide();
            $(".popup_happy").show();
            $(this).removeClass("spin_btn_none");
            if (type_gift == 12) {
              setCookies(type_play, parseInt(val_type + 1), 1);
              $(".span_count_play").text("Lượt: " + parseInt(val_type + 1));
            }
          }, 15100);
          // setTimeout(function () {
          // x.pause();
          // }, 17100);
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  }
});

function setCookies(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function show_popup(type) {
  var data = new FormData();
  data.append("type", type);
  if (type == 3) {
    $.ajax({
      url: "/lich-su-quay",
      type: "POST",
      data: data,
      async: true,
      dataType: "json",
      success: function (data) {
        //
        $(".tbody_his").html(data.html);
        $(".popup_hisory").show();
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  } else if (type == 5) {
    var data = new FormData();
    data.append("type", type);
    $.ajax({
      url: "/nhan-luot-quay",
      type: "POST",
      data: data,
      async: true,
      dataType: "json",
      success: function (data) {
        if (data.status == 1) {
          $(".popup_free .happy_gif").text("XIN CHÚC MỪNG");
          $(".popup_free .detail_gif").text(
            'Bạn đã nhận được 1 lượt quay tại "Vòng quay nhiệm vụ'
          );
          $(".popup_free").show();
          setCookies(
            "luotquay_free",
            parseInt(getCookie("luotquay_free")) + 1,
            1
          );
          if (type_play == "luotquay_free") {
            $(".span_count_play").text(
              "Lượt: " + parseInt(getCookie("luotquay_free"))
            );
          }
          $(".nav_noti_add").hide();
          start(1);
        } else {
          $(".popup_free .happy_gif").text("");
          $(".popup_free .detail_gif").text("Bạn đã nhận thưởng rồi!");
          $(".popup_free").show();
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  } else if (type == 1) {
    $(".popup_huong_dan").show();
  } else if (type == 2) {
    $(".popup_quy_tac").show();
  } else if (type == 4) {
    $(".popup_nhiem_vu").show();
  } else if (type == 6) {
    $(".popup_buy_spin").show();
  }
}

var h = null; // Giờ
var m = null; // Phút
var s = null; // Giây
var timeout = null; // Timeout

function start(type) {
  $(".nav_noti_add").hide();
  /*BƯỚC 1: LẤY GIÁ TRỊ BAN ĐẦU*/
  if (h === null) {
    if (type == 1) {
      h = 23;
      m = 59;
      s = 59;
    } else {
      h = h_old;
      m = i_old;
      s = s_old;
    }
  }

  /*BƯỚC 1: CHUYỂN ĐỔI DỮ LIỆU*/
  // Nếu số giây = -1 tức là đã chạy ngược hết số giây, lúc này:
  //  - giảm số phút xuống 1 đơn vị
  //  - thiết lập số giây lại 59
  if (s === -1) {
    m -= 1;
    s = 59;
  }

  // Nếu số phút = -1 tức là đã chạy ngược hết số phút, lúc này:
  //  - giảm số giờ xuống 1 đơn vị
  //  - thiết lập số phút lại 59
  if (m === -1) {
    h -= 1;
    m = 59;
  }

  // Nếu số giờ = -1 tức là đã hết giờ, lúc này:
  //  - Dừng chương trình
  if (h == -1) {
    h = null; // Giờ
    m = null; // Phút
    s = null; // Giây
    clearTimeout(timeout);
    return false;
  }

  /*BƯỚC 1: HIỂN THỊ ĐỒNG HỒ*/
  /*BƯỚC 1: GIẢM PHÚT XUỐNG 1 GIÂY VÀ GỌI LẠI SAU 1 GIÂY */
  if ((h < 1 && m < 1 && s < 1) || h > 23) {
    $(".nav_noti_add").show();
    $(".popup_free .happy_gif").text("XIN CHÚC MỪNG");
    $(".popup_free .detail_gif").text(
      'Bạn đã nhận được 1 lượt quay tại "Vòng quay nhiệm vụ"'
    );
  } else {
    timeout = setTimeout(function () {
      s--;
      start(0);
    }, 1000);
  }
}
if (parseInt(id) > 0) {
  if (parseInt(tgian) > 0) {
    $(".nav_noti_add").hide();
    start(0);
  } else {
    $(".nav_noti_add").show();
  }
}
$(".select_spin").change(function () {
  $("#type_buy").val($(this).attr("id"));
  $("#count_buy").val($(this).val());
  // giá lượt
  if ($(this).val() == 1) {
    $("#val_buy").val(10000);
  } else if ($(this).val() == 3) {
    $("#val_buy").val(28000);
  } else if ($(this).val() == 5) {
    $("#val_buy").val(44000);
  } else if ($(this).val() == 8) {
    $("#val_buy").val(73000);
  } else if ($(this).val() == 10) {
    $("#val_buy").val(91000);
  }
});
$(".buy_by_vnd").click(function () {
  if ($("#count_buy").val() == 0) {
    $(".popup_error")
      .find(".happy_gif")
      .text("Bạn chưa chọn số lượng lượt mua!");
    $(".popup_error").find(".btn_lg").hide();
    $(".popup_error").show();
  } else {
    $(".popup_confirm")
      .find(".happy_gif")
      .text(
        "Bạn muốn mua " +
          $("#count_buy").val() +
          " lượt với " +
          parseInt($("#val_buy").val()).toLocaleString(
            window.document.documentElement.lang
          ) +
          " VNĐ"
      );
    $(".popup_confirm").find(".btn_lg").attr("onclick", "buy_now(1)");
    $(".popup_confirm").show();
  }
});
$(".buy_by_zen").click(function () {
  if ($("#count_buy").val() == 0) {
    // alert('Bạn chưa chọn số lượng lượt mua!');
    $(".popup_error")
      .find(".happy_gif")
      .text("Bạn chưa chọn số lượng lượt mua!");
    $(".popup_error").find(".btn_lg").hide();
    $(".popup_error").show();
  } else {
    $(".popup_confirm")
      .find(".happy_gif")
      .text(
        "Bạn muốn mua " +
          $("#count_buy").val() +
          " lượt với " +
          (
            $("#val_buy").val() / 100 / 2 +
            $("#val_buy").val() / 100
          ).toLocaleString(window.document.documentElement.lang) +
          " Zen"
      );
    $(".popup_confirm").find(".btn_lg").attr("onclick", "buy_now(2)");
    $(".popup_confirm").show();
  }
});

function buy_now(type) {
  if (parseInt(id) > 0) {
    var data = new FormData();
    data.append("val", $("#type_buy").val());
    data.append("count", $("#count_buy").val());
    data.append("price", $("#val_buy").val());
    data.append("type", 1);
    data.append("type_buy", type);
    if ($("#count_buy").val() == 0) {
      // alert('Bạn chưa chọn số lượng lượt mua!');
      $(".popup_error")
        .find(".happy_gif")
        .text("Bạn chưa chọn số lượng lượt mua!");
      $(".popup_error").find(".btn_lg").hide();
      $(".popup_error").show();
      $(".popup_confirm").hide();
    } else {
      $.ajax({
        url: "/mua-luot-quay",
        type: "POST",
        data: data,
        async: true,
        dataType: "json",
        success: function (data) {
          //
          if (data.status == 0) {
            $(".popup_error")
              .find(".happy_gif")
              .text("Tài khoản bạn không đủ tiền. Vui lòng kiểm tra lại!");
            $(".popup_error").find(".btn_lg").hide();
            $(".popup_error").show();
            $(".popup_confirm").hide();
          } else {
            // alert('Mua lượt quay thành công!');
            $(".popup_sucess").show();
            $(".popup_confirm").hide();
            setCookies(
              $("#type_buy").val(),
              parseInt(getCookie($("#type_buy").val())) +
                parseInt($("#count_buy").val()),
              1
            );

            if (getCookie("this_play") == $("#type_buy").val()) {
              $(".span_count_play").text(
                "Lượt: " + getCookie($("#type_buy").val())
              );
            }
            $("#count_buy").val(0);
            $(".popup_buy_spin").hide();
          }
        },
        cache: false,
        contentType: false,
        processData: false,
      });
    }
  } else {
    $(".popup_confirm").hide();
    setCookies("url_301", "/vong-quay-lien-quan/", 1);
    $(".popup_error").find(".btn_lg").show();
    $(".popup_error")
      .find(".happy_gif")
      .text("Bạn chưa đăng nhập. Vui lòng đăng nhập!");
    $(".popup_error").show();
  }
}

function login_vq() {
  if (parseInt(id) > 0) {
    window.location.href = "/logout/";
  } else {
    setCookies("url_301", "/vong-quay-lien-quan/", 1);
    window.location.href = "/dang-nhap/";
  }
}

function khodo() {
  if (parseInt(id) > 0) {
    window.location.href = "/kho-do/";
  } else {
    $(".popup_error").find(".btn_lg").show();
    $(".popup_error")
      .find(".happy_gif")
      .text("Bạn chưa đăng nhập. Vui lòng đăng nhập!");
    $(".popup_error").show();
  }
}

function buy_acc(type_buy, id_acc, id_gift, e) {
  if (type_buy == 0) {
    var val_zen = $(e).parent("td").data("val");
    var text_cf = "Bạn muốn bán lại acc này với giá " + val_zen + " zen ?";
  } else {
    var text_cf = "Bạn muốn nhận acc này?";
  }

  if (confirm(text_cf)) {
    var data = new FormData();
    data.append("type_buy", type_buy);
    data.append("id_acc", id_acc);
    data.append("id_gift", id_gift);
    data.append("type", 2);
    $.ajax({
      url: "/nhan-acc-random",
      type: "POST",
      data: data,
      async: true,
      dataType: "json",
      success: function (data) {
        //
        if (data.status == 0) {
          $(".popup_error")
            .find(".happy_gif")
            .text("Đây không phải tài khoản của bạn");
          $(".popup_error").find(".btn_lg").hide();
          $(".popup_error").show();
          $(".popup_confirm").hide();
        } else if (data.status == 1) {
          $(e).parents("tr").remove();
          $(".popup_free .happy_gif").text("XIN CHÚC MỪNG");
          $(".popup_free .detail_gif").text(data.mess);
          $(".popup_free").show();
        } else if (data.status == 2) {
          $(e).parent("td").text(data.text);
          $(".popup_free .happy_gif").text("XIN CHÚC MỪNG");
          $(".popup_free .detail_gif").text(data.mess);
          $(".popup_free").show();
        }
      },
      cache: false,
      contentType: false,
      processData: false,
    });
  }
}
