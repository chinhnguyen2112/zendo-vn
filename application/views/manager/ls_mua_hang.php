<style>
    .list_atm {
        margin: 20px auto;
        padding: 20px;
        background: #bfd7f5;
        width: max-content;
        border-radius: 10px;
    }

    .none_page {
        display: none;
    }

    body,
    html {
        height: 100%;
        position: relative;
    }

    .main_content {
        background: #1f2334;
    }

    .list_buy {
        overflow: auto;
        max-height: 800px;
    }

    footer {
        width: 100%;
    }

    .content.content-boxed {
        min-height: 500px;
    }

    .active {
        border-top: none;
    }

    .main_content a {
        color: #fff;
    }

    .bg-info {
        background-color: #70b9eb;
    }

    a:focus,
    a:hover {
        color: #23527c;
        text-decoration: underline;
    }
</style>

<div class="main_content">
    <div class="content content-boxed">
        <div class=" block-themed">

            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                <li class="li_ls active" data-page="buy">
                    <a href="#">Tài Khoản đã mua</a>
                </li>
                <li class="li_ls" data-page="card">
                    <a href="#">Thẻ cào đã nạp</a>
                </li>
            </ul>


            <div class="block-content tab-content" style="padding-top: 0px;">

                <div class="tab-pane active" id="buy">
                    <div style="display: block;    overflow: auto;" class="list_buy"></div>
                    <div id="loading">
                        <img src="<?= site_main() ?>images/vqlq/load.gif" />
                    </div>
                </div>

                <div class="tab-pane" id="coc">
                    <div style="display: block;" class="list_coc"></div>
                    <div id="loading">
                        <img src="<?= site_main() ?>images/vqlq/load.gif" />
                    </div>
                </div>

                <div class="tab-pane " id="card">
                    <div style="display: block;" class="list_card"></div>
                    <div id="loading">
                        <img src="<?= site_main() ?>images/vqlq/load.gif" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>