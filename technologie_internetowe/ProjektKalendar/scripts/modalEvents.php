<?php
require_once "connection.php";
$day = $_POST['day'];
$month = $_POST['month'];
$monthNum = $_POST['monthNum'];
$monthNum += 1;
$year = $_POST['year'];
$date = $year . "-" . $monthNum . "-" . $day;

$sql = "select * from `events` where `date` = '{$date}' order by `time_start`";
if ($result = mysqli_query($conn, $sql)) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        echo <<< EVENT
<div class="d-table-row">
    <div class="d-table-cell w-100">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" data-id="$row[event_id]" id="eventCheck$i">
            <label id="labelCheck$i"  for="eventCheck$i"
            data-info="$row[description]" data-name="$row[name]" data-link="$row[link]" data-place="$row[place]" data-stime="$row[time_start]" data-etime="$row[time_stop]"
            class="btn btn-secondary w-100 m-1 custom-control-label">$row[name]</label>
        </div>
    </div>
</div>
EVENT;
        $i++;
    }
}
?>
