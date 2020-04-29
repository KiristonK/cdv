<?php
require "../connect.php";

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id = {$id}";
    if ($result = mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header('location: ../database_1.php');
    }
}


