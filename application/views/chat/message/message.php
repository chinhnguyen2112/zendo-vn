<?php

if (isset($_SESSION)) {
	$image = $_SESSION['user']['avatar'];
	$name = $_SESSION['user']['name'];
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/chat/message/messagestyle.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
	<link rel="stylesheet" href="/assets/css/chat/message/loading-bar.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<title>Messager</title>
</head>

<body>
	<section id="main" class="bg-dark">
		<div id="chat_user_list">
			<div id="owner_profile_details">
				<div id="owner_avtar">
					<img src="/<?= $image; ?>" alt="avatar" onerror="this.onerror=null;this.src='/images/avt.png';">
					<div>
						<div id="online"></div>
					</div>
				</div>
				<div id="owner_profile_text" class="">
					<h6 id="owner_profile_name" class="m-0 p-0"><?php echo $name; ?></h6>
					<!-- <div id="bio">
						<p id="owner_profile_bio" class="m-0 p-0"></p>
						<i class="fas fa-edit" id="edit_icon"></i>
					</div> -->
					<a class="text-decoration-none" href="/" style="color:#e86663;"><i class="fa fa-power-off"></i> Quay lại với Zendo</a>
				</div>
				<img src="/images/menu.svg" alt="menu" class="menu_mb" onclick="show_menu(this,1)">
			</div>
			<div class="box_scroll">
				<div id="search_box_container" class="py-3">
					<input type="text" name="txt_search" class="form-control" autocomplete="off" placeholder="Tìm kiếm..." id="search">
				</div>
				<hr />
				<div id="user_list" class="py-3">
				</div>
			</div>
		</div>
		<div id="chatbox">
			<div id="data_container" class="">
				<div id="bg_image">
					<img src="/images/pchatn.png" alt="chat">
				</div>
				<h2 class="mt-0">Chào bạn! Chào mừng đến với</h2>
				<h2>Zendo Shop</h2>
				<p class="text-center my-2">Kết nối với thiết bị của bạn qua Internet. Hãy nhớ rằng bạn phải có kết nối Internet ổn định để có trải nghiệm tuyệt vời hơn.</p>
			</div>
			<div class="chatting_section" id="chat_area" style="display: none">
				<div id="header" class="py-2">
					<div id="name_details" class="pt-2">
						<img onclick="window.location.reload()" src="/images/home/arrow-right.svg" class="arrow_left" alt="quay lại">
						<div id="chat_profile_image" class="mx-2" onclick="">
							<img src="/<?= $image ?>" alt="avatar" onerror="this.onerror=null;this.src='/images/avt.png';">
							<div id="online"></div>
						</div>
						<div id="name_last_seen">
							<h6 onclick="" class="m-0 pt-2"></h6>
							<p class="m-0 py-1"></p>
						</div>
					</div>
					<div id="icons" class="px-4 pt-2">
						<div id="details_btn" class="ml-3">
							<button class="btn btn-danger" id="btn_block">Chặn</button>
						</div>
					</div>
				</div>
				<div id="chat_message_area">

				</div>
				<div id="messageBar" class="py-4 px-4">
					<div id="textBox_attachment_emoji_container">
						<div id="text_box_message">
							<input type="text" maxlength="200" name="txt_message" id="messageText" class="form-control" placeholder="Type your message">
						</div>
						<div id="text_counter">
							<p id="count_text" class="m-0 p-0"></p>
						</div>
					</div>
					<div id="sendButtonContainer">
						<button class="btn" id="send_message">
							<span class="material-icons">send</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.4/socket.io.js"></script>
	<script>
		var oldDate,
			newDate,
			days,
			hours,
			min,
			sec,
			unique_id,
			bg_image,
			inter,
			inter3,
			inter2,
			chatBox = document.getElementById("chat_message_area"),
			main = document.getElementById("main"),
			phone,
			addr, name_chat, type_user;
		var id_chat = '<?= $this->input->get('kol') ?>';
		if (Math.floor(id_chat) == id_chat && $.isNumeric(id_chat) && id_chat > 0 && id_chat != <?= $_SESSION['user']['id'] ?>) {
			var data_chat = {
				id: id_chat
			};
			$.ajax({
				type: "POST",
				url: "/get_user_mess",
				data: data_chat,
				dataType: "json",
				cache: false,
				success: function(data) {
					if (data.status == 1) {
						$(".chatting_section").show();
						unique_id = data.id;
						name_chat = data.name;
						type_user = data.type;
						bg_image = data.image
						$(".menu_mb").attr("onclick", "show_menu(this,1)");
						socket.emit('get_message', {
							id: unique_id,
							image: bg_image
						});

					}
				},
				error: function(xhr, status, error) {
					alert(error);
				},
			});
		}
		var socket = io.connect('https://chat-nodejs-t8v9.onrender.com', {
			enabledTransports: ["https"],
			transports: ['websocket', 'polling']
		});
		socket.emit('all_user', 'all_user');
		socket.on('all_user', (data) => {
			$.ajax({
				url: "/alluser",
				type: "POST",
				data: {
					id: 1
				},
				success: function(data) {
					$('#user_list').html(data);
				},
				error: function(xhr, status, error) {
					alert(error);
				},
			});
		});

		function show_mess(e) {
			$(".chatting_section").show();
			unique_id = $(e).find("#user_avtar").children("#hidden_id").val();
			bg_image = $(e).find("#user_avtar").find("img").attr("src");
			name_chat = $(e).find("#name").text();
			type_user = $(e).find("#type_user").val();
			$(".menu_mb").attr("onclick", "show_menu(this,1)");
			if ($(window).width() < 550) {
				$('.box_scroll').hide();
			}
			socket.emit('get_message', {
				id: unique_id,
				image: bg_image
			});
		}
		socket.on('get_message', function(data) {
			$.ajax({
				url: "/get_message",
				type: "POST",
				data: {
					id: unique_id,
					image: bg_image
				},
				success: function(data) {
					// scrollToBottom();
					$("#chat_profile_image").find("img").attr("src", bg_image);
					$("#name_last_seen h6").html(name_chat);
					if (type_user == 2) {
						$("#name_last_seen h6").attr(
							"onclick",
							`window.location.href = "/idol-` + unique_id + `"`
						);
						$("#chat_profile_image").attr(
							"onclick",
							`window.location.href = "/idol-` + unique_id + `"`
						);
					}
					getBlockUserData();
					var res_data;
					if (data.length > 5) {
						$("#chat_message_area").html(data);
					}
				},
				error: function(xhr, status, error) {
					alert(error);
				},
			});
		});
		$("#send_message").click(function(e) {
			var dataString = {
				message: $("#messageText").val(),
				uniq: unique_id,
			};

			$.ajax({
				type: "POST",
				url: "/send",
				data: dataString,
				dataType: "json",
				cache: false,
				success: function(data) {
					socket.emit('new_message', {
						message: data.message,
						sender_message_id: data.sender_message_id,
						receiver_message_id: data.receiver_message_id,
					});
					socket.emit('all_user', 'all_user');
					$("#messageText").val("");
				},
				error: function(xhr, status, error) {
					alert(error);
				},
			});
		});
		$("#messageText").on("keypress", function(e) {
			if (e.which == 13) {
				$("#send_message").click();
			}
		});
		socket.on('new_message', function(data) {
			if (data.sender_message_id == <?= $_SESSION['user']['id'] ?>) {
				var img_this = '<?= ($_SESSION['user']['avatar'] != '') ? $_SESSION['user']['avatar'] : 'images/avt.png'  ?>';
				$('.div_receiver_last').removeAttr('style');
				var html = `<div id="receiver_msg_container">
								<div id="receiver_msg">
									<p class="m-0" id="receiver_ptag">` + data.message + `</p>
								</div>
								<div class="div_receiver_last" id="receiver_image" style="background-size: 100% 100%; background-image:url('/` + img_this + `')">
								</div>
							</div>`;
			}
			if (data.receiver_message_id == <?= $_SESSION['user']['id'] ?>) {
				$('.div_sender_last').removeAttr('style');
				var html = `<div id="sender_msg_container">
								<div class="div_sender_last" id="sender_image" style="background-size: 100% 100%; background-image:url('` + bg_image + `')"></div>
								<div id="sender_msg">
									<p class="m-0" id="receiver_ptag">` + data.message + `</p>
								</div>
							</div>`;
			}
			$('#chat_message_area').append(html);
			chatBox.scrollTop = chatBox.scrollHeight;
		});
		$("#search").keyup(function(e) {
			var user = document.querySelectorAll(".user");
			var name = document.querySelectorAll("#user_list h6");
			var val = this.value.toLowerCase();
			console.log(val.length)
			if (val.length > 0) {
				for (let i = 0; i < user.length; i++) {
					nameVal = name[i].innerHTML;
					if (nameVal.toLowerCase().indexOf(val) > -1) {
						user[i].style.display = "";
					} else {
						user[i].style.display = "none";
					}
				}
			} else {
				socket.emit('all_user', 'all_user');
			}
		});
		if (!chatBox.classList.contains("active")) {
			chatBox.scrollTop = chatBox.scrollHeight;
		}
		$("#btn_block").click(function() {
			if (this.innerHTML == "Chặn") {
				$.post("/blockUser", {
					uniq: unique_id
				});
			} else {
				$.post("/unblockUser", {
					uniq: unique_id
				});
			}
			getBlockUserData()
		});
		//working on block & unblock program
		function getBlockUserData() {
			$.post("/getBlockUserData", {
				uniq: unique_id
			}, function(data) {
				var jsonData = JSON.parse(data);
				if (jsonData.length == 1) {
					for (var i = 0; i < jsonData.length; i++) {
						if (jsonData[i]["blocked_from"] == unique_id) {
							$("#messageText").attr("disabled", "");
							$("#messageText").attr(
								"placeholder",
								"Người dùng này hiện không muốn nhận tin nhắn."
							);
							$("#messageText").css("cursor", "no-drop");
							$("#btn_block").html("Chặn");
							$("#send_message").attr("disabled", "");
							$("#send_message").css("cursor", "no-drop");
						} else {
							$("#messageText").attr("disabled", "");
							$("#messageText").attr("placeholder", "Bạn đã chặn người dùng này");
							$("#btn_block").html("Bỏ chặn");
							$("#messageText").css("cursor", "no-drop");

							$("#send_message").attr("disabled", "");
							$("#send_message").css("cursor", "no-drop");
						}
					}
				} else if (jsonData.length == 2) {
					$("#messageText").attr("disabled", "");
					$("#messageText").attr(
						"placeholder",
						"Cả hai bạn đều bị chặn lẫn nhau"
					);
					$("#btn_block").html("Bỏ chặn");
					$("#messageText").css("cursor", "no-drop");
					$("#send_message").attr("disabled", "");
					$("#send_message").css("cursor", "no-drop");
				} else {
					$("#messageText").removeAttr("disabled");
					$("#messageText").attr("placeholder", "Bắt đầu nhập. . . .");
					$("#btn_block").html("Chặn");
					$("#messageText").css("cursor", "");
					$("#send_message").removeAttr("disabled");
					$("#send_message").css("cursor", "");
				}
			});
		}

		function show_menu(e, type) {
			if (type == 1) {
				$('.box_scroll').show();
				$(".menu_mb").attr("onclick", "show_menu(this,2)");
			} else {
				$('.box_scroll').hide();
				$(".menu_mb").attr("onclick", "show_menu(this,1)");
			}
		}
	</script>
</body>

</html>