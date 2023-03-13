$('.embeded-breadcrumb').next().next().attr('onclick', '')
    var arr = [];
    var i = 0;
    $('.v-giai').find('span').each(function() {
        i = ++i;
        if (i > 1) {
            arr.push($(this).text().substr(-2, 2))
        }
    })

    function load_day() {
        $.post("/get_xsmb", {
            arr: arr,
        }).done(function(data) {
            $('.table_user_trung').find('tbody').empty().append(data);
            $('.title_xsmb').text('KHÁCH HÀNG TRÚNG THƯỞNG (' + $('#number_user_trung').val() + ')')
        });
    }
    load_day();
    function tra_thuong() {
        var list_id = $('#list_id_trung').val();
        var data = new FormData();
        data.append('list_id', list_id);
        $.ajax({
            url: '/check_xsmb',
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            data: data,
            success: function(response) {
                if (response.status == 1) {
                    swal({
                        title: "Thành Công",
                        type: "success",
                        text: response.msg
                    }, function() {
                        window.location.reload();
                    });
                } else {
                    swal({
                        title: "Thất bại",
                        type: "error",
                        text: response.msg
                    });
                }
            },
            error: function(xhr) {
                alert('Thất bại');


            }
        });
        return false;
    }