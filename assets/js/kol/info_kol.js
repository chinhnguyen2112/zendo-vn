$("#cate").select2();
$.validator.addMethod(
	"valid_phone",
	function (value, element) {
		var phone_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
		return this.optional(element) || phone_regex.test(value);
	},
	""
);
$("#update_info").validate({
	onclick: false,
	rules: {
		name: {
			required: true,
		},
		email: {
			required: true,
			email: true,
		},
		phone: {
			required: true,
			valid_phone: true,
		},
	},
	messages: {
		name: {
			required: "Vui lòng nhập tên hiển thị",
		},
		email: {
			required: "Vui lòng nhập email",
			email: "Email không đúng định dạng",
		},
		phone: {
			required: "Vui lòng nhập số điện thoại",
			valid_phone: "Số điện thoại không đúng định dạng",
		},
	},
	submitHandler: function () {
		var data = new FormData($("#update_info")[0]);
		$.ajax({
			url: "/update_info_kol",
			type: "POST",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			data: data,
			success: function (data) {
				if (data.status == 1) {
					swal({
						title: "Thành công",
						type: "success",
						text: "Cập nhật thành công",
					});
				} else {
					swal({
						title: "Thất bại",
						type: "error",
						text: "Thất bại",
					});
				}
			},
			error: function (xhr) {
				alert("Thất bại");
			},
		});
		return false;
	},
});
$("#social").validate({
	onclick: false,
	rules: {
		facebook: {
			url: true,
		},
		youtube: {
			url: true,
		},
		tiktok: {
			url: true,
		},
		insta: {
			url: true,
		},
	},
	messages: {
		facebook: {
			url: "Sai định dạng Url",
		},
		youtube: {
			url: "Sai định dạng Url",
		},
		tiktok: {
			url: "Sai định dạng Url",
		},
		insta: {
			url: "Sai định dạng Url",
		},
	},
	submitHandler: function () {
		var data = new FormData($("#social")[0]);
		$.ajax({
			url: "/update_social_kol",
			type: "POST",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			data: data,
			success: function (data) {
				if (data.status == 1) {
					swal({
						title: "Thành công",
						type: "success",
						text: "Cập nhật thành công",
					});
				} else {
					swal({
						title: "Thất bại",
						type: "error",
						text: "Thất bại",
					});
				}
			},
			error: function (xhr) {
				alert("Thất bại");
			},
		});
		return false;
	},
});
$("#data_kol").validate({
	onclick: false,
	rules: {
		intro: {
			required: true,
		},
		price: {
			required: true,
		},
		"cate[]": {
			required: true,
		},
	},
	messages: {
		intro: {
			required: "Vui lòng nhập Intro bản thân",
		},
		price: {
			required: "Vui lòng nhập giá thuê",
		},
		"cate[]": {
			required: "Vui lòng chọn loại game",
		},
	},
	errorPlacement: function (error, element) {
		error.insertAfter(element);

		if (element.attr("name") == "cate[]") {
			$("#cate_error").html(error);
		}
	},
	submitHandler: function () {
		var data = new FormData($("#data_kol")[0]);
		$.ajax({
			url: "/update_data_kol",
			type: "POST",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			data: data,
			success: function (data) {
				if (data.status == 1) {
					swal({
						title: "Thành công",
						type: "success",
						text: "Cập nhật thành công",
					});
				} else {
					swal({
						title: "Thất bại",
						type: "error",
						text: "Thất bại",
					});
				}
			},
			error: function (xhr) {
				alert("Thất bại");
			},
		});
		return false;
	},
});
$("#introduce").validate({
	onclick: false,
	rules: {
		des: {
			required: true,
		},
	},
	messages: {
		des: {
			required: "Vui lòng giới thiệu về bản thân",
		},
	},
	submitHandler: function () {
		var data = new FormData($("#introduce")[0]);
		$.ajax({
			url: "/update_introduce_kol",
			type: "POST",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			data: data,
			success: function (data) {
				if (data.status == 1) {
					swal({
						title: "Thành công",
						type: "success",
						text: "Cập nhật thành công",
					});
				} else {
					swal({
						title: "Thất bại",
						type: "error",
						text: "Thất bại",
					});
				}
			},
			error: function (xhr) {
				alert("Thất bại");
			},
		});
		return false;
	},
});
$("#form_upload_img").validate({
	rules: {
		chon_anh: {
			required: true,
		},
	},
	messages: {
		chon_anh: {
			required: "Bạn chưa chọn ảnh",
		},
	},
	submitHandler: function () {
		var file_list = $("#chon_anh")[0].files;
		var flag = true;
		var data = new FormData();
		var new_arr = list_images.filter((item) => item !== "");
		if (new_arr.length == "" || new_arr.length == 0) {
			swal({
				title: "Thất bại",
				type: "error",
				text: "Bạn chưa chọn ảnh",
			});
			flag = true;
			return false;
		} else {
			flag = true;
		}
		for (var i = 0; i < new_arr.length; i++) {
			data.append("list_images[]", new_arr[i]);
		}
		if (flag == true) {
			$.ajax({
				url: "/upload_img_kol",
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				data: data,
				success: function (response) {
					if (response.status == 1) {
						swal(
							{
								title: "Thành công",
								type: "success",
								text: "Cập nhật thành công",
							},
							function () {
								location.reload();
							}
						);
					} else {
						swal({
							title: "Thất bại",
							type: "error",
							text: "Thất bại",
						});
					}
				},
				error: function (xhr) {
					alert("Thất bại");
				},
			});
			return false;
		}
	},
});
var count_num = 0;
var list_images = [];
if (window.File && window.FileList && window.FileReader) {
	$("#chon_anh").on("change", function (event) {
		// list_images = [];
		var files = event.target.files; //FileList object
		var output = $(".scroll_img");
		var val_object = $(".scroll_img").find('div[class="image-zone"]').length;
		if (val_object <= 10) {
			var count = 10 - val_object;
			if (count == 0) {
				swal({
					title: "Thất bại",
					type: "error",
					text: "Bạn đã chọn 10 ảnh vui lòng lưu lại rồi tiếp tục cập nhật thêm",
				});
				return false;
			} else {
				if (files.length <= count) {
					for (var i = 0; i < files.length; i++) {
						list_images.push(files[i]);
						var file = files[i];
						var size = files[i].size;
						if (size < 2097152) {
							if (!file.type.match("image")) continue;
							var picReader = new FileReader();
							picReader.addEventListener("load", function (event) {
								var picFile = event.target;
								var html =
									'<div class="preview-image clsFlexCenter2 img_new_upload preview-show-' +
									count_num +
									'">' +
									'<a class="image-cancel" onclick="imageCanel(' +
									count_num +
									', this)" data-no="' +
									count_num +
									'"><img src="/images/quanly/icon-close.svg"></a>' +
									'<div class="image-zone"><img  id="pro-img-' +
									count_num +
									'" class="img-t-append" src="' +
									picFile.result +
									'"></div>';
								("</div>");

								output.append(html);
								count_num = count_num + 1;
							});
							picReader.readAsDataURL(file);
						}
					}
				} else {
					if (val_object == 0) {
						swal({
							title: "Thất bại",
							type: "error",
							text:
								"Bạn đã chọn " +
								files.length +
								" ảnh, bạn chỉ được chọn " +
								count +
								" ảnh",
						});
						return false;
					} else {
						swal({
							title: "Thất bại",
							type: "error",
							text:
								"Bạn đã chọn được " +
								val_object +
								" ảnh, bạn chỉ được chọn thêm " +
								count +
								" ảnh",
						});
						return false;
					}
				}
			}
		} else {
			swal({
				title: "Thất bại",
				type: "error",
				text: "Bạn đã chọn 10 ảnh vui lòng lưu lại rồi tiếp tục cập nhật thêm",
			});
			return false;
		}
		console.log(list_images);
	});
	// $("#chon_anh").val('');
} else {
	console.log("Browser not support");
}

function imageCanel(id, e) {
	// $('.preview-show-'+id).remove();
	$(e).parent(".img_new_upload").remove();
	delete list_images[id];

	console.log(list_images);
}

function loadFile(event) {
	var fileInput = document.getElementById("user_logo");

	var filePath = fileInput.value;

	// Allowing file type
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

	if (!allowedExtensions.exec(filePath)) {
		alert("Vui lòng chọn ảnh định dạng PNG,JPEG,JPG hoặc GIF");
		fileInput.value = "";
		return false;
	} else {
		// Image preview
		if (fileInput.files && fileInput.files[0]) {
			var reader = new FileReader();
			reader.onload = function () {
				var output = document.getElementById("preview_logo");
				output.src = reader.result;
			};
			reader.readAsDataURL(event.target.files[0]);
		}
	}
}

function readFile(input) {
	if (input.files && input.files[0]) {
		$(".isLoadFile").html(input.files[0].name);
	}
}

function delete_image(id, event) {
	if (confirm("Bạn muốn xóa ảnh này?")) {
		$(event).parent().remove();
		var data = new FormData();
		data.append("vtri", id);
		$.ajax({
			url: "/delete_img_kol",
			type: "POST",
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			data: data,
			success: function (response) {
				if (response.status == 1) {
					swal(
						{
							title: "Thành công",
							type: "success",
							text: "Xóa thành công",
						},
						function () {
							location.reload();
						}
					);
				} else {
					swal({
						title: "Thất bại",
						type: "error",
						text: "Thất bại",
					});
				}
			},
			error: function (xhr) {
				alert("Thất bại");
			},
		});
	} else {
		return false;
	}
}
$(".box_img_avt").click(function () {
	$("#avatar_kol").click();
});

// xem truoc anh truoc khi upload

function preview_image(e, element) {
	var _URL = window.URL || window.webkitURL;
	var file, img;
	preview_before_upload(e, element);
}

function preview_before_upload(event, elem) {
	if (typeof FileReader == "undefined") return true;
	var elem = $(elem);
	var files = event.target.files;
	for (var i = 0, file; (file = files[i]); i++) {
		if (file.type.match("image.*")) {
			var reader = new FileReader();
			reader.onload = (function (theFile) {
				return function (event) {
					var image = event.target.result;
					$(".img_avt").attr("src", image);
				};
			})(file);
			reader.readAsDataURL(file);
		}
	}
}
$("#avatar_kol").on("change", function () {
	var arr_accept = ["jpg", "png", "gif", "jpeg"];
	var file_data = $("#avatar_kol")[0].files[0];
	var ar_name = file_data.name.split(".");
	var ext = ar_name[ar_name.length - 1].toLowerCase();
	var size = file_data.size;
	if (arr_accept.includes(ext)) {
		if (size < 1024 * 1024 * 8) {
			var data = new FormData();
			data.append("file", file_data);
			$.ajax({
				url: "/upload_avatar_kol",
				type: "POST",
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				data: data,
				success: function (data) {
					console.log(data);
					if (data.status == "1") {
						swal(
							{
								title: "Thành công",
								type: "success",
								text: "Cập nhật thành công",
							},
							function () {
								$(".img_avatar_user").attr("src", data.image);
							}
						);
					} else {
						swal({
							title: "Thất bại",
							type: "error",
							text: "Thất bại",
						});
					}
				},
				error: function (xhr) {
					alert("Thất bại");
				},
			});
		} else {
			swal({
				title: "Thất bại",
				type: "error",
				text: "Kích thước ảnh không vượt quá 8MB. Vui lòng kiểm tra lại!",
			});
			return;
		}
	} else {
		swal({
			title: "Thất bại",
			type: "error",
			text: "Ảnh không hợp lệ. Vui lòng chọn file .png, .jpg, .jpeg, .gif",
		});
		return false;
	}
});
