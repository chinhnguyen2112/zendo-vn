function pass_yc(e, id) {
	swal(
		{
			title: "Xác nhận",
			text: "Bạn có chắc chắn muốn chấp nhận yêu cầu này",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Có",
			cancelButtonText: "Không",
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		},
		function () {
			var formData = new FormData();
			formData.append("id_status", id);
			formData.append("type", 1);
			$.ajax({
				url: "/change_status_thue",
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				data: formData,
				success: function (data) {
					if (data.status == 1) {
						swal(
							{
								title: "Thành công",
								type: "success",
								text: "Cập thật thành công",
							},
							function () {
								window.location.reload();
							}
						);
					} else if (data.status == 0) {
						swal({
							title: "Thất bại",
							type: "error",
							text: "có lỗi sảy ra, vui lòng kiểm tra lại",
						});
					} else {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "Thất bại",
							},
							function () {
								window.location.href = "/";
							}
						);
					}
				},
				error: function (xhr) {
					alert("Thất bại");
				},
			});
		}
	);
}
function fail_yc(e, id) {
	swal(
		{
			title: "Xác nhận",
			text: "Bạn có chắc chắn muốn chấp nhận yêu cầu này",
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Có",
			cancelButtonText: "Không",
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		},
		function () {
			var formData = new FormData();
			formData.append("id_status", id);
			formData.append("type", 2);
			$.ajax({
				url: "/change_status_thue",
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				data: formData,
				success: function (data) {
					if (data.status == 1) {
						swal(
							{
								title: "Thành công",
								type: "success",
								text: "Cập thật thành công",
							},
							function () {
								window.location.reload();
							}
						);
					} else if (data.status == 0) {
						swal({
							title: "Thất bại",
							type: "error",
							text: "có lỗi sảy ra, vui lòng kiểm tra lại",
						});
					} else {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "Thất bại",
							},
							function () {
								window.location.href = "/";
							}
						);
					}
				},
				error: function (xhr) {
					alert("Thất bại");
				},
			});
		}
	);
}
