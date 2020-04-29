<?php
if (!empty($_POST['name']) && !empty($_POST['surname'] && !empty($_POST['city']))) {
    require '../connect.php';
    $sql = "INSERT INTO `user` (`id`, `name`, `surname`, `birthday`, `cityId`) VALUES (NULL, '$_GET[name]', '$_GET[surname]', '$_GET[birthday]', '$_GET[city]')";
    if ($result = mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        header('location: ../database_1.php');
    } else {
        echo 'Error has occurred !';
    }
} else {
    echo 'Not all data entered !';
}