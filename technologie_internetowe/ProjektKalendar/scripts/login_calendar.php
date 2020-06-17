<?php
session_start();
require_once './connection.php';

if (isset($_POST['remember']) || !empty($_POST['remember'])) {
    $_SESSION['RM'] = true;
} else {
    $_SESSION['RM'] = false;
}
if (!empty($_POST['login']) && !empty($_POST['pass'])){
    $Login = $_POST['login'];
    $Pass = $_POST['pass'];
    $sql = "select * from scalendar.user where `Login`= '$Login' and `Password`= '$Pass'";

    if($result = mysqli_query($conn,$sql)){
        $row = mysqli_fetch_assoc($result);
        if(empty($row)){
            //аккаун не существует или пароль или логин введены неверно
            $_SESSION['error']="Invalid login or password.";
            ?><script>history.back();</script><?php
        }else{
            $_SESSION['user_id']= $row['id'];
            $_SESSION['user'] = $row['Login'];
            header("Location: ../calendar.php");
            //аккаун существует перенапровление на гланую
        }
    }else{
        echo 'Error';
    }
} else {
    $_SESSION['error'] = "User login or password are empty.";
    ?><script>history.back();</script><?php
}
?>
