var page = 1;
load_blog();

function load_blog() {
    $.post("/load_chuyenmuc", {
            page: page,
            uri_tam: uri_tam,
        })
        .done(function(data) {
            $(".box_list_blog").html('');
            $('.box_list_blog').empty().append(data);
            $("#loading").hide();
            $(".box_list_blog").show();
        });
}