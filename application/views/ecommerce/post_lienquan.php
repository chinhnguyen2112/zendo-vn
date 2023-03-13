<?php

//Lấy value Rank: 



function DisInfoAcc($acc = '', $cot, $val)
{
    if ($acc != '') {
        echo (isset($acc[$cot]) && $acc[$cot] == $val) ? "selected" : "";
    }
}

//lấy danh sách Skin : 



function DisArrList($acc = '', $cot, $val)

{

    if ($acc != '') {

        $valueArray = array();


        $newArray = explode('|', $acc[$cot]);






        foreach ($newArray as $key => $value) {


            $impl = explode('-', $newArray[$key]);

            array_push($valueArray, $impl[0]);
        }


        if (in_array($val, $valueArray)) {

            echo "selected";
        } else {

            echo "";
        }
    }
}





?>

<div id="main">

    <div class="content content-ban-acc">

        <!-- main-content -->


        <div class="main-content2">


            <div class="block block-themed" style="background: none;">


                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">

                    <li class="active">

                        <a href="#lmht">Đăng Liên Quân</a>

                    </li>


                </ul>


                <div class="block-content tab-content wrapper-form borderra_10px">

                    <div class="tab-pane active" id="lmht">

                        <form id="data-lienquan" class="common-form-acc dis-flex flex-dir-col" method="post" enctype="multipart/form-data" class="form-horizontal push-5-t" novalidate="novalidate">

                            <input type="hidden" name="type_account" value="Liên Quân Mobile">

                            <?php if (isset($type_action) && $type_action == 'update') { ?>

                                <input type="hidden" name="type_action" value="update">

                                <input type="hidden" name="id_post" value="<?= $acc['id_post'] ?>">

                            <?php } ?>

                            <div class="user_pass_cont dis-flex">

                                <div class="group-form mg_bottom_10 row col-xs-6">

                                    <div class="col-xs-12 form-username">
                                        <label for="username" class="font-size17">Tên đăng nhập <span style="color:#ff0000">*</span></label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Tên đăng nhập Garena" value="<?= isset($acc['username']) ? $acc['username'] : ""; ?>">
                                        <p class="error err_username mg_bottom_uset"></p>

                                    </div>

                                </div>

                                <div class="group-form mg_bottom_10 row col-xs-6">

                                    <div class="col-xs-12 form-pass">
                                        <label for="password" class="font-size17">Mật khẩu <span style="color:#ff0000">*</span></label>
                                        <input class="form-control" type="text" id="password" name="password" placeholder="Nhap Pass" value="<?= isset($acc['password']) ? $acc['password'] : ""; ?>">
                                        <p class="error err_password mg_bottom_uset"></p>

                                    </div>

                                </div>

                            </div>

                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-12">

                                    <label for="price" class="font-size17">Giá mong muốn <span style="color:#ff0000">*</span></label>

                                    <input class="form-control" type="number" id="price" name="price" placeholder="" value="<?= isset($acc['price_atm']) ? $acc['price_atm'] : ""; ?>">

                                    <p class="error err_price mg_bottom_uset"></p>

                                </div>

                            </div>

                            <div class="skin_tuong_cont dis-flex ">

                                <div class="group-form mg_bottom_10 row col-xs-6">

                                    <div class="col-xs-12 form-gem-count">
                                        <label for="ip_count" class="font-size17">Bậc ngọc</label>
                                        <input class="form-control" type="number" id="ip_count" name="ip_count" placeholder="" value="<?= isset($acc['ip_count']) ? $acc['ip_count'] : ""; ?>">

                                    </div>

                                </div>

                                <div class="group-form mg_bottom_10 row col-xs-6">

                                    <div class="col-xs-12 form-rank">
                                        <label for="rank" class="font-size17">Rank</label>
                                        <select class="rank" name="rank" class="form-control">
                                            <option value="0" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 0); ?>>Chưa Rank</option>
                                            <option value="1" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 1); ?>>Chưa xác định</option>
                                            <option value="2" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 2); ?>>Đồng</option>
                                            <option value="3" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 3); ?>>Bạc</option>
                                            <option value="4" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 4); ?>>Vàng</option>
                                            <option value="5" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 5); ?>>Bạch Kim</option>
                                            <option value="6" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 6); ?>>Kim Cương</option>
                                            <option value="7" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 7); ?>>Cao Thủ</option>
                                            <option value="8" <?php DisInfoAcc((isset($acc) ? $acc : ''), 'rank', 8); ?>>Thách Đấu</option>
                                        </select>

                                    </div>

                                </div>

                            </div>





                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-12">

                                    <label for="champs_count" class="font-size17">Số tướng</label>

                                    <input class="form-control" type="champs_count" id="champs_count" name="champs_count" placeholder="" value="<?= isset($acc['champs_count']) ? $acc['champs_count'] : ""; ?>">

                                </div>

                            </div>

                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-12 change-select2">

                                    <label for="champs" class="font-size17">Danh sách tướng</label>

                                    <select class="form-control" name="champs[]" id="champs" multiple style="width:100%;">
                                        <option value="37" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 37); ?>>Valhein</option>
                                        <option value="34" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 34); ?>>Thane</option>
                                        <option value="38" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 38); ?>>Veera</option>
                                        <option value="17" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 17); ?>>Lữ Bố</option>
                                        <option value="21" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 21); ?>>Mina</option>
                                        <option value="15" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 15); ?>>Krixi</option>
                                        <option value="20" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 20); ?>>Mganga</option>
                                        <option value="36" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 36); ?>>Triệu Vân</option>
                                        <option value="26" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 26); ?>>Omega</option>
                                        <option value="13" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 13); ?>>Kahlii</option>
                                        <option value="41" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 41); ?>>Zephys</option>
                                        <option value="7" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 7); ?>>Điêu Thuyền</option>
                                        <option value="5" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 5); ?>>Chaugnar</option>
                                        <option value="39" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 39); ?>>Violet</option>
                                        <option value="4" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 4); ?>>Butterfly</option>
                                        <option value="27" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 27); ?>>Ormarr</option>
                                        <option value="3" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 3); ?>>Azzen'Ka</option>
                                        <option value="2" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 2); ?>>Alice</option>
                                        <option value="9" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 9); ?>>Gildur</option>
                                        <option value="40" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 40); ?>>Yorn</option>
                                        <option value="35" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 35); ?>>Toro</option>
                                        <option value="33" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 33); ?>>Taara</option>
                                        <option value="23" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 23); ?>>Nakroth</option>
                                        <option value="10" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 10); ?>>Grakk</option>
                                        <option value="1" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 1); ?>>Aleister</option>
                                        <option value="8" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 8); ?>>Fennik</option>
                                        <option value="18" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 18); ?>>Lumburr</option>
                                        <option value="24" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 24); ?>>Natalya</option>
                                        <option value="6" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 6); ?>>Cresht</option>
                                        <option value="12" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 12); ?>>Jinna</option>
                                        <option value="28" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 28); ?>>Payna</option>
                                        <option value="19" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 19); ?>>Maloch</option>
                                        <option value="25" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 25); ?>>Ngộ Không</option>
                                        <option value="14" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 14); ?>>Kriknak</option>
                                        <option value="22" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 22); ?>>Arthur</option>
                                        <option value="32" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 32); ?>>Slimz</option>
                                        <option value="11" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 11); ?>>Ilumia</option>
                                        <option value="29" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 29); ?>>Preyta</option>
                                        <option value="31" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 31); ?>>Skud</option>
                                        <option value="30" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 30); ?>>Raz</option>
                                        <option value="16" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 16); ?>>Lauriel</option>
                                        <option value="42" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 42); ?>>Batman</option>
                                        <option value="43" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 43); ?>>Airi</option>
                                        <option value="44" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 44); ?>>Zuka</option>
                                        <option value="45" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 45); ?>>Ignis</option>
                                        <option value="46" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 46); ?>>Murad</option>
                                        <option value="47" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 47); ?>>Zill</option>
                                        <option value="48" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 48); ?>>Arduin</option>
                                        <option value="49" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 49); ?>>Joker</option>
                                        <option value="50" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 50); ?>>Ryoma</option>
                                        <option value="51" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 51); ?>>Astrid</option>
                                        <option value="52" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 52); ?>>Tel'Annas</option>
                                        <option value="53" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 53); ?>>Superman</option>
                                        <option value="54" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 54); ?>>Wonder Woman</option>
                                        <option value="55" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 55); ?>>Xeniel</option>
                                        <option value="56" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 56); ?>>Kil'Groth</option>
                                        <option value="57" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 57); ?>>Moren</option>
                                        <option value="58" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 58); ?>>TeeMee</option>
                                        <option value="59" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 59); ?>>Lindis</option>
                                        <option value="60" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 60); ?>>Omen</option>
                                        <option value="61" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 61); ?>>Tulen</option>
                                        <option value="62" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 62); ?>>Liliana</option>
                                        <option value="63" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 63); ?>>Max</option>
                                        <option value="64" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 64); ?>>The Flash</option>
                                        <option value="65" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 65); ?>>Wisp</option>
                                        <option value="66" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 66); ?>>Arum</option>
                                        <option value="67" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 67); ?>>Rourke</option>
                                        <option value="68" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 68); ?>>Marja</option>
                                        <option value="69" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 69); ?>>Roxie</option>
                                        <option value="70" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 70); ?>>Baldum</option>
                                        <option value="71" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 71); ?>>Annette</option>
                                        <option value="72" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 72); ?>>Amily</option>
                                        <option value="73" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 73); ?>>Y'bneth</option>
                                        <option value="74" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 74); ?>>Elsu</option>
                                        <option value="77" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 77); ?>>Richter</option>
                                        <option value="80" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 80); ?>>Wiro</option>
                                        <option value="75" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 75); ?>>Quillen</option>
                                        <option value="76" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 76); ?>>Sephera</option>
                                        <option value="78" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 78); ?>>Florentino</option>
                                        <option value="82" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 82); ?>>Veres</option>
                                        <option value="79" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 79); ?>>D'Arcy</option>
                                        <option value="83" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 83); ?>>Hayate</option>
                                        <option value="84" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 84); ?>>Capheny</option>
                                        <option value="85" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 85); ?>>Errol</option>
                                        <option value="86" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 86); ?>>Yena</option>
                                        <option value="87" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 87); ?>>Enzo</option>
                                        <option value="88" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 88); ?>>Zip</option>
                                        <option value="89" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 89); ?>>Qi</option>
                                        <option value="90" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 90); ?>>Celica</option>
                                        <option value="91" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 91); ?>>Volkath</option>
                                        <option value="92" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 92); ?>>Krizzix</option>
                                        <option value="93" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 93); ?>>Eland'orr</option>
                                        <option value="94" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 94); ?>>Ishar</option>
                                        <option value="95" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 95); ?>>Dirak</option>
                                        <option value="96" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 96); ?>>Keera</option>
                                        <option value="97" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 97); ?>>Ata</option>
                                        <option value="98" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 98); ?>>Paine</option>
                                        <option value="99" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 99); ?>>Laville</option>
                                        <option value="100" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 100); ?>>Rouie</option>
                                        <option value="101" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 101); ?>>Zata</option>
                                        <option value="102" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 102); ?>>Allain</option>
                                        <option value="103" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 103); ?>>Thorne</option>
                                        <option value="104" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 104); ?>>Sinestrea</option>
                                        <option value="105" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 105); ?>>Dextra</option>
                                        <option value="106" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 106); ?>>Lorion</option>
                                        <option value="107" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 107); ?>>Bright</option>
                                        <option value="108" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 108); ?>>IGGY</option>
                                        <option value="109" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 109); ?>>AOI</option>
                                        <option value="110" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 110); ?>>Aya</option>
                                        <option value="111" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 111); ?>>Tachi</option>
                                        <option value="112" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 112); ?>>Yue</option>
                                        <option value="81" <?php DisArrList((isset($acc) ? $acc : ''), 'champs', 81); ?>>Yan</option>

                                    </select>

                                </div>

                            </div>

                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-12">

                                    <label for="champs_count" class="font-size17">Số Skin</label>

                                    <input class="form-control" type="text" id="skins_count" name="skins_count" placeholder="" value="<?= isset($acc['skins_count']) ? $acc['skins_count'] : ""; ?>">

                                </div>

                            </div>





                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-12">

                                    <label for="skin" class="control-label font-size17">Danh sách skin</label>

                                    <select id="skin" name="skins[]" class="form-control select2-multiple m-b-20 selectiamges" multiple onchange="//count_skin(this);" style="width:100%;">
                                        <option value="">Chọn skill</option>
                                        <option value="1" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 1); ?>>Valhein hoàng tử quạ</option>
                                        <option value="2" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 2); ?>>Valhein vũ khí tối thượng</option>
                                        <option value="3" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 3); ?>>Valhein đại công tước</option>
                                        <option value="4" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 4); ?>>Valhein quang vinh</option>
                                        <option value="5" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 5); ?>>Valhein số 7 thần sầu</option>
                                        <option value="6" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 6); ?>>Valhein khiêu chiến</option>
                                        <option value="7" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 7); ?>>Valhein cá mập nghiêm túc</option>
                                        <option value="8" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 8); ?>>Valhein hoàng tử băng</option>
                                        <option value="9" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 9); ?>>Valhein thần tài</option>
                                        <option value="10" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 10); ?>>Thane kẻ hủy diệt</option>
                                        <option value="11" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 11); ?>>Thane quang vinh</option>
                                        <option value="12" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 12); ?>>Thane mật vụ</option>
                                        <option value="13" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 13); ?>>Veera cô giáo hắc ám</option>
                                        <option value="14" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 14); ?>>Veera góa phụ giả kim</option>
                                        <option value="15" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 15); ?>>Veera nàng dơi tuyết</option>
                                        <option value="16" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 16); ?>>Veera y tá bạo loạn</option>
                                        <option value="17" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 17); ?>>Veera thiên nga đen</option>
                                        <option value="18" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 18); ?>>Veera vũ hội bóng đêm</option>
                                        <option value="19" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 19); ?>>Lữ bố tiệc bãi biển</option>
                                        <option value="20" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 20); ?>>Lữ bố nam vương</option>
                                        <option value="21" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 21); ?>>Lữ bố long kỵ sĩ</option>
                                        <option value="22" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 22); ?>>Lữ bố kỵ sĩ âm phủ</option>
                                        <option value="23" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 23); ?>>Lữ bố đặc nhiệm swat</option>
                                        <option value="24" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 24); ?>>Lữ bố tư lệnh robot</option>
                                        <option value="25" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 25); ?>>Lữ bố hỏa long chiến thần</option>
                                        <option value="26" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 26); ?>>Lữ bố ichigo kurosaki</option>
                                        <option value="27" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 27); ?>>Lữ bố thần ngọc</option>
                                        <option value="28" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 28); ?>>Mina tiệc bánh kẹo</option>
                                        <option value="29" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 29); ?>>Mina kẹo hay ghẹo</option>
                                        <option value="30" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 30); ?>>Mina lưỡi hái hoàng kim</option>
                                        <option value="31" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 31); ?>>Mina đào tạo siêu sao</option>
                                        <option value="32" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 32); ?>>Mina chị đại lắm chiêu</option>
                                        <option value="33" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 33); ?>>Mina tiểu thư đoạt hồn</option>
                                        <option value="34" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 34); ?>>Krixi công chúa bướm</option>
                                        <option value="35" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 35); ?>>Krixi xứ sở thần tiên</option>
                                        <option value="36" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 36); ?>>Krixi tiệc bãi biển</option>
                                        <option value="37" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 37); ?>>Krixi cô tiên thỏ</option>
                                        <option value="38" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 38); ?>>Krixi phó văn nghệ</option>
                                        <option value="39" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 39); ?>>Krixi tiểu yêu nữ</option>
                                        <option value="40" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 40); ?>>Krixi nữ hoàng thiên nga</option>
                                        <option value="41" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 41); ?>>Krixi thần thoại hy lạp</option>
                                        <option value="42" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 42); ?>>Krixi thủy thủ</option>
                                        <option value="43" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 43); ?>>Krixi terrible tornado</option>
                                        <option value="44" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 44); ?>>Mganga hề cung đình</option>
                                        <option value="45" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 45); ?>>Mganga tiệc bánh kẹo</option>
                                        <option value="46" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 46); ?>>Mganga pháp sư mèo</option>
                                        <option value="47" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 47); ?>>Triệu vân đoạt mệnh thương</option>
                                        <option value="48" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 48); ?>>Triệu vân quý công tử</option>
                                        <option value="49" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 49); ?>>Triệu vân dũng sĩ đồ long</option>
                                        <option value="50" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 50); ?>>Triệu vân quang vinh</option>
                                        <option value="51" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 51); ?>>Triệu vân chiến tướng mùa đông</option>
                                        <option value="52" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 52); ?>>Triệu vân kỵ sĩ tận thế</option>
                                        <option value="53" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 53); ?>>Triệu vân cẩm y vệ: hỏa long</option>
                                        <option value="54" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 54); ?>>Omega người máy xanh</option>
                                        <option value="55" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 55); ?>>Omega cỗ máy siêu tốc</option>
                                        <option value="56" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 56); ?>>Kahlii cô dâu hắc ám</option>
                                        <option value="57" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 57); ?>>Kahlii quaàng khăn đỏ</option>
                                        <option value="58" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 58); ?>>Kahlii kim cô giáo chủ</option>
                                        <option value="59" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 59); ?>>Kahlii siêu đầu bếp</option>
                                        <option value="60" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 60); ?>>Kahlii vũ hội bóng đêm</option>
                                        <option value="61" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 61); ?>>Zephys oán linh</option>
                                        <option value="62" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 62); ?>>Zephys hiệp sĩ bí ngô</option>
                                        <option value="63" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 63); ?>>Zephys dung nham</option>
                                        <option value="64" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 64); ?>>Zephys siêu việt</option>
                                        <option value="65" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 65); ?>>Zephys phi thương</option>
                                        <option value="66" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 66); ?>>Zephys tư lệnh viễn chinh</option>
                                        <option value="67" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 67); ?>>Zephys hắc vô thường</option>
                                        <option value="68" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 68); ?>>Điêu thuyền nữ vương anh đào</option>
                                        <option value="69" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 69); ?>>Điêu thuyền tiệc bãi biển</option>
                                        <option value="70" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 70); ?>>Điêu thuyền nữ y tá</option>
                                        <option value="71" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 71); ?>>Điêu thuyền wave</option>
                                        <option value="72" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 72); ?>>Điêu thuyền hoa hậu</option>
                                        <option value="73" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 73); ?>>Điêu thuyền phù thủy bí ngô</option>
                                        <option value="74" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 74); ?>>Điêu thuyền vũ điệu nghê thường</option>
                                        <option value="75" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 75); ?>>Điêu thuyền tà linh pháp trượng</option>
                                        <option value="76" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 76); ?>>Điêu thuyền mèo công nghệ</option>
                                        <option value="77" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 77); ?>>Điêu thuyền thần ngọc</option>
                                        <option value="78" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 78); ?>>Chaugnar ác mộng sinh hóa</option>
                                        <option value="79" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 79); ?>>Chaugnar quang vinh</option>
                                        <option value="80" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 80); ?>>Violet nữ hoàng pháo hoa</option>
                                        <option value="81" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 81); ?>>Violet nữ đặc cảnh</option>
                                        <option value="82" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 82); ?>>Violet phi công trẻ</option>
                                        <option value="83" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 83); ?>>Violet mèo siêu quậy</option>
                                        <option value="84" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 84); ?>>Violet tiệc bãi biển</option>
                                        <option value="85" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 85); ?>>Violet phó học tập</option>
                                        <option value="86" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 86); ?>>Violet thứ nguyên vệ thần</option>
                                        <option value="87" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 87); ?>>Violet phá hoa neon</option>
                                        <option value="88" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 88); ?>>Violet đặc dị</option>
                                        <option value="89" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 89); ?>>Violet vợ người ta</option>
                                        <option value="90" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 90); ?>>Violet tay súng siêu phàm</option>
                                        <option value="91" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 91); ?>>Violet huy chương vàng</option>
                                        <option value="92" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 92); ?>>Violet huyết ma thần</option>
                                        <option value="93" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 93); ?>>Violet lam tước</option>
                                        <option value="94" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 94); ?>>Violet thần long tỷ tỷ</option>
                                        <option value="95" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 95); ?>>Butterfly xuân nữ ngổ ngáo</option>
                                        <option value="96" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 96); ?>>Butterfly thủy thủ</option>
                                        <option value="97" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 97); ?>>Butterfly teen nữ công nghệ</option>
                                        <option value="98" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 98); ?>>Butterfly nữ quái nổi loạn</option>
                                        <option value="99" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 99); ?>>Butterfly quận chúa đế chế</option>
                                        <option value="100" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 100); ?>>Butterfly đông êm đềm</option>
                                        <option value="101" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 101); ?>>Butterfly phượng cửu thiên</option>
                                        <option value="102" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 102); ?>>Butterfly cẩm y vệ: chu tước</option>
                                        <option value="103" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 103); ?>>Butterfly asuna tia chớp</option>
                                        <option value="104" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 104); ?>>Butterfly stacia</option>
                                        <option value="105" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 105); ?>>Ormarr cựu chiến binh</option>
                                        <option value="106" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 106); ?>>Ormarr thông thỏa thích</option>
                                        <option value="107" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 107); ?>>Ormarr giáo viên thể hình</option>
                                        <option value="108" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 108); ?>>Azzen`Ka linh hồn lữ khách</option>
                                        <option value="109" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 109); ?>>Azzen`Ka kẹo hay ghẹo</option>
                                        <option value="110" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 110); ?>>Azzen`Ka quỷ diện lãng khách</option>
                                        <option value="111" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 111); ?>>Alice nhà chiêm tinh</option>
                                        <option value="112" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 112); ?>>Alice bé gấu tuyết</option>
                                        <option value="113" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 113); ?>>Alice xứ sở thần tiên</option>
                                        <option value="114" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 114); ?>>Alice dạ hội</option>
                                        <option value="115" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 115); ?>>Alice tiểu quỷ bí ngô</option>
                                        <option value="116" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 116); ?>>Alice bé du xuân</option>
                                        <option value="117" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 117); ?>>Alice tiểu tiên tử</option>
                                        <option value="118" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 118); ?>>Gildur tiệc bãi biển</option>
                                        <option value="119" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 119); ?>>Gildur phượt thủ</option>
                                        <option value="120" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 120); ?>>Gildur đại gia học viện</option>
                                        <option value="121" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 121); ?>>Gildur đại võ sư</option>
                                        <option value="122" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 122); ?>>Gildur thuyền trưởng râu bạc</option>
                                        <option value="123" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 123); ?>>Yorn cung thủ bóng đêm</option>
                                        <option value="124" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 124); ?>>Yorn thế tử nguyệt tộc</option>
                                        <option value="125" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 125); ?>>Yorn đặc nhiệm swat</option>
                                        <option value="126" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 126); ?>>Yorn phá vân tiễn</option>
                                        <option value="127" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 127); ?>>Yorn long thần soái</option>
                                        <option value="128" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 128); ?>>Yorn nam thần giáng sinh</option>
                                        <option value="129" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 129); ?>>Yorn soái ca học đường</option>
                                        <option value="130" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 130); ?>>Yorn thần thoại hy lạp</option>
                                        <option value="131" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 131); ?>>Toro đặc cảnh nypd</option>
                                        <option value="132" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 132); ?>>Toro trung phong cắm</option>
                                        <option value="133" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 133); ?>>Toro thần thoại hy lạp</option>
                                        <option value="134" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 134); ?>>Taara đại tù trưởng</option>
                                        <option value="135" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 135); ?>>Taara hỏa ngọc nữ đế</option>
                                        <option value="136" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 136); ?>>Taara tiệc bãi biển</option>
                                        <option value="137" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 137); ?>>Taara hồng môn đường chủ</option>
                                        <option value="138" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 138); ?>>Taara tư lệnh hải âu</option>
                                        <option value="139" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 139); ?>>Nakroth chiến binh hỏa ngục</option>
                                        <option value="140" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 140); ?>>Nakroth quân đoàn địa ngục</option>
                                        <option value="141" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 141); ?>>Nakroth bboy công nghệ</option>
                                        <option value="142" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 142); ?>>Nakroth khiêu chiến</option>
                                        <option value="143" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 143); ?>>Nakroth quán quân</option>
                                        <option value="144" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 144); ?>>Nakroth lôi quang sứ</option>
                                        <option value="145" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 145); ?>>Nakroth tiệc bãi biển</option>
                                        <option value="146" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 146); ?>>Nakroth thứ nguyên vệ thần</option>
                                        <option value="147" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 147); ?>>Nakroth siêu việt</option>
                                        <option value="148" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 148); ?>>Grakk thuyền trưởng râu đỏ</option>
                                        <option value="149" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 149); ?>>Grakk khô lâu đại tướng</option>
                                        <option value="150" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 150); ?>>Grakk chàng gấu tuyết</option>
                                        <option value="151" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 151); ?>>Grakk mèo thần tài</option>
                                        <option value="152" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 152); ?>>Grakk sumo</option>
                                        <option value="153" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 153); ?>>Grakk tiệc bãi biển</option>
                                        <option value="154" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 154); ?>>Aleister thiếu niên hắc ám</option>
                                        <option value="155" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 155); ?>>Aleister quang vinh</option>
                                        <option value="156" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 156); ?>>Aleister quỷ soái nguyệt tộc</option>
                                        <option value="157" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 157); ?>>Aleister siêu sao bóng rổ</option>
                                        <option value="158" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 158); ?>>Aleister âm dương sư</option>
                                        <option value="159" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 159); ?>>Fennik nhà thám hiểm</option>
                                        <option value="160" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 160); ?>>Fennik tiệc bánh kẹo</option>
                                        <option value="161" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 161); ?>>Fennik tuần lộ láu lỉnh</option>
                                        <option value="162" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 162); ?>>Fennik phi hành gia</option>
                                        <option value="163" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 163); ?>>Fennik tay đua f1</option>
                                        <option value="164" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 164); ?>>Lumburr dung nham</option>
                                        <option value="165" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 165); ?>>Lumburr cự thần viễn cổ</option>
                                        <option value="166" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 166); ?>>Natalya nghệ nhân lân</option>
                                        <option value="167" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 167); ?>>Natalya quý cô thủy tề</option>
                                        <option value="168" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 168); ?>>Natalya phó nháy nhí nhảnh</option>
                                        <option value="169" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 169); ?>>Natalya quà quái quỷ</option>
                                        <option value="170" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 170); ?>>Natalya nghiệp hỏa yêu hậu</option>
                                        <option value="171" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 171); ?>>Natalya băng tâm thần nữ</option>
                                        <option value="172" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 172); ?>>Natalya nữ quái công nghệ</option>
                                        <option value="173" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 173); ?>>Cresht thợ sửa cáp</option>
                                        <option value="174" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 174); ?>>Cresht cá cắn cáp</option>
                                        <option value="175" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 175); ?>>Cresht đại sư sushi</option>
                                        <option value="176" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 176); ?>>Jinna đại tư tế</option>
                                        <option value="177" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 177); ?>>Jinna dạ xoa vương</option>
                                        <option value="178" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 178); ?>>Jinna hỏa nhãn ma vương</option>
                                        <option value="179" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 179); ?>>Payna cảnh vệ rừng</option>
                                        <option value="180" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 180); ?>>Payna nghìn lẻ một đêm</option>
                                        <option value="181" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 181); ?>>Maloch ác ma địa ngục</option>
                                        <option value="182" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 182); ?>>Maloch tiệc hóa trang</option>
                                        <option value="183" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 183); ?>>Maloch samurai tử sĩ</option>
                                        <option value="184" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 184); ?>>Maloch đại tướng rô bốt</option>
                                        <option value="185" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 185); ?>>Maloch ông kẹ bí ngô</option>
                                        <option value="186" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 186); ?>>Maloch ác nhân vô tuyến</option>
                                        <option value="187" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 187); ?>>Maloch vũ hội bóng đêm</option>
                                        <option value="188" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 188); ?>>Ngộ Không đạo tặc</option>
                                        <option value="189" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 189); ?>>Ngộ Không hỏa nhãn kim tinh</option>
                                        <option value="190" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 190); ?>>Ngộ Không siêu việt</option>
                                        <option value="191" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 191); ?>>Ngộ Không ngộ khá trẩu</option>
                                        <option value="192" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 192); ?>>Ngộ Không siêu việt 2.0</option>
                                        <option value="193" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 193); ?>>Ngộ Không đặc vụ băng hầu</option>
                                        <option value="194" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 194); ?>>Ngộ Không nhóc tì bá đạo</option>
                                        <option value="195" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 195); ?>>Ngộ Không tề thiên ma hầu</option>
                                        <option value="196" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 196); ?>>Kriknak bọ cánh bạc</option>
                                        <option value="197" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 197); ?>>Kriknak yêu trùng cổ mộ</option>
                                        <option value="198" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 198); ?>>Kriknak st.l 162</option>
                                        <option value="199" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 199); ?>>Kriknak bọ cánh cam</option>
                                        <option value="200" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 200); ?>>Arthur hoàng kim cốt</option>
                                        <option value="201" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 201); ?>>Arthur lãnh chúa xương</option>
                                        <option value="202" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 202); ?>>Arthur si tình kiếm</option>
                                        <option value="203" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 203); ?>>Arthur siêu sao cricket</option>
                                        <option value="204" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 204); ?>>Arthur đặc cảnh băng lôi</option>
                                        <option value="205" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 205); ?>>Arthur hiệp sĩ trăng khuyết</option>
                                        <option value="206" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 206); ?>>Arthur siêu việt</option>
                                        <option value="207" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 207); ?>>Slimz thỏ thợ mỏ</option>
                                        <option value="208" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 208); ?>>Slimz chú thỏ ngọc</option>
                                        <option value="209" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 209); ?>>Slimz xứ sở thần tiên</option>
                                        <option value="210" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 210); ?>>Slimz thỏ nhồi bông</option>
                                        <option value="211" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 211); ?>>Ilumia nữ chúa tuyết</option>
                                        <option value="212" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 212); ?>>Ilumia thần mặt trời</option>
                                        <option value="213" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 213); ?>>Ilumia hồng hoa hậu</option>
                                        <option value="214" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 214); ?>>Ilumia thiên nữ áo dài</option>
                                        <option value="215" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 215); ?>>Ilumia nữ hoàng khí giới</option>
                                        <option value="216" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 216); ?>>Preyta không tặc</option>
                                        <option value="217" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 217); ?>>Preyta băng hỏa long sư</option>
                                        <option value="218" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 218); ?>>Preyta phi cơ f1</option>
                                        <option value="219" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 219); ?>>Skud sơn tặc</option>
                                        <option value="220" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 220); ?>>Skud quang vinh</option>
                                        <option value="221" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 221); ?>>Skud tà linh ma tướng</option>
                                        <option value="222" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 222); ?>>Raz đại tù trưởng</option>
                                        <option value="223" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 223); ?>>Raz băng quyền quán quân</option>
                                        <option value="224" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 224); ?>>Raz chiến thân muay thái</option>
                                        <option value="225" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 225); ?>>Raz siêu việt</option>
                                        <option value="226" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 226); ?>>Raz siêu cấp tin tặc</option>
                                        <option value="227" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 227); ?>>Raz saitama cosplay</option>
                                        <option value="228" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 228); ?>>Lauriel đọa lạc thiên sứ</option>
                                        <option value="229" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 229); ?>>Lauriel hỏa phượng hoàng</option>
                                        <option value="230" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 230); ?>>Lauriel phù thủy bí ngô</option>
                                        <option value="231" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 231); ?>>Lauriel thánh quang sứ</option>
                                        <option value="232" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 232); ?>>Lauriel hoa khôi giáng sinh</option>
                                        <option value="233" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 233); ?>>Lauriel lạc thần</option>
                                        <option value="234" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 234); ?>>Lauriel tinh vân sứ</option>
                                        <option value="235" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 235); ?>>Lauriel tiệc bãi biển</option>
                                        <option value="236" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 236); ?>>Lauriel thiên sứ công nghệ</option>
                                        <option value="237" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 237); ?>>Batman đôi cánh đại dương</option>
                                        <option value="238" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 238); ?>>Batman dơi địa ngục</option>
                                        <option value="239" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 239); ?>>Airi thích khách</option>
                                        <option value="240" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 240); ?>>Airi ninja xanh lá</option>
                                        <option value="241" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 241); ?>>Airi quái xế công nghệ</option>
                                        <option value="242" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 242); ?>>Airi cấm vệ nguyệt tộc</option>
                                        <option value="243" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 243); ?>>Airi kiemono</option>
                                        <option value="244" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 244); ?>>Airi bạch kiemono</option>
                                        <option value="245" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 245); ?>>Airi phó kiếm đạo</option>
                                        <option value="246" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 246); ?>>Airi tiệc bãi biển</option>
                                        <option value="247" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 247); ?>>Airi mỵ hồ</option>
                                        <option value="248" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 248); ?>>Airi đặc công tử điệp</option>
                                        <option value="249" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 249); ?>>Airi bích hải thánh nữ</option>
                                        <option value="250" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 250); ?>>Airi lễ hội mùa xuân</option>
                                        <option value="251" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 251); ?>>Zuka đại phú ông</option>
                                        <option value="252" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 252); ?>>Zuka giáo sư sừng sỏ</option>
                                        <option value="253" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 253); ?>>Zuka phát tài</option>
                                        <option value="254" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 254); ?>>Zuka gấu nhồi bông</option>
                                        <option value="255" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 255); ?>>Zuka diệt nguyệt nguyên soái</option>
                                        <option value="256" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 256); ?>>Zuka đầu bếp hoàng cung</option>
                                        <option value="257" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 257); ?>>Zuka mãnh hổ</option>
                                        <option value="258" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 258); ?>>Ignis hỏa thuật sư</option>
                                        <option value="259" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 259); ?>>Ignis quang vinh</option>
                                        <option value="260" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 260); ?>>Ignis bắc băng vương</option>
                                        <option value="261" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 261); ?>>Ignis thầy tế mặt trời</option>
                                        <option value="262" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 262); ?>>Murad thợ săn tiền thưởng</option>
                                        <option value="263" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 263); ?>>Murad mtp thần tượng học đường</option>
                                        <option value="264" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 264); ?>>Murad đồ thần đao</option>
                                        <option value="265" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 265); ?>>Murad siêu việt</option>
                                        <option value="266" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 266); ?>>Murad thiên tài sân cỏ</option>
                                        <option value="267" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 267); ?>>Murad điệp viên anubis</option>
                                        <option value="268" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 268); ?>>Murad đặc dị</option>
                                        <option value="269" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 269); ?>>Murad siêu việt 2.0</option>
                                        <option value="270" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 270); ?>>Murad chí tôn thần kiếm</option>
                                        <option value="271" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 271); ?>>Murad dược sĩ tình yêu</option>
                                        <option value="272" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 272); ?>>Murad byakuya kuchiki</option>
                                        <option value="273" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 273); ?>>Zill lốc địa ngục</option>
                                        <option value="274" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 274); ?>>Zill dung nham</option>
                                        <option value="275" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 275); ?>>Zill cựu thần thiên hà</option>
                                        <option value="276" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 276); ?>>Zill diệt nguyệt tử sĩ</option>
                                        <option value="277" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 277); ?>>Zill thần mộng mị</option>
                                        <option value="278" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 278); ?>>Arduin cận vệ hoàng gia</option>
                                        <option value="279" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 279); ?>>Arduin quang vinh</option>
                                        <option value="280" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 280); ?>>Arduin tà linh hiệp sĩ</option>
                                        <option value="281" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 281); ?>>Arduin chiến binh cổ đại</option>
                                        <option value="282" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 282); ?>>Joker trò đùa tử vong</option>
                                        <option value="283" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 283); ?>>Joker vua hề</option>
                                        <option value="284" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 284); ?>>Ryoma thợ săn tiền thưởng</option>
                                        <option value="285" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 285); ?>>Ryoma đại tướng nguyệt tộc</option>
                                        <option value="286" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 286); ?>>Ryoma thanh long bang chủ</option>
                                        <option value="287" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 287); ?>>Ryoma samurai huyền thoại</option>
                                        <option value="288" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 288); ?>>Ryoma dạ hội</option>
                                        <option value="289" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 289); ?>>Ryoma chiến binh cyborg</option>
                                        <option value="290" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 290); ?>>Ryoma ultraman</option>
                                        <option value="291" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 291); ?>>Ryoma đặc nhiệm giáng sinh</option>
                                        <option value="292" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 292); ?>>Astrid bạch kiếm tiểu thư</option>
                                        <option value="293" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 293); ?>>Astrid siêu sao bóng chày</option>
                                        <option value="294" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 294); ?>>Astrid tổ trưởng học đường</option>
                                        <option value="295" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 295); ?>>Astrid thần thoại hy lạp</option>
                                        <option value="296" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 296); ?>>Tel`Annas cảnh vệ rừng</option>
                                        <option value="297" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 297); ?>>Tel`Annas giám thị thân thiện</option>
                                        <option value="298" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 298); ?>>Tel`Annas chung tình tiễn</option>
                                        <option value="299" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 299); ?>>Tel`Annas thánh nữ mật hội</option>
                                        <option value="300" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 300); ?>>Tel`Annas thần sứ F.e.e x1</option>
                                        <option value="301" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 301); ?>>Tel`Annas cẩm y vệ: phi ưng</option>
                                        <option value="302" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 302); ?>>Tel`Annas dạ hội</option>
                                        <option value="303" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 303); ?>>Tel`Annas thứ nguyên vệ thần</option>
                                        <option value="304" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 304); ?>>Tel`Annas công chúa mộng mơ</option>
                                        <option value="305" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 305); ?>>Tel`Annas vũ khúc yêu hồ</option>
                                        <option value="306" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 306); ?>>Tel`Annas tân niên vệ thần</option>
                                        <option value="307" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 307); ?>>Superman chúa tể công lý</option>
                                        <option value="308" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 308); ?>>Superman bất công lý</option>
                                        <option value="309" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 309); ?>>Wonder Woman thế chiến</option>
                                        <option value="310" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 310); ?>>Xeniel thiên sứ hủy diệt</option>
                                        <option value="311" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 311); ?>>Xeniel trung vệ thép</option>
                                        <option value="312" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 312); ?>>Xeniel kim sí điểu</option>
                                        <option value="313" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 313); ?>>Xeniel tổng lãnh tinh hệ</option>
                                        <option value="314" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 314); ?>>Xeniel thần thoại hy lạp</option>
                                        <option value="315" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 315); ?>>Kil`Groth cảnh vệ biển</option>
                                        <option value="316" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 316); ?>>Kil`Groth quang vinh</option>
                                        <option value="317" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 317); ?>>Moren anh thợ điện</option>
                                        <option value="318" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 318); ?>>Moren lính cứu hỏa</option>
                                        <option value="319" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 319); ?>>TeeMee xiếc cung đình</option>
                                        <option value="320" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 320); ?>>TeeMee tay đua siêu tốc</option>
                                        <option value="321" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 321); ?>>TeeMee thần thoại hy lạp</option>
                                        <option value="322" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 322); ?>>Lindis thám tử tư</option>
                                        <option value="323" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 323); ?>>Lindis quang thánh tiễn</option>
                                        <option value="324" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 324); ?>>Lindis quang vinh</option>
                                        <option value="325" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 325); ?>>Lindis nữ vương pháo hoa</option>
                                        <option value="326" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 326); ?>>Lindis dạ tiệc</option>
                                        <option value="327" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 327); ?>>Lindis đồng phục shihakusho</option>
                                        <option value="328" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 328); ?>>Omen sĩ quan viễn chinh</option>
                                        <option value="329" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 329); ?>>Omen ám tử đao</option>
                                        <option value="330" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 330); ?>>Omen quỷ nguyệt tướng</option>
                                        <option value="331" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 331); ?>>Omen đao phủ tận thế</option>
                                        <option value="332" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 332); ?>>Omen chiến binh trăng khuyết</option>
                                        <option value="333" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 333); ?>>Omen thuyền trưởng hải tặc</option>
                                        <option value="334" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 334); ?>>Omen nhạc sĩ huyền thoại</option>
                                        <option value="335" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 335); ?>>Tulen nhà thám hiểm</option>
                                        <option value="336" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 336); ?>>Tulen tân thần thiên hà</option>
                                        <option value="337" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 337); ?>>Tulen phù thủy kiến tạo</option>
                                        <option value="338" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 338); ?>>Tulen đông êm đềm</option>
                                        <option value="339" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 339); ?>>Tulen phó kỷ luật</option>
                                        <option value="340" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 340); ?>>Tulen tân thần hoàng kim</option>
                                        <option value="341" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 341); ?>>Tulen chí tôn kiếm thiên</option>
                                        <option value="342" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 342); ?>>Tulen dạ hội</option>
                                        <option value="343" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 343); ?>>Tulen thần sứ stl79</option>
                                        <option value="344" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 344); ?>>Tulen hỏa long thần tộc</option>
                                        <option value="345" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 345); ?>>Tulen tân niên vệ thần</option>
                                        <option value="346" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 346); ?>>Liliana hồ quý phi</option>
                                        <option value="347" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 347); ?>>Liliana thần tượng âm nhạc</option>
                                        <option value="348" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 348); ?>>Liliana nguyệt mị ly</option>
                                        <option value="349" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 349); ?>>Liliana tiểu thơ anh đào</option>
                                        <option value="350" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 350); ?>>Liliana tân nguyệt mị ly</option>
                                        <option value="351" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 351); ?>>Liliana nữ thần f1</option>
                                        <option value="352" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 352); ?>>Liliana thủy thủ hồ ly</option>
                                        <option value="353" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 353); ?>>Liliana wave</option>
                                        <option value="354" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 354); ?>>Max hiệp sĩ nhí</option>
                                        <option value="355" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 355); ?>>Max găng tay vàng</option>
                                        <option value="356" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 356); ?>>Max quang vinh</option>
                                        <option value="357" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 357); ?>>Max thần đồng sinh hóa</option>
                                        <option value="358" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 358); ?>>Max thần thoại hy lạp</option>
                                        <option value="359" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 359); ?>>The Flash tia chớp tương lai</option>
                                        <option value="360" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 360); ?>>Wisp hải tặc nhí</option>
                                        <option value="361" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 361); ?>>Wisp thỏ siêu quậy</option>
                                        <option value="362" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 362); ?>>Wisp ếch nhồi bông</option>
                                        <option value="363" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 363); ?>>Wisp máy phát quà</option>
                                        <option value="364" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 364); ?>>Arum thú vệ cổ mộ</option>
                                        <option value="365" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 365); ?>>Arum vũ khúc long hổ</option>
                                        <option value="366" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 366); ?>>Arum linh tượng vu nữ</option>
                                        <option value="367" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 367); ?>>Arum vũ khúc thần sứ</option>
                                        <option value="368" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 368); ?>>Arum thỏ may mắn</option>
                                        <option value="369" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 369); ?>>Arum nữ hoàng gấu xám</option>
                                        <option value="370" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 370); ?>>Arum quản lý tài năng</option>
                                        <option value="371" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 371); ?>>Rourke pháo thủ tuộc neo</option>
                                        <option value="372" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 372); ?>>Rourke biệt đội siêu hùng</option>
                                        <option value="373" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 373); ?>>Rourke cuồng tặc</option>
                                        <option value="374" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 374); ?>>Marja linh xà tư tế</option>
                                        <option value="375" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 375); ?>>Marja hỏa ngọc nữ vương</option>
                                        <option value="376" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 376); ?>>Roxie thám tử tập sự</option>
                                        <option value="377" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 377); ?>>Roxie kèn ái tình</option>
                                        <option value="378" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 378); ?>>Roxie hầu gái</option>
                                        <option value="379" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 379); ?>>Roxie tiệc bánh kẹo</option>
                                        <option value="380" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 380); ?>>Baldum chú thợ ống nước</option>
                                        <option value="381" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 381); ?>>Baldum liệt hỏa dung nham</option>
                                        <option value="382" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 382); ?>>Baldum thần thoại hy lạp</option>
                                        <option value="383" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 383); ?>>Baldum thế giới kẹo ngọt</option>
                                        <option value="384" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 384); ?>>Annette nữ quản ga</option>
                                        <option value="385" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 385); ?>>Annette xứ sở thần tiên</option>
                                        <option value="386" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 386); ?>>Annette thần tượng âm nhạc</option>
                                        <option value="387" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 387); ?>>Annette tiệc bãi biển</option>
                                        <option value="388" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 388); ?>>Annette vân mộng tiên tử</option>
                                        <option value="389" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 389); ?>>Annette nữ sinh trung học</option>
                                        <option value="390" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 390); ?>>Amily đặc ảnh nypd</option>
                                        <option value="391" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 391); ?>>Amily đặc công nhện đỏ</option>
                                        <option value="392" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 392); ?>>Amily thư ký</option>
                                        <option value="393" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 393); ?>>Amily thỏ may mắn</option>
                                        <option value="394" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 394); ?>>Amily võ thần thiên hà</option>
                                        <option value="395" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 395); ?>>Amily amily quang vinh</option>
                                        <option value="396" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 396); ?>>Y`bneth hạt trưởng kiểm lâm</option>
                                        <option value="397" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 397); ?>>Y`bneth chiến binh lục bảo</option>
                                        <option value="398" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 398); ?>>Elsu cảnh vệ thảo nguyên</option>
                                        <option value="399" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 399); ?>>Elsu mafia</option>
                                        <option value="400" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 400); ?>>Elsu guitar tình ái</option>
                                        <option value="401" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 401); ?>>Elsu chiến binh bóng tối</option>
                                        <option value="402" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 402); ?>>Elsu sứ giả tận thế</option>
                                        <option value="403" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 403); ?>>Elsu tuyết ưng</option>
                                        <option value="404" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 404); ?>>Richter bá tước</option>
                                        <option value="405" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 405); ?>>Richter thống soái kháng chiến</option>
                                        <option value="406" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 406); ?>>Richter dạ hội</option>
                                        <option value="407" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 407); ?>>Richter thần kiếm susanoo</option>
                                        <option value="408" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 408); ?>>Quillen trưởng ngoại khoa</option>
                                        <option value="409" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 409); ?>>Quillen đặc công mãng xà</option>
                                        <option value="410" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 410); ?>>Quillen thống soái đế chế</option>
                                        <option value="411" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 411); ?>>Quillen huyết thủ nguyệt tộc</option>
                                        <option value="412" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 412); ?>>Quillen sao đỏ học đường</option>
                                        <option value="413" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 413); ?>>Quillen tà linh ma đao</option>
                                        <option value="414" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 414); ?>>Quillen hoàng kim soái vương</option>
                                        <option value="415" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 415); ?>>Quillen nghịch thiên long đế</option>
                                        <option value="416" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 416); ?>>Sephera quý tiểu thư</option>
                                        <option value="417" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 417); ?>>Sephera chiêm tinh gia</option>
                                        <option value="418" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 418); ?>>Sephera thần tượng âm nhạc</option>
                                        <option value="419" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 419); ?>>Sephera phi vụ thế kỷ</option>
                                        <option value="420" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 420); ?>>Sephera thần thoại hy lạp</option>
                                        <option value="421" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 421); ?>>Florentino vũ kiếm sư</option>
                                        <option value="422" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 422); ?>>Florentino giám sát tinh hệ</option>
                                        <option value="423" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 423); ?>>Florentino kiếm sĩ olympic</option>
                                        <option value="424" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 424); ?>>Florentino thần thoại hy lạp</option>
                                        <option value="425" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 425); ?>>Florentino seven</option>
                                        <option value="426" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 426); ?>>Florentino tà long kiếm sĩ</option>
                                        <option value="427" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 427); ?>>Veres đạo tặc</option>
                                        <option value="428" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 428); ?>>Veres gián điệp tinh hệ</option>
                                        <option value="429" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 429); ?>>Veres thần thoại hy lạp</option>
                                        <option value="430" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 430); ?>>Veres chị đại học đường</option>
                                        <option value="431" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 431); ?>>Veres thủy thần kiều diễm</option>
                                        <option value="432" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 432); ?>>D`arcy nam tước</option>
                                        <option value="433" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 433); ?>>D`arcy đô đốc tinh hệ</option>
                                        <option value="434" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 434); ?>>D`arcy pháp sư hỏa long</option>
                                        <option value="435" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 435); ?>>Hayate bạch ảnh</option>
                                        <option value="436" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 436); ?>>Hayate chiến binh trăng khuyết</option>
                                        <option value="437" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 437); ?>>Hayate ngân lang</option>
                                        <option value="438" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 438); ?>>Hayate tử thần vũ trụ</option>
                                        <option value="439" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 439); ?>>Hayate quỷ diện</option>
                                        <option value="440" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 440); ?>>Hayate kim ưng sát thủ</option>
                                        <option value="441" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 441); ?>>Hayate bạch vô thường</option>
                                        <option value="442" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 442); ?>>Capheny hầu gái</option>
                                        <option value="443" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 443); ?>>Capheny thần tượng âm nhạc</option>
                                        <option value="444" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 444); ?>>Capheny toán hóa sinh</option>
                                        <option value="445" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 445); ?>>Capheny kimono</option>
                                        <option value="446" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 446); ?>>Capheny siêu cấp tin tặc</option>
                                        <option value="447" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 447); ?>>Capheny harley quinn</option>
                                        <option value="448" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 448); ?>>Errol vượt ngục</option>
                                        <option value="449" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 449); ?>>Errol diệt nguyệt tiên phong</option>
                                        <option value="450" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 450); ?>>Errol genos</option>
                                        <option value="451" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 451); ?>>Yena khuyên bạc</option>
                                        <option value="452" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 452); ?>>Yena thỏ may mắn</option>
                                        <option value="453" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 453); ?>>Yena chiến binh nguyệt tộc</option>
                                        <option value="454" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 454); ?>>Yena hoạt náo viên</option>
                                        <option value="455" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 455); ?>>Yena nữ hoàng thể thao</option>
                                        <option value="456" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 456); ?>>Yena dạ nguyệt thánh nữ</option>
                                        <option value="457" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 457); ?>>Yena giảng viên tình ái</option>
                                        <option value="458" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 458); ?>>Yena wave</option>
                                        <option value="459" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 459); ?>>Enzo phẩm chất quý tộc</option>
                                        <option value="460" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 460); ?>>Enzo chiến binh trăng khuyết</option>
                                        <option value="461" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 461); ?>>Enzo thần thoại hy lạp</option>
                                        <option value="462" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 462); ?>>Enzo hồng hạc thị vệ</option>
                                        <option value="463" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 463); ?>>Zip gà siêu quậy</option>
                                        <option value="464" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 464); ?>>Zip tiểu đệ hổ báo</option>
                                        <option value="465" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 465); ?>>Qi tiểu long</option>
                                        <option value="466" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 466); ?>>Qi đặc vụ cáo tuyết</option>
                                        <option value="467" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 467); ?>>Qi quán quân</option>
                                        <option value="468" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 468); ?>>Qi thiếu nữ pháo hoa</option>
                                        <option value="469" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 469); ?>>Celica nữ cao bồi</option>
                                        <option value="470" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 470); ?>>Volkath dạ huyết tộc</option>
                                        <option value="471" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 471); ?>>Volkath ma kỵ tử sĩ</option>
                                        <option value="472" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 472); ?>>Volkath xung thiên thần tướng</option>
                                        <option value="473" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 473); ?>>Volkath tư lệnh viễn chinh</option>
                                        <option value="474" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 474); ?>>Krizzix cún siêu quậy</option>
                                        <option value="475" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 475); ?>>Krizzix đội đặc nhiệm</option>
                                        <option value="476" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 476); ?>>Eland`orr soái tặc</option>
                                        <option value="477" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 477); ?>>Eland`orr pphi vụ thế kỷ</option>
                                        <option value="478" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 478); ?>>Eland`orr học viện carano</option>
                                        <option value="479" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 479); ?>>Eland`orr siêu thám tử</option>
                                        <option value="480" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 480); ?>>Ishar giấc mơ ngọt ngào</option>
                                        <option value="481" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 481); ?>>Ishar tiểu thư kẹo ngọt</option>
                                        <option value="482" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 482); ?>>Ishar tiểu thư gấu trúc</option>
                                        <option value="483" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 483); ?>>Ishar lễ hội ma quái</option>
                                        <option value="484" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 484); ?>>Dirak cảnh vệ bầu trời</option>
                                        <option value="485" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 485); ?>>Dirak pháp sư trăng khuyết</option>
                                        <option value="486" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 486); ?>>Dirak quý tộc norman</option>
                                        <option value="487" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 487); ?>>Dirak ông bầu showbiz</option>
                                        <option value="488" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 488); ?>>Keera y tá lạ</option>
                                        <option value="489" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 489); ?>>Keera học viện karano</option>
                                        <option value="490" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 490); ?>>Keera sát thủ bí ngô</option>
                                        <option value="491" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 491); ?>>Keera thủy thủ</option>
                                        <option value="492" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 492); ?>>Keera tiệc bãi biển</option>
                                        <option value="493" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 493); ?>>Ata tân thủy thủ</option>
                                        <option value="494" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 494); ?>>Ata cao bồi</option>
                                        <option value="495" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 495); ?>>Ata quang vinh</option>
                                        <option value="496" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 496); ?>>Paine khúc nhạc tử vong</option>
                                        <option value="497" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 497); ?>>Paine phi vụ thế kỷ</option>
                                        <option value="498" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 498); ?>>Paine công tước máu</option>
                                        <option value="499" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 499); ?>>Laville tay đua đường phố</option>
                                        <option value="500" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 500); ?>>Laville tay súng diệt thần</option>
                                        <option value="501" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 501); ?>>Laville tay súng vô địch</option>
                                        <option value="502" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 502); ?>>Laville xạ thần tinh vệ</option>
                                        <option value="503" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 503); ?>>Laville kim quy thần vương</option>
                                        <option value="504" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 504); ?>>Rouie sứ giả vũ trụ</option>
                                        <option value="505" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 505); ?>>Rouie tuần lộc đáng yêu</option>
                                        <option value="506" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 506); ?>>Zata tư lệnh viễn chinh</option>
                                        <option value="507" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 507); ?>>Zata sứ giả tinh hệ</option>
                                        <option value="508" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 508); ?>>Zata thần mặt trời</option>
                                        <option value="509" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 509); ?>>Allain hắc kiếm sĩ kirito</option>
                                        <option value="510" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 510); ?>>Allain kirito</option>
                                        <option value="511" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 511); ?>>Allain thần mặt trời</option>
                                        <option value="512" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 512); ?>>Thorne cận vệ hoàng gia</option>
                                        <option value="513" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 513); ?>>Thorne giả kim thuật sư</option>
                                        <option value="514" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 514); ?>>Sinestrea giấc mơ trưa</option>
                                        <option value="515" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 515); ?>>Sinestrea tiểu thư băng giá</option>
                                        <option value="516" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 516); ?>>Sinestrea wave</option>
                                        <option value="517" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 517); ?>>Dextra chiến binh quyến rũ</option>
                                        <option value="518" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 518); ?>>Dextra quận chúa tuyết</option>
                                        <option value="519" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 519); ?>>Dextra quý cô tuổi dần</option>
                                        <option value="520" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 520); ?>>Lorion chiến giáp hắc ám</option>
                                        <option value="521" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 521); ?>>Bright soái ca thánh điện</option>
                                        <option value="522" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 522); ?>>Bright khiêu chiến</option>
                                        <option value="523" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 523); ?>>Bright toshiro hitsugaya</option>
                                        <option value="524" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 524); ?>>AOI sát thủ đô thị</option>
                                        <option value="525" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 525); ?>>AOI hoàng kim công chúa</option>
                                        <option value="526" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 526); ?>>IGGY tiểu hoàng đế</option>
                                        <option value="527" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 527); ?>>tachi lãng khách</option>
                                        <option value="528" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 528); ?>>aya hoạt náo viên</option>
                                        <option value="529" <?php DisArrList((isset($acc) ? $acc : ''), 'skins', 529); ?>>YUE tiểu công chúa</option>

                                    </select>

                                </div>

                            </div>

                            <!--------------->

                            <div class="group-form mg_bottom_10 row row2">

                                <label class="col-xs-12 font-size17" for="thumb">Ảnh minh họa <b data-toggle="tooltip" data-placement="right" title="Ảnh hiện ở trang chủ"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>

                                <div class="col-xs-12">

                                    <input class="currency form-control" type="file" name="thumb" accept="image/jpeg" style="display: block;" />

                                    <p class="error err_thumb mg_bottom_uset"></p>

                                </div>

                            </div>

                            <div class="group-form mg_bottom_10 row row2">

                                <label class="col-xs-12 font-size17" for="gem">Ảnh thông tin<b data-toggle="tooltip" data-placement="right" title="Mỗi ảnh sẽ là một bảng ngọc, có thể up nhiều ảnh"><i class="fa fa-question-circle"></i></b> <span style="color:#ff0000">*</span></label>

                                <div class="col-xs-12">

                                    <input class="currency form-control" type="file" name="gem[]" accept="image/jpeg" multiple style="display: block;" />

                                    <p class="error err_gem mg_bottom_uset"></p>

                                </div>

                            </div>





                            <div class="group-form mg_bottom_10 row">

                                <label class="col-xs-12 font-size17" for="note">Ghi chú <b data-toggle="tooltip" data-placement="right" title="Hiển thị ở trang chủ khi để chuột vào"><i class="fa fa-question-circle"></i></b></label>

                                <div class="col-xs-12">

                                    <textarea class="form-control" id="note" name="note" rows="4" placeholder="Enter để xuống dòng" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= isset($acc['note']) ? $acc['note'] : ""; ?></textarea>

                                </div>

                            </div>

                            <!--------------->

                            <div class="group-form mg_bottom_10 row">

                                <div class="col-xs-10">

                                    <button class="btn btn-sm btn-success" id="submit" data-action="<?= isset($type_action) ? $type_action : ""; ?>"><?= isset($type_action) ? "Cập nhật" : "Đăng bán"; ?></button>

                                </div>

                            </div>

                        </form>

                    </div>


                </div>


            </div>


        </div>


    </div>



</div>