var page1 = 2;
var page2 = 2;
function show_friend(e, type) {
	var data = new FormData();
	data.append("type", type);
	if (type == 1) {
		data.append("page", page1);
	} else {
		data.append("page", page2);
	}
	$.ajax({
		url: "/show_more_friend",
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		data: data,
		success: function (data) {
			if (type == 1) {
				++page1;
			} else {
				++page2;
			}
			if (data.status == 0) {
				$(e).remove();
			} else if (data.status == 1) {
				if (type == 1) {
					$(".list_user_left").append(data.html);
				} else {
					$(".list_user_right").append(data.html);
				}
				if (data.next == 0) {
					$(e).remove();
				}
			}
		},
		error: function (xhr) {
			alert("Thất bại");
		},
	});
	return false;
}
function check_thaotac(e, id, type) {
	if (type == "del") {
		swal(
			{
				title: "Xác thực xóa",
				text: "Bạn có chắc chắn muốn xóa người này?",
				type: "info",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Xóa",
				cancelButtonText: "Đóng",
				closeOnConfirm: false,
				showLoaderOnConfirm: true,
			},
			function () {
				add_friend(e, id, type);
			}
		);
	} else {
		add_friend(e, id, type);
	}
}
function add_friend(e, id, type) {
	var data = new FormData();
	data.append("type", type);
	data.append("id", id);
	$.ajax({
		url: "/add_friend",
		type: "POST",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		data: data,
		success: function (data) {
			if (data.status == 0) {
				swal({
					title: "Thất bại",
					type: "error",
					text: "Thất bại",
				});
			} else if (data.status == 1) {
				swal(
					{
						title: "Thành công",
						type: "success",
						text: "Thêm bạn bè thành công!",
					},
					function () {
						$(e).parents(".this_user_list").remove();
					}
				);
			} else if (data.status == 2) {
				swal({
					title: "Thất bại",
					type: "error",
					text: "Người dùng đã có trong danh sách bạn bè",
				});
			}
		},
		error: function (xhr) {
			alert("Thất bại");
		},
	});
	return false;
}
