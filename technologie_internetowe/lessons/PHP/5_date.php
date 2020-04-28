<?php
    echo date("Y-m-d"),'<br>';
    echo date("Y-F-d"),'<br>';
    echo date("H-i-s"),'<br>';

    echo "Week day: ",date("w"),'<br>';
    echo "Num of week: ",date("W"),'<br>';
    echo "Day in year: ",date("z"),'<br>';

    $data = getdate();
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    echo $data['weekday'];



