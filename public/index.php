<?php
date_default_timezone_set('Asia/Taipei');
?>
<!DOCTYPE html>
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>iButton Example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="/js/ibutton.js"></script>
</head>

<body>
  <div class="container">
    <?php
    $script_tz = date_default_timezone_get();
    echo sprintf("TimeZone: %s<br/>",$script_tz);
            $open=strtotime("+0 minute", strtotime('2020-04-12 14:22'));  //define start time
            $close=strtotime("+5 minute", strtotime('2020-04-12 14:22')); //define close time
            ?>

            <a 
            id="btn1"
            type="button" 
            href="https://www.ccc.tc"
            class="btn ibutton btn-primary disabled"
            data-open='<?=$open*1000?>'
            data-close='<?=$close*1000?>'
            >Button One</a>
            <div id="btn1_open"></div>
            <div id="btn1_close"></div>
            <div id="btn1_countdown"></div>

            <?php
            $open=strtotime("+1 minute", strtotime(date("Y-m-d H:i:00"))); //Open time
            $close=strtotime("+3 minute",strtotime(date("Y-m-d H:i:00"))); //Close time
            ?>
            
            <hr>

            <a 
            id="btn2"
            type="button" 
            href="https://www.ccc.tc"
            class="btn ibutton btn-primary disabled"
            data-open='<?=$open*1000?>'
            data-close='<?=$close*1000?>'
            >Button Two</a>
            <div id="btn2_open"></div>
            <div id="btn2_close"></div>
            <div id="btn2_countdown"></div>
            <div id="btn2_countdown_hours"></div>

            <?php
            $open=strtotime("+2 hours", strtotime(date("Y-m-d H:i:00"))); //Open time
            $close=strtotime("+3 hours",strtotime(date("Y-m-d H:i:00"))); //Close time
            ?>
            
            <hr>

            <a 
            id="btn3"
            type="button" 
            href="https://www.ccc.tc"
            class="btn ibutton btn-primary disabled"
            data-open='<?=$open*1000?>'
            data-close='<?=$close*1000?>'
            >Button Three</a>
            <div id="btn3_open"></div>
            <div id="btn3_close"></div>
            <div id="btn3_countdown_hours"></div>

            <hr>

            <?php
            $open=strtotime("+1 minute", strtotime(date("Y-m-d H:i:00"))); //Open time
            $close=strtotime("+3 minute",strtotime(date("Y-m-d H:i:00"))); //Close time
            ?>

            <a 
            id="demo"
            type="button" 
            href="https://www.ccc.tc"
            class="ibutton-custom btn btn-primary disabled"
            data-open='<?=$open*1000?>'
            data-close='<?=$close*1000?>'
            >Demo</a>
            <div id="demo_open"></div>
            <div id="demo_close"></div>
            <div id="demo_countdown_hours"></div>


          </div>

            <script>
            let ib1 = iButton();
            var server_time = "<?= time() * 1000 ?>";
            ib1.q(".ibutton").button(server_time, 'disabled');
            </script>

            <script>
            //Custom open and close status
            let ib = iButton();

            options = {
                countdown_prefix: '倒數中: ',
                countdown_subfix: ' 分後開始',
                open_status:"class is staring",
                close_status:"class is end"
            }
            ib.q(".ibutton-custom",options).button(server_time, 'disabled');
            </script>

    </body>

    </html>
