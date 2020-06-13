<?php
session_start();
require_once "connection.php";
if (!empty($_GET['add'])){
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['date'])) {
        $timeE = null;  $name = $_POST['name'];
        $timeS = null;  $description = $_POST['description'];
        $link = null;   $date = $_POST['date'];
        $place = null;
        if (!empty($_POST['time_start']) && !empty($_POST['time_end'])) {
            $timeS = $_POST['time_start'];
            $timeE = $_POST['time_end'];
        }
        if (!empty($_POST['link'])) $link = $_POST['link'];
        if (!empty($_POST['place'])) $place = $_POST['place'];
        $sql = "select * from `events` where `name` = '{$name}' and `description` = '{$description}' and `date` = '{$date}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['error'] = "Another event on that time already exists.";
        } else {
            $stmt->close();
            $uId = 1;
            $sql = "INSERT INTO `events`(`user_id`, `name`, `date`, `time_start`, `time_stop`, `description`, `link`, `place`) VALUES (?,?,?,?,?,?,?,?);";
            if ($stmt = $conn->prepare($sql)){
                $stmt->bind_param('ssssssss', $uId,$name, $date, $timeS, $timeE, $description, $link, $place);
                $stmt->execute();
                if (!empty($stmt->error_list)) {
                    $_SESSION['error'] = "Error while adding new event.";
                }
            }else {
                echo "Prepare error".$stmt->error;
            }
            $stmt->close();
        }
    }
} else if (!empty($_GET['edit'])) {
    if (!empty($_POST['id'])){
        $name = $_POST['name']; $date = $_POST['date']; $description = $_POST['description']; $timeS = $_POST['time_start'];
        $timeE = $_POST['time_end']; $link = $_POST['link']; $place = $_POST['place']; $id = $_POST['id'];
        $sql = "UPDATE `events` SET `name`=?,`date`= ?,`time_start`=?,`time_stop`=?,`description`=?,`link`=?,`place`=? WHERE `event_id` = ?;";
        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ssssssss", $name, $date, $timeS, $timeE, $description, $link, $place, $id);
            $stmt->execute();
            if (!empty($stmt->error_list)) {
                $_SESSION['error'] = "Error while saving changes.";
            }
        } else {
            echo "Prepare error";
        }
        $stmt->close();
    }
    else {echo "Empty id !";}
} else if(!empty($_POST['get'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "select * from `events` where `event_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $event = $stmt->get_result()->fetch_assoc();
        echo json_encode($event);
        $stmt->close();
    } else {
        $_SESSION['error'] = 'Błąd wysyłania żądania.';
    }
}
else {
    echo "No args";
}