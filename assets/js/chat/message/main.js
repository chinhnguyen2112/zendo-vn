$(document).ready(function () {
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
		addr;

	const MAIN_PLAY = gsap.timeline({ paused: true });
	MAIN_PLAY.from("#main", { duration: 0.5, opacity: 0 });

	//getting all user list except me
	function getUserList() {
		return new Promise(function (resolve, reject) {
			//Creating new Promise Chain
			$.ajax({
				url: "Message/allUser",
				type: "get",
				async: false,
				success: function (data) {
					if (data != "") {
						resolve(data);
					}
				},
			});
		}).then(function (data) {
			//This function setting the user list
			document.getElementById("user_list").innerHTML = data; //setting data to the user list
			$.get("Message/ownerDetails", function (data) {
				jsonData = JSON.parse(data);
				phone = jsonData[0]["phone"];
				addr = jsonData[0]["address"];
				if (addr?.length != 0 && phone?.length != 0) {
				}
			});
			$(".innerBox").click(function () {
				$(".chatting_section").css("display", "");

				unique_id = $(this).find("#user_avtar").children("#hidden_id").val();
				bg_image = $(this).find("#user_avtar").find("img").attr("src");

				clearInterval(inter);
				clearInterval(inter3);

				getBlockUserData();
				setInterval(getBlockUserData, 100);

				getUserDetails(unique_id);
				inter2 = setInterval(getUserList, 1000);
				inter3 = setInterval(function () {
					getUserDetails(unique_id);
				}, 1000);
				sendUserUniqIDForMsg(unique_id, bg_image);

				inter = setInterval(function () {
					sendUserUniqIDForMsg(unique_id, bg_image);
				}, 100);
				$(".box_scroll").hide();
				$(".menu_mb").attr("onclick", "show_menu(this,1)");
				$("#chat_user_list").hide();
			});
			$(".innerBox").mouseover(function () {
				clearInterval(inter2);
			});
			$(".innerBox").mouseleave(function () {
				inter2 = setInterval(getUserList, 1000);
			});
		});
	}
	function getUserDetails(uniq_id) {
		$.post("Message/getIndividual", { data: uniq_id }, function (data) {
			var res_data = JSON.parse(data);
			setUserDetails(res_data);
		});
	}
	function setUserDetails(data) {
		var user_name = `${data[0]["name"]}`;
		var status = data[0]["user_status"];
		var avtar =
			"/" + (data[0]["avatar"] != null ? data[0]["avatar"] : "images/avt.png");
		var last_seen = data[0]["last_logout"];
		offlineOnlineIndicator(status, last_seen);
		$("#name_last_seen h6").html(user_name);
		$("#chat_profile_image").find("img").attr("src", avtar);
		$("#new_message_avtar").find("img").attr("src", avtar);
		if (data[0]["user_type"] == 2) {
			$("#name_last_seen h6").attr(
				"onclick",
				`window.location.href = "/idol-` + data[0]["id"] + `"`
			);
			$("#chat_profile_image").attr(
				"onclick",
				`window.location.href = "/idol-` + data[0]["id"] + `"`
			);
		}
		$("#mail_link").attr("href", `mailto:${data[0]["user_email"]}`);
	}

	function offlineOnlineIndicator(data, last_seen) {
		if (data == "active") {
			$("#name_last_seen p").html("Active now");
			$("#chat_profile_image #online").show();
		} else {
			$("#chat_profile_image #online").hide();
			getLastSeen(last_seen);
		}
	}
	function getLastSeen(data) {
		var { hours, min, sec } = calculateTime(data);
		if (days > 0) {
			$("#name_last_seen p").html(`Last active on ${data}`);
		} else {
			hours > 0
				? $("#name_last_seen p").html(
						`Last seen at ${hours} hours ${min} minutes ago`
				  )
				: min > 0
				? $("#name_last_seen p").html("Last seen at " + min + " minutes ago")
				: $("#name_last_seen p").html("Last seen just now");
		}
	}
	function calculateTime(data) {
		oldDate = new Date(data).getTime();
		newDate = new Date().getTime();
		differ = newDate - oldDate;
		days = Math.floor(differ / (1000 * 60 * 60 * 24));
		hours = Math.floor((differ % (1000 * 60 * 60 * 24)) / (60 * 60 * 1000));
		min = Math.floor((differ % (1000 * 60 * 60)) / (60 * 1000));
		sec = Math.floor((differ % (1000 * 60)) / 1000);
		var obj = {
			hours: hours,
			min: min,
			sec: sec,
		};
		return obj;
	}
	//sending unique_id which is clicked for messages
	function sendUserUniqIDForMsg(uniq_id, bg_image) {
		$.post("getmessage", { data: uniq_id, image: bg_image }, function (data) {
			setMessageToChatArea(data, bg_image); //setting messages to the chatting section
		});
	}
	function setMessageToChatArea(data, bg_image) {
		scrollToBottom();
		var res_data;
		if (data.length > 5) {
			$("#chat_message_area").html(data);
		} else {
			var profileName = $("#name_last_seen h6").html();
			$.ajax({
				url: "Message/setNoMessage",
				type: "post",
				async: false,
				data: { image: bg_image, name: profileName },
				success: function (data) {
					res_data = data;
				},
			});
			$("#chat_message_area").html(res_data);
		}
	}
	$("#chat_message_area").mouseenter(function () {
		chatBox.classList.add("active");
	});
	$("#chat_message_area").mouseleave(function () {
		chatBox.classList.remove("active");
	});
	function scrollToBottom() {
		inter4 = setInterval(() => {
			if (!chatBox.classList.contains("active")) {
				chatBox.scrollTop = chatBox.scrollHeight;
			}
		});
	}
	$("#search").keyup(function (e) {
		var user = document.querySelectorAll(".user");
		var name = document.querySelectorAll("#user_list h6");
		var val = this.value.toLowerCase();
		if (val.length > 0) {
			clearInterval(inter2);
			for (let i = 0; i < user.length; i++) {
				nameVal = name[i].innerHTML;
				if (nameVal.toLowerCase().indexOf(val) > -1) {
					user[i].style.display = "";
				} else {
					user[i].style.display = "none";
				}
			}
		} else {
			inter2 = setInterval(getUserList, 1000);
		}
	});
	function getCharLength() {
		const MAX_LENGTH = 200;
		var len = document.getElementById("messageText").value.length;
		if (len <= MAX_LENGTH) {
			$("#count_text").html(`${len}/200`);
		}
	}
	setInterval(getCharLength, 10);
	$("#logout").click(function (e) {
		e.preventDefault();
		var date = new Date();
		date = new Date(date);
		date = date.toLocaleString();
		$.ajax({
			url: "logout",
			type: "post",
			data: "date=" + date,
			success: function (res) {
				location.href = res;
			},
		});
	});
	//send message after button click
	$("#send_message").click(function (e) {
		var d = new Date(),
			messageHour = d.getHours(),
			messageMinute = d.getMinutes(),
			messageSec = d.getSeconds(),
			messageYear = d.getFullYear(),
			messageDate = d.getDate(),
			messageMonth = d.getMonth() + 1,
			actualDateTime = `${messageYear}-${messageMonth}-${messageDate} ${messageHour}:${messageMinute}:${messageSec}`;
		var message = $("#messageText").val();
		var data = {
			message: message,
			datetime: actualDateTime,
			uniq: unique_id,
		};
		var jsonData = JSON.stringify(data);
		$.post("sent", { data: jsonData }, function (data) {
			$("#messageText").val("");
		});
	});
	$("#messageText").on("keypress", function (e) {
		if (e.which == 13) {
			$("#send_message").click();
		}
	});
	$("#messageText");
	$("#btn_block").click(function () {
		var d = new Date(),
			messageHour = d.getHours(),
			messageMinute = d.getMinutes(),
			messageSec = d.getSeconds(),
			messageYear = d.getFullYear(),
			messageDate = d.getDate(),
			messageMonth = d.getMonth() + 1,
			actualDateTime = `${messageYear}-${messageMonth}-${messageDate} ${messageHour}:${messageMinute}:${messageSec}`;
		if (this.innerHTML == "Chặn") {
			$.post("Message/blockUser", { time: actualDateTime, uniq: unique_id });
		} else {
			$.post("Message/unBlockUser", { uniq: unique_id });
		}
	});
	//working on block & unblock program
	function getBlockUserData() {
		$.post("Message/getBlockUserData", { uniq: unique_id }, function (data) {
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
					"You both are blocked each other"
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
	Pace.on("done", function () {
		MAIN_PLAY.play();
	});
	getUserList(); //Calling the root function without interval
	// inter2 = setInterval(getUserList, 1000); //Calling the root function with interval
});
function show_menu(e, type) {
	if (type == 1) {
		$(e).attr("onclick", "show_menu(this,2)");
		$(".box_scroll").show();
	} else {
		$(e).attr("onclick", "show_menu(this,1)");
		$(".box_scroll").hide();
	}
}
