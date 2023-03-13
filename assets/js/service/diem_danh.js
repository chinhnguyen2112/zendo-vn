$('.box_day_dd').each(function() {
    if ($(this).data('day') == $('#this_day').val()) {
        if ($('#check_dd').val() == 0) {
            var text = `<img class="da_diem_danh" src="` + site_main + `images/diemdanh/da_diemdanh.png" alt="đã điểm danh">`;
            $(this).append(text)
        }
        $(this).addClass('active_day');
    }
})

function diemdanh(e) {
    data = new FormData();
    $.ajax({
        type: 'post',
        url: '/diemdanh',
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,

        success: function(feedback) {
            if (feedback.status == 0) {
                swal({
                    title: "Có lỗi xảy ra",
                    type: "error",
                    text: feedback.mess
                }, function() {});
            } else {
                swal({
                    title: "Thành Công",
                    type: "success",
                    text: feedback.mess
                }, function() {
                    window.location.reload();
                });
            }

        }
    });
}