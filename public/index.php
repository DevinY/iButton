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
            class="btn btn-primary disabled"
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
            class="btn btn-primary disabled"
            data-open='<?=$open*1000?>'
            data-close='<?=$close*1000?>'
            >Button Two</a>
            <div id="btn2_open"></div>
            <div id="btn2_close"></div>
            <div id="btn2_countdown"></div>


          </div>

            <script>
            var server_time = "<?= time() * 1000 ?>";
            iButton.q(".btn").button(server_time, 'disabled');
            </script>

            <script>
            //custom open and close status
            /*
            var options = {
            close_status:"<font color='red'>This meeting is closed.</font>",
                open_status:"<font color='green'>Meeting in progress</font>"
            }
            iButton.q(".btn",options).button(server_time, 'disabled');
            */
            </script>
    </body>

    </html>
