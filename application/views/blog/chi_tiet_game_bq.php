 <div class="content">
     <div class="content_child">
         <div class="breadcrump">
             <a class="home_ic" href="/">
                 <img src="<?= site_main() ?>images/detail/ic_home.svg" alt="breadcums">
             </a>
             <img src="<?= site_main() ?>images/detail/ic_next_home.svg" class="ic_next" alt="next icon">
             <span class="text_bread"><?php if ($info['type'] == 1) {
                                            echo "Game bản quyền";
                                        } else {
                                            echo "Phần mềm bản quyền";
                                        }  ?></span>
             <img src="<?= site_main() ?>images/detail/ic_next_home.svg" class="ic_next" alt="next icon">
             <span class="text_bread"> <?= $info['name']; ?></span>
         </div>
         <h1 class="h1"><?= $info['name']; ?></h1>
         <div class="detail_acc">
             <div class="detail_acc_left">
                 <div class="content_detail_left">
                     <div class="img_left">
                         <?php if ($info['image'] != '') { ?>
                             <img src="<?= site_main() . $info['image']; ?>" alt="<?= $info['name']; ?>">
                         <?php } else { ?>
                             <img class="nen_rank" src="<?= site_main() ?>images/img_list_vq.png" alt="rank">

                         <?php
                            } ?>
                     </div>
                     <div class="child_right_detail">
                         <ul class="child_right_detail_ul">
                             <li class="child_right_detail_li">
                                 <div class="left">
                                     <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                     <label>Mã sản phẩm</label>
                                 </div>
                                 <p class="p_right">#<?= $info['id'] ?></p>
                             </li>
                             <li class="child_right_detail_li">
                                 <div class="left">
                                     <img src="<?= site_main() ?>images/detail/champ.svg" alt="champ">
                                     <label>Tình trạng</label>
                                 </div>
                                 <p class="p_right">Còn hàng</p>
                             </li>
                             <li class="child_right_detail_li">
                                 <div class="left">
                                     <img src="<?= site_main() ?>images/detail/note.svg" alt="note">
                                     <label>Ghi chú</label>
                                 </div>
                                 <p class="p_green p_right">Chỉ nhận thanh toán quá AMT/MOMO hoặc Zen</p>
                             </li>

                         </ul>
                     </div>
                 </div>
             </div>
             <div class="detail_acc_right">
                 <div class="right_uudai">
                     <div class="div_uudai">
                         <div class="box_title_uudai">
                             <img class="img_icon_uudai" src="<?= site_main() ?>images/detail/gift.png" alt="ưu đãi">
                             <span class="span_text_uudai">Ghi chú</span>
                         </div>
                         <div class="list_uudai">
                             <div class="box_uudai">
                                 <img class="img_box_uudai" src="<?= site_main() ?>images/detail/send.svg" alt="ưu đãi 1">
                                 <p class="p_box_uudai">Để đảm bảo tất cả các <span class="span_box_uudai">Game bản quyền</span> và <span class="span_box_uudai">Phần mền bản quyền</span> đến với quý khách hàng 1 giá ưu đãi nhất, <span class="span_box_uudai">Zendo shop</span> chỉ nhận thanh toán qua <span class="span_box_uudai">ATM/MOMO</span> hoặc <span class="span_box_uudai">Zen</span>.</p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="right_detail_ul">
                     <div class="box_top_right_detail">
                         <div class="right_detail_li right_detail_li_first ">
                             <p class="money"><?php echo number_format($info["price"], 0, '.', '.'); ?> VNĐ</p>
                             <p class="p_green">Thanh toán bằng MOMO/ATM</p>
                         </div>
                         <div class="right_detail_li">
                             <p class="money money_atm"><?php echo number_format(($info["price"] * 0.0125), 0, '.', '.'); ?> ZEN</p>
                             <p class="p_green">Thanh toán bằng Zen</p>
                         </div>
                     </div>
                     <div class="right_detail_li right_detail_li_buy">
                         <button> Mua ngay</button>

                     </div>
                     <div class="right_detail_li right_detail_li_type">
                         <img src="<?= site_main() ?>images/detail/atm_banking.png" alt="atm">
                         <img src="<?= site_main() ?>images/detail/visa.png" alt="visa">
                         <img src="<?= site_main() ?>images/detail/paypal.png" alt="paypal">
                         <img src="<?= site_main() ?>images/detail/momo.png" alt="momo">
                     </div>
                 </div>
             </div>
         </div>
         <div class="change_content">
             <ul class="change_content_ul">
                 <li class="change_content_li active" data-active="1">THÔNG TIN</li>
             </ul>
             <?php if ($info['note'] != '') { ?>
                 <div class="main_change q-content_suggest">
                     <div class="content_suggest_v2"><?= $info['note'] ?></div>
                 </div>
             <?php } ?>
             <div class="main_change">
                 <div class="content_blog t_detail_left" id="t_detail_content">
                     <div name="content-thu t_detail_content" id="content-thu">
                         <?php
                            $replace_http =  $info['des'];
                            $replace_http = str_replace('/assets',site_main().'assets',$replace_http);
                            echo str_replace('font-size:14px', '', $replace_http);
                            ?>
                     </div>
                     <!-- hết phần mục lục -->
                 </div>
             </div>
         </div>

     </div>
 </div>



 <script>
     var id_user = '<?= (isset($_SESSION['user'])) ? $_SESSION['user']['id'] : 0 ?>';
 </script>