<?php
$mysession = $_SESSION['user']['id'];
$count = count($data) - 1;
$img_u = ($_SESSION['user']['avatar'] != '') ? $_SESSION['user']['avatar'] : 'images/avt.png';
$avt = 'url(/' . $img_u . ')';
$img_send =  ($image != '') ? $image : '/images/avt.png';
$avt_send = 'url(' . $img_send . ')';
foreach ($data as $key => $val) {
    if ($val['sender_message_id'] == $mysession) {

?>
        <div id="receiver_msg_container">
            <div id="receiver_msg">
                <p class="m-0" id="receiver_ptag"><?php echo $val['message']; ?></p>
            </div>
            <div class="div_receiver_last" id="receiver_image">
            </div>
        </div>
    <?php
    } else {
    ?><div id="sender_msg_container">
            <div id="sender_image" class="div_sender_last"></div>
            <div id="sender_msg">
                <p class="m-0" id="receiver_ptag"><?php echo $val['message']; ?></p>
            </div>
        </div>
<?php
    }
}
?><script>
    $(function() {
        $('.div_receiver_last').last().css({
            'background-size': '100% 100%',
            'background-image': '<?= $avt ?>'
        });
        $('.div_sender_last').last().css({
            'background-size': '100% 100%',
            'background-image': '<?= $avt_send ?>'
        });
    });
    if (!chatBox.classList.contains("active")) {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
</script>