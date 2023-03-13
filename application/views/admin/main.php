<?php

$CI = &get_instance();

$one_month = date('Y-m-01 00:00:00');

$now_day = date('Y-m-d 00:00:00');

$week  = date('Y-m-d 00:00:00', strtotime("this week"));

// bộ đếm người dùng

$user_last_6day = $CI->Account->query_sql_num("SELECT *FROM accounts WHERE time >= '$week';"); // 7 tuần này

$user_today = $CI->Account->query_sql_num("SELECT * FROM accounts WHERE time >= '$now_day';"); // hom nay

$user_month = $CI->Account->query_sql_num("SELECT * FROM accounts WHERE time > '$one_month';"); // thang nay

// $user_count = $CI->Account->query_sql_num("SELECT * FROM accounts"); // all

// bộ đếm giao dịch

$buy_last_6day = $CI->Account->query_sql_row("SELECT SUM(price) as all_price FROM history_buy WHERE  time >= '$week';"); // 7 tuần này

$buy_today = $CI->Account->query_sql_row("SELECT SUM(price) as all_price FROM history_buy WHERE time >= '$now_day';"); // giao dịch hôm nay

$buy_month = $CI->Account->query_sql_row("SELECT SUM(price) as all_price FROM history_buy WHERE time >= '$one_month';"); // giao dịch tháng này



$card_last_day = $CI->Account->query_sql_row("SELECT SUM(menhgia) as all_menhgia FROM history_card WHERE status = 5 AND time >= '$now_day' ;"); //  thẻ hôm nay

$card_last_6day = $CI->Account->query_sql_row("SELECT SUM(menhgia) as all_menhgia FROM history_card WHERE status = 5 AND time >= '$week';"); // thẻ  tuần này

$card_month = $CI->Account->query_sql_row("SELECT SUM(menhgia) as all_menhgia FROM history_card WHERE status = 5 AND time >= '$one_month';"); //thẻ tháng



?>

<style>

    h3.block-title {

        text-align: center;

    }

</style>

<div class="row row_dashboard">

    <div class="col-lg-4">

        <div class="block">

            <div class="block-header mb20">

                <h3 class="block-title">Người dùng <b data-toggle="tooltip" data-placement="right" title="6 ngày trước, hôm nay, tháng này"><i class="fa fa-question-circle"></i></b></h3>

            </div>

            <canvas id="myChart" width="400" height="400"></canvas>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="block">

            <div class="block-header mb20">

                <h3 class="block-title">Giao dịch <b data-toggle="tooltip" data-placement="right" title="6 ngày trước, hôm nay, tháng này"><i class="fa fa-question-circle"></i></b></h3>

            </div>

            <canvas id="myChart2" width="400" height="400"></canvas>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="block">

            <div class="block-header mb20">

                <h3 class="block-title">Nạp thẻ <b data-toggle="tooltip" data-placement="right" title="6 ngày trước, hôm nay, tháng này"><i class="fa fa-question-circle"></i></b></h3>

            </div>

            <canvas id="myChart3" width="400" height="400"></canvas>

        </div>

    </div>

</div>



<script>

    const ctx = document.getElementById('myChart').getContext('2d');

    const myChart = new Chart(ctx, {

        type: 'bar',

        data: {

            labels: ['Thàng này','Tuần này', 'Hôm nay'],

            datasets: [{

                label: '# of Votes',

                data: [ <?= $user_month ?>,<?= $user_last_6day ?>, <?= $user_today ?>],

                backgroundColor: [

                    'rgba(255, 99, 132, 0.2)',

                    'rgba(54, 162, 235, 0.2)',

                    'rgba(255, 206, 86, 0.2)'

                ],

                borderColor: [

                    'rgba(255, 99, 132, 1)',

                    'rgba(54, 162, 235, 1)',

                    'rgba(255, 206, 86, 1)'

                ],

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                yAxes: [{

                    ticks: {

                        callback: function(value, index, values) {

                            return value.toLocaleString('en-US') + ' User';

                        }

                    }

                }]

            },

            tooltips: {

                callbacks: {

                    label: function(tooltipItem, data) {

                        return tooltipItem.yLabel.toLocaleString('en-US') + ' user';

                    }

                }

            }

        }

    });

    const ctx2 = document.getElementById('myChart2').getContext('2d');

    const myChart2 = new Chart(ctx2, {

        type: 'bar',

        data: {

            labels: ['Tháng này', 'Tuần này', 'Hôm nay'],

            datasets: [{

                label: '# of Votes',

                data: [<?= $buy_month['all_price'] ?>, <?= $buy_last_6day['all_price'] ?>, <?= $buy_today['all_price'] ?>],

                backgroundColor: [

                    'rgba(255, 99, 132, 0.2)',

                    'rgba(54, 162, 235, 0.2)',

                    'rgba(255, 206, 86, 0.2)'

                ],

                borderColor: [

                    'rgba(255, 99, 132, 1)',

                    'rgba(54, 162, 235, 1)',

                    'rgba(255, 206, 86, 1)'

                ],

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                yAxes: [{

                    ticks: {

                        callback: function(value, index, values) {

                            return value.toLocaleString('en-US') + ' VNĐ';

                        }

                    }

                }]

            },

            tooltips: {

                callbacks: {

                    label: function(tooltipItem, data) {

                        return tooltipItem.yLabel.toLocaleString('en-US') + ' VNĐ';

                    }

                }

            }

        }

    });

    const ctx3 = document.getElementById('myChart3').getContext('2d');

    const myChart3 = new Chart(ctx3, {

        type: 'bar',

        data: {

            labels: ['Tháng này', 'Tuần này', 'Hôm nay'],

            datasets: [{

                label: '# of Votes',

                data: [<?= $card_month['all_menhgia'] ?>, <?= $card_last_6day['all_menhgia'] ?>, <?= $card_last_day['all_menhgia'] ?>],

                backgroundColor: [

                    'rgba(255, 99, 132, 0.2)',

                    'rgba(54, 162, 235, 0.2)',

                    'rgba(255, 206, 86, 0.2)'

                ],

                borderColor: [

                    'rgba(255, 99, 132, 1)',

                    'rgba(54, 162, 235, 1)',

                    'rgba(255, 206, 86, 1)'

                ],

                borderWidth: 1

            }]

        },

        options: {

            scales: {

                yAxes: [{

                    ticks: {

                        callback: function(value, index, values) {

                            return value.toLocaleString('en-US') + ' VNĐ';

                        }

                    }

                }]

            },

            tooltips: {

                callbacks: {

                    label: function(tooltipItem, data) {

                        return tooltipItem.yLabel.toLocaleString('en-US') + ' VNĐ';

                    }

                }

            }

        }

    });

</script>