$(".list_img_detail img").click(function () {
	var src = $(this).attr("src").replace(".jpg", "_full.jpg");
	$(".img_full_show").attr("src", src);
	$(".popup_detail").show();
});
$(".close_popup").click(function () {
	$(".popup_detail").hide();
});
$(".chat_now").click(function () {
	window.location.href = "/message?kol=" + $(this).data("id");
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
$(".thue_user").click(function () {
	swal(
		{
			title: "Thuê idol",
			text: "Vui lòng nhập số giờ muốn thuê:",
			type: "input",
			input: "number",
			showCancelButton: true,
			closeOnConfirm: false,
			confirmButtonText: "Thuê",
			cancelButtonText: "Đóng",
		},
		function (inputValue) {
			if (inputValue === null) return false;

			if (inputValue === "") {
				swal.showInputError("Bạn cần nhập số giờ thuê!");
				return false;
			}
			var formData = new FormData();
			formData.append("amount", inputValue);
			formData.append("id_kol", $("#id_kol").val());
			$.ajax({
				url: "/thue_kol",
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
								text: "Vui lòng chờ chấp nhận từ người chơi",
							},
							function () {
								window.location.href = "/lich-su-choi/";
							}
						);
					} else if (data.status == 0) {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "có lỗi sảy ra, vui lòng kiểm tra lại",
							},
							function () {
								window.location.reload();
							}
						);
					} else if (data.status == 2) {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "Tài khoản bạn không đủ tiền vui lòng nạp thêm tiền để thực hiện chức năng này",
							},
							function () {
								window.location.href = "/nap-the/";
							}
						);
					} else if (data.status == 3) {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "KOL không tồn tại, vui lòng kiểm tra lại",
							},
							function () {
								window.location.reload();
							}
						);
					} else if (data.status == 4) {
						swal(
							{
								title: "Thất bại",
								type: "error",
								text: "Vui lòng đăng nhập để tiếp tục thao tác",
							},
							function () {
								window.location.href = "/dang-nhap/";
							}
						);
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
	$(".showSweetAlert")
		.children("fieldset")
		.children("input")
		.attr("type", "number");
});
