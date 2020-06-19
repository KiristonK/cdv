<?php
session_start();
require_once "connection.php";

if (!empty($_GET['add'])){
    if (!empty($_POST['name']) && !empty($_POST['date'])) {
        $timeE = null;  $name = $_POST['name'];
        $timeS = null;  $description = $_POST['description'];
        $link = null;   $date = $_POST['date'];
        $place = null;
        if (!empty($_POST['time_start']) && !empty($_POST['time_end'])) {
            $timeS = $_POST['time_start'];
            $timeE = $_POST['time_end'];
        } else {
            $timeS = "00:00:00";
            $timeE = "00:00:00";
        }
        if (!empty($_POST['link'])) $link = $_POST['link'];
        if (!empty($_POST['place'])) $place = $_POST['place'];

        $user_id  = $_SESSION['user_id'];
        if ($timeE != "00:00:00") $sql = "select * from scalendar.events where date = ? and time_start = ? and time_stop = ? and user_id = ?";
        else $sql = "select * from scalendar.events where name like(?) and date = ? and user_id = ?";
        if ($stmt = $conn->prepare($sql)) {
            if ($timeE != "00:00:00") $stmt->bind_param("ssss", $date, $timeS, $timeE, $user_id);
            else $stmt->bind_param("sss", $name, $date, $user_id);
            $stmt->execute();
            if ($stmt->get_result()->num_rows != 0) {
                if ($timeE != "00:00:00") echo "Another event on that time already exists";
                    else echo "Another event with given name already exists";
            } else {
                $stmt->close();
                $sql = "INSERT INTO scalendar.events(`user_id`, `name`, `date`, `time_start`, `time_stop`, `description`, `link`, `place`) VALUES (?,?,?,?,?,?,?,?);";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param('ssssssss', $user_id, $name, $date, $timeS, $timeE, $description, $link, $place);
                    $stmt->execute();
                    if (!empty($stmt->error_list)) {echo "Error while adding new event";}
                } else { echo "Prepare add event error";}
                $stmt->close();
            }
        } else {echo "Prepare check for unique error";}
    } else {
        echo "Required fields are empty";
    }
}
else if (!empty($_GET['edit'])) {
    if (!empty($_POST['id'])){
        $name = $_POST['name']; $date = $_POST['date']; $description = $_POST['description']; $timeS = $_POST['time_start'];
        $timeE = $_POST['time_end']; $link = $_POST['link']; $place = $_POST['place']; $id = $_POST['id'];
        $sql = "UPDATE scalendar.events SET `name`=?,`date`= ?,`time_start`=?,`time_stop`=?,`description`=?,`link`=?,`place`=? WHERE `event_id` = ?;";
        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ssssssss", $name, $date, $timeS, $timeE, $description, $link, $place, $id);
            $stmt->execute();
            if (!empty($stmt->error_list)) {
                echo "Error while saving changes";
            }
        } else {
            echo "Prepare error";
        }
        $stmt->close();
    }
    else {echo "Empty id";}
}
else if (!empty($_POST['delete'])) {
    if (!empty($_POST['id'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM scalendar.events WHERE event_id = ?";
        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s",$id);
            $stmt->execute();
            if (!empty($stmt->error_list)) {
                echo "Error while saving changes";
            }
        } else {
            echo "Prepare error";
        }
        $stmt->close();
    }
    else {echo "Empty id";}
}
 else if(!empty($_POST['get'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "select * from scalendar.events where event_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $event = $stmt->get_result()->fetch_assoc();
        echo json_encode($event);
        $stmt->close();
    } else {
        echo 'Empty id';
    }
}
else {
    echo "No args";
}