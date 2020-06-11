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
            echo "<h1 id='error'>Event o takiej nazwie i treści w ten dzień już istnieje.</h1>";
            ?><script>history.back();</script><?php
        } else {
            $stmt->close();
            $uId = 1;
            $sql = "INSERT INTO `events`(`user_id`, `name`, `date`, `time_start`, `time_stop`, `description`, `link`, `place`) VALUES (?,?,?,?,?,?,?,?);";
            if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param('ssssssss', $uId,$name, $date, $timeS, $timeE, $description, $link, $place);
            $stmt->execute();
            if (!empty($stmt->error_list)) {
                $_SESSION['error'] = "Bląd dodania eventu";
                ?><script>history.back();</script><?php
            }
            }else {
                echo "Prepare error".$stmt->error;
            }
        }
    }
} else if (!empty($_GET['edit'])) {

    $sql = "UPDATE `events` SET `name`=?,`date`=?,`time_start`=?,`time_stop`=?,`description`=?,`link`=?,`place`=? WHERE `event_id` = ?";
} else if(!empty($_POST['get'])) {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql = "select * from `events` where `event_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $event = $stmt->get_result()->fetch_assoc();
        echo <<< FORM
                        <div class="row">
                            <div class="col">
                                <label for="evName">Event name</label>
                                <input type="text" name="eventName" id="evName" class="form form-control mb-2" value="$event[name]">
                            </div>
                            <div class="col">
                                <label for="evLink">Event link</label>
                                <input type="text" id="evLink" name="eventLink" class="form form-control mb-2" value="$event[link]">
                            </div>
                        </div>
                        <label for="evPlace">Event place (address)</label>
                        <input type="text" id="evPlace" name="eventPlace" class="form form-control mb-2" value="$event[place]">
                        <label for="evDate">Event date</label>
                        <input type="date" id="evDate" name="eventDate" class="form form-control mb-2" value="$event[date]">
                        <div class="row">
                            <div class="col">
                                <label for="evTS">Start time (from)</label>
                                <input type="time" id="evTS" name="eventTimeStart" class="form form-control mb-2" value="$event[time_start]">
                            </div>
                            <div class="col">
                                <label for="evTE">End time (to)</label>
                                <input type="time" id="evTE" name="eventTimeEnd" class="form form-control mb-2" value="$event[time_stop]">
                            </div>
                        </div>
                        <label for="evDesc">Event description</label>
                        <textarea type="text" class="form form-control overflow-hidden mb-2" name="eventText"
                                  id="evDesc">$event[description]</textarea>
                        <div style="text-align: end;">
                            <input type="submit" class="btn btn-outline-success" id="formSubmit" value="Confirm">
                        </div>
FORM;
    } else {
        $_SESSION['error'] = 'Błąd wysyłania żądania.';
        ?>
        <script>
            history.back();
        </script>
        <?php
    }
}
else {
    echo "No args";
}