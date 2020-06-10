<?php
require_once "connection.php";
if (!empty($_POST['add'])) {
    if (!empty($_POST['name'] && !empty($_POST['text']))) {
        $name = $_POST['name'];
        $text = $_POST['text'];
        $sql = "select * from `events` where `event_name` = {$name} and `event_description` = {$text}";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $_SESSION['error'] = "Event o takiej nazwie i treści już istnieje.";
        }
        $sql = "insert into `events`(`event_name`,`event_description`) values ?,?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $name, $text);
        $stmt->execute();
        if (!empty($stmt->error_list)) {
            $_SESSION['error'] = "Bląd dodania eventu";
        }
    }

} else if (!empty($_POST['edit'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "select * from `events` where event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
    } else {
        $_SESSION['error'] = 'Błąd wysyłania żądania.';
    }
}