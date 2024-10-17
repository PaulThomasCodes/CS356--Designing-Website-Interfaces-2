<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mars Countdown</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div id="counter">COuntdown</div>
    <!-- PHP code to get the launch date and time -->
    <?php
        $date_time = strtotime(datetime:"Ja uary 1, 2025 12:00");
        $unix_date_time = date("F d, Y H:i:s", timestamp: $date_time);
    ?>

    <!-- JavaScript code to run a counter -->
     <script>
        var countdown_timer = new Date(<?php echo "$unix_date_time"; ?>).getTime();

        console.log(countdown_timer);

        // set up a javascript interval- grab the id so we can stop the intervals
        var interval_id =setInterval(function () {
            // get the current time'
            var current_time = new Date().getTime();

            console.log("current_time= " + current_time);
            
            // get the difference in time between the launch and the current time
            var timeDiff = countdown_timer - current_time 

            // 1,000 ms in a second
            const ms_in_a_second = 1000;
            // ms in a second & 60 gives us ms in a min
            const ms_in_a_minute =ms_in_a_second * 60;
            // ms in a minute & 60 gives us ms in an hour
            const ms_in_an_hour = ms_in_a_minute * 60;
            // ms in an hour & 24 gives us ms in a day
            const ms_in_a_day = ms_in_an_hour * 24;

            // we can tell the user the countdown in a time remaining in days/hours/minutes/seconds
            var days = Math.floor(timeDiff / ms_in_a_day);
            // to get the hours remainng, we don't care about the days, we just want the remainder and the then divide the remainder so we get the number of hours remaining
            var hours = Math.floor((timeDiff % ms_in_a_day) / ms_in_an_hour);
            // same as above for minutes and seconds
            var minutes = Math.floor((timeDiff % ms_in_an_hour) / ms_in_a_minute);
            // same as above for seconds
            var seconds = Math.floor((timeDiff % ms_in_a_minute) / ms_in_a_second);

            // display the countdown
            document.getElementById("counter").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

            // let the user know if they need to pack their bags or if they missed their launch, etc
            if (days < 0){
                clearInterval(intervalID);
                document.getElementById("counter").innerHTML = "sorrry you've missed the launch!";
            }
            else if (days < 14){
                document.getElementById("counter").innerHTML +=  <br> "we're getting close to the launch!";
            }
            

        }, 1000); // 1000 miliseconds is 1 second
     </script>
</body>
</html>