$('.xet-duyet').change(function () {
    var app_value = $(this).val();
    if (app_value == 4) {
        confirm('Bạn có muốn chuyển vào thùng rác không ?');
    }
    var valParent = $(this).parents('td');
    valParent.find('button').attr('data-action', app_value);
})

$('.dinh_gia_acc').change(function () {
    var app_val = $(this).val();
    var valParent = $(this).parents('td');
    valParent.find('button').attr('data-gia', app_val);
})

//Phê duyệt tài khoản acc của assmin :
$('.submit-acc').click(function () {
    var Acc_id = $(this).attr('data-id');
    var Acc_action = $(this).attr('data-action');
    var Acc_gia = $(this).attr('data-gia');
    if (Acc_action == "") {
        alert('Chọn 1 hành động khác');
    } else {
        var formData = new FormData();
        formData.append('acc_id', Acc_id)
        formData.append('acc_action', Acc_action)
        formData.append('acc_gia', Acc_gia)
        formData.append('actionType', 1)

        $.ajax({
            url: '/status_acc_post',
            type: 'POST',
            cache: false,
            data: formData,
            async: false,
            dataType: 'json',
            success: function (data) {
                if (data.status = 1) {
                    swal({
                        title: "Thành công",
                        type: "success",
                        text: data.msg
                    }, function () {
                        if (Acc_action != 3){
                            window.location.reload();
                        }
                    });
                } else {
                    alert(data);
                }
            },
            contentType: false,
            processData: false
        })
    }
})

//Show box : 
var modal = $('#myModal');
var btn = $(".myBtn");
var span = $(".close");
var btn = $(".myBtn");

btn.click(function () {
    modal.fadeIn(400);
})

span.click(function () {
    modal.fadeOut(400);
})

$('.show-reason').click(function () {
    var valData_id = $(this).attr('data-id');
    $('.submit-reason').attr('data-id', valData_id);
    var formData = new FormData();
    formData.append('acc_id', valData_id)
    formData.append('cap_nhat', 1)
    formData.append('actionType', 2)
    $.ajax({
        url: '/status_acc_post',
        type: 'POST',
        cache: false,
        data: formData,
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data.status = 1) {
                $('.content-reason').val(data.html);
            } else {
                alert('error');
            }
        },
        contentType: false,
        processData: false
    })
})

$('.submit-reason').click(function () {
    var Acc_id = $(this).attr('data-id');
    var content = $('.content-reason').val();
    var formData = new FormData();
    formData.append('acc_id', Acc_id)
    formData.append('content', content)
    formData.append('actionType', 2)
    $.ajax({
        url: '/status_acc_post',
            type: 'POST',
            cache: false,
            data: formData,
            async: false,
            dataType: 'json',
            success: function (data) {
                if (data.status = 1) {
                    swal({
                        title: "Thành công",
                        type: "success",
                        text: data.msg
                    }, function () {
                            window.location.reload();
                    });
                } else {
                    alert('error');
                }
            },
            contentType: false,
            processData: false
    })
})

$('.sort-game-1').change(function () {
    var val_select = $(this).val();
    var loai_game = $(this).attr('data-game');
    window.location.href = "/danh-sach-tai-khoan/?game=" + loai_game + "&sort=" + val_select;
})

$('.btn-search').click(function (event) {
    var loai_game = $(this).attr('data-game');
    var val_search = $('#search-game').val().trim();
    window.location.href = '/danh-sach-tai-khoan/?game=' + loai_game + '&search=' + val_search;
});

//nhấn enter ở thẻ input sẽ bắt sự kiện onclick (thanh tìm kiếm)
$('#search-game').keyup(function (event) {
    if (event.keyCode === 13) {
        var loai_game = $('.btn-search').attr('data-game');
        var val_search = $(this).val();
        window.location.href = '/danh-sach-tai-khoan/?game=' + loai_game + '&search=' + val_search;
    }
});

$('.close').click(function () {
    $('.modal').fadeOut(400);
})



$('#cb-select-all-1').click(function () {
    if (!$(this).prop('checked')) {
        $('.check-item').prop('checked', false);
    } else {
        $('.check-item').prop('checked', true);
    }
})


$('.check-item').click(function () {
    if ($(this).prop('checked')) {
        $(this).parents('.accinfo').addClass('active-2');
    } else {
        $(this).parents('.accinfo').removeClass('active-2');
    }
})

$('.sl-action').change(function () {
    var val_action = $(this).val();
    $('.bulk-apply').attr('data-action', val_action);

})
if ($('.main-content').hasClass('tab-admin')) {
    $('.lienhe.box_vxmm_main').css('display', 'none');
}
$('.xet-duyet').change(function () {
    if (($('option:selected', this).val() == '1')) {
        $(this).parent('.approve_acc').find('.dinh_gia_acc').removeClass('dis_none');
        $('.submit-acc').attr('data-gia', 0)
    } else {
        $(this).parent('.approve_acc').find('.dinh_gia_acc').addClass('dis_none');
        $('.submit-acc').attr('data-gia', "")
    }
})