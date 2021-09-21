<?php
    function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        if($weekDay == 0 || $weekDay == 6)
            return 1;
        else 
            return 0;
    }
    $res = isWeekend("2021-09-23");
    $date = ''.2000.'-'.01.'-'.12.'';   
    echo $date;
    echo ''.$res;
?>