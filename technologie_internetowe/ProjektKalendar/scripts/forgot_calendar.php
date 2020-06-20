<?php
    session_start();
    require_once './connection.php';
    $email = $_POST['login'];
    $sql = "select * from scalendar.user where `Email` = '$email'";

    if($result = mysqli_query($conn,$sql)){
        $row = mysqli_fetch_assoc($result);
        if(empty($row)){
            //данного мейла нет в базе данных
            $_SESSION['error']="Invalid Email.";
            ?><script>history.back();</script><?php
        }
        $Login = $row['Login'];
    
    }else{
        echo 'Error';
    }

    //проверка на существование мейла 


    //сброс пароля
    if($_SESSION['Forgot']=='pass'){
       
        header("Location: ../ResetPass.php?Login=$Login");
        
    //сброс логина
    }else if($_SESSION['Forgot']=='Login'){
        header("Location: ../ResetLogin.php?Login=$Login");
    }
?>