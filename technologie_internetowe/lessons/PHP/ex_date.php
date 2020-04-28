<?php
    $from = date("m-d-yyy");
    $to = date("m-d-yyy");
    if (!empty($_GET['od']))
        $from = mktime($_GET['od']);
    if (!empty($_GET['do']))
        $to = mktime($_GET['do']);
    $res = $to - $from;
    echo "Seconds: $res<br>Minutes: ", $res/60, "<br>Hours: ", ($res/60)/60, "<br>Days: ", (($res/60)/60)/(60 * 24);
?>

<form>
    <label for="od">Od</label>
    <input name="od" id="od" type="date">

    <label for="do">Od</label>
    <input name="do" id="do" type="date">
    <input type="submit" value="Get difference!">
</form>
