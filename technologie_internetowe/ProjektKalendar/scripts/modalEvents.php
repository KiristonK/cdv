<?php
require "connection.php";
$day = $_GET['day'];
$month = $_GET['month'];
$monthNum = $_GET['monthNum'];
for ($i = 1; $i <= 12; $i++) {
    echo <<< EVENT
<div class="d-table-row">
    <div class="d-table-cell w-100">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="eventCheck$i">
            <label for="eventCheck$i" id="labelCheck$i" 
            data-info="[Event content (additional info, urls)]"
            class="btn btn-secondary w-100 m-1 custom-control-label">Event $i ($day, $month($monthNum))</label>
        </div>
    </div>
</div>

EVENT;
}
