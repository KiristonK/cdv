<?php
require_once "connection.php";
$day = $_GET['day'];
$month = $_GET['month'];
$monthNum = $_GET['monthNum'];
$monthNum += 1;
$year = $_GET['year'];
$date = $year . "-" . $monthNum . "-" . $day;

$sql = "select * from `events` where `event_date` = '{$date}' order by `event_time_start`";
if ($result = mysqli_query($conn, $sql)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<< EVENT
<div class="d-table-row">
    <div class="d-table-cell w-100">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="eventCheck$i">
            <button id="labelCheck$i" 
            data-info="$row[event_description]" data-name="$row[event_name]" data-link="$row[event_link]"
            class="btn btn-secondary w-100 m-1 custom-control-label">$row[event_name] ($date)</button>
        </div>
    </div>
</div>
EVENT;
        $i++;
    }
}
?>
