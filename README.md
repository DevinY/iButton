# ibutton
This Jvascript is dynamic button library.

Within the defined time, it will be automatically activated and deactivated.

Features:
<pre>
Customize disabled css.
Can be automatically turned on and off at a customized time.
Debug mode.
Can be unlock for test.
Countdown timer.
Show datetime in user's time zone.
</pre>

<code>
    <script>
  
     var server_time = "<?= time() * 1000 ?>";
     
     iButton.q(".btn").button(server_time, 'disabled');
     
   </script>
     
</code>
