<?php
$count = count($data);
for ($i = 0; $i < $count; $i++) {
	if (count($last_msg) > 0) {
?>

		<div class='innerBox'>
			<div class='user px-3 py-2'>
				<div id='avtar_and_details' class=''>
					<div id='user_avtar'>
						<img data-type="<?= $data[$i]['user_type'] ?>" src="/<?= $data[$i]['avatar'] ?>" alt="avatar" onerror="this.onerror=null;this.src='/images/avt.png';">
						<div id='online'></div>
						<input type='hidden' name='hdn' id='hidden_id' value="<?= $data[$i]['id']; ?>">
					</div>
					<div id='user_details' class='px-2'>
						<h6 class='m-0' data-type="<?= $data[$i]['user_type'] ?>" id='name'><?= ($data[$i]['name'] != '') ? $data[$i]['name'] : 'No name' ?></h6>
						<p class='m-0' id="title">
							<?php
							$output = "";
							for ($j = 0; $j < count($last_msg); $j++) {
								if ($data[$i]['id'] == $last_msg[$j]['sender_id']) {

									$output = ($last_msg[$j]['message']);
								} elseif ($data[$i]['id'] == $last_msg[$j]['receiver_id']) {

									$output = "You : " . $last_msg[$j]['message'];
								} else {
									// $output = "No message yet..";

								}
							}
							if (strlen($output) > 20) {
								echo substr($output, 0, 20) . "...";
							} else {
								echo $output;
							}
							?>
						</p>
					</div>
				</div>
				<div>
					<p id="time">
						<?php
						$messageTime = "";
						for ($j = 0; $j < count($last_msg); $j++) {
							if ($data[$i]['id'] == $last_msg[$j]['sender_id'] || $data[$i]['id'] == $last_msg[$j]['receiver_id']) {
								$messageTime = $last_msg[$j]['time'];
							}
						}
						echo $messageTime;
						?>
					</p>
				</div>
			</div>
		</div>

<?php
	}
}
?>