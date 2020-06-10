<?php
require_once "connection.php";
if (!empty($_POST['add'])) {
    if (!empty($_POST['name']) && !empty($_POST['text']) && !empty($_POST['date'])) {
        $timeE = null;
        $name = $_POST['name'];
        $timeS = null;
        $text = $_POST['text'];
        $link = null;
        $date = $_POST['date'];
        $place = null;
        if (!empty($_POST['time_start']) && !empty($_POST['time_end'])) {
            $timeS = $_POST['time_start'];
            $timeE = $_POST['time_end'];
        }
        if (!empty($_POST['link'])) $link = $_POST['link'];
        if (!empty($_POST['place'])) $place = $_POST['place'];
        $sql = "select * from `events` where `event_name` = {$name} and `event_description` = {$text} and `event_date` = '{$date}'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $_SESSION['error'] = "Event o takiej nazwie i treści już istnieje.";
            ?>
            <script>
                history.back();
            </script>
            <?php
        } else {
            $sql = "insert into `events`(`event_name`, `event_date`, `event_time_start`, `event_time_stop`, `event_description`, `event_link`, `event_place`) values (?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $name, $date, $text);
            $stmt->execute();
            if (!empty($stmt->error_list)) {
                $_SESSION['error'] = "Bląd dodania eventu";
                ?>
                <script>
                    history.back();
                </script>
                <?php
            }
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
        ?>
        <script>
            history.back();
        </script>
        <?php
    }
}