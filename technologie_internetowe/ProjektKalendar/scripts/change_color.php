<?php
require_once 'connection.php';
if (!empty($_POST['ev_id']) && !empty($_POST['color'])) {
    $ev_id = $_POST['ev_id'];

    $sql = "update scalendar.events set color = '{$_POST['color']}' where event_id = {$ev_id}";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->close();
}