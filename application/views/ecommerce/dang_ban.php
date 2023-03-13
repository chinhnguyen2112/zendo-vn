<style type="text/css">

    .content {

        /*padding: 1px 177px 75px 177px !important;*/

    } 

    @media (max-width: 540px) {

        .content {

            padding: 10px 8px !important;

         }  

    } 

    .span_game_sell {

    margin: unset !important;

    /*text-align: center;*/

    padding-top: 60px;

    padding-bottom: 40px;

    font-size: 35px;

   }

   .main-content2 {

       max-width: 90%;

       margin: 0 auto;

   }

   .list_box_ct.list_vqmm {

    gap: 20px;

   }



   @media (max-width : 540px) {

    .span_game_sell {

      font-size: 30px;

      line-height: 40px;

    }

   }

    @media (max-width : 375px) {

    .span_game_sell {

      font-size: 25px;

      line-height: 30px;

    }

   }

    img.img_this_vx {

        width: 50% !important;

    }

    @media (max-width : 820px) {

        .span_game_sell {

            padding-top:30px ;

            padding-bottom: 20px;

        }

    }

    @media (max-width : 375px) {

        .span_game_sell {

            padding-top:10px ;

            padding-bottom: 20px;

        }

    }  

</style>
<div id="main">

    <div class="content content-ban-acc">

        <!-- main-content -->

        <div class="main-content2">

            <h2 class="span_game_sell"><span class="span_name_cty game_sell">Chọn Game bạn muốn đăng bán Acc</span></h2>

                <?php

                 if(!is_admin() && !is_user_seller()) { ?>

                    <div class="list_box_ct list_vqmm user_personal">



                <?php }elseif(is_user_seller() || is_admin()){ ?>

                    <div class="list_box_ct list_vqmm">



                <?php }else{ ?>

                    <div class="list_box_ct list_vqmm user_not_loggin">



                <?php  }

                ?>

                <a class="box_vqmm" href="/dang-ban-acc-lien-quan/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_lq.png" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_lq.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-pubg/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_pubg.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_pubg.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-cf/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_csgo.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_cf.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-lmht/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_lmht.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_lmht.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-fifa/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_lmht.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_fifa.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-freefire/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_ff.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_ff.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-tocchien/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_dota.jpg" alt="vòng quay may mắn">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_lmtc.png" alt="vòng quay liên quân"></p>

                </a>

                <a class="box_vqmm" href="/dang-ban-acc-valorant/">

                    <img class="img_bgr_vx" src="<?= site_main() ?>images/home/img_list_valorant.jpg" alt="dota 2">

                    <p class="p_img"><img class="img_this_vx" src="<?= site_main() ?>images/home/logo_valorant.png" alt="vòng quay liên quân"></p>

                </a>

            </div>

        </div>

    </div>

</div>

