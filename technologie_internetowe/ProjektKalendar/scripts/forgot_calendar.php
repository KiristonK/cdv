<?php
    session_start();
    require_once './connection.php';
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <webmaster@example.com>' . "\r\n";
    $headers .= 'Cc: myboss@example.com' . "\r\n";
    $email = $_POST['email'];
    $sql = "select * from scalendar.user where `Email` = '$email'";

    if($result = mysqli_query($conn,$sql)){
	    $message = "<html><head><title>Password recovery</title></head><body>";
        $row = mysqli_fetch_assoc($result);
        if(empty($row)){
            //данного мейла нет в базе данных
            $_SESSION['error']="Invalid Email.";
            $message = "Hello, dear ".$email.", unfortunately we can't find your e-mail in our database, please check it for any mistakes, or <a href='../Register.php'>Register Now</a></p>";
            ?><script>history.back();</script><?php
        }else {
	        $Login = $row['Login'];
	        $message = "Hello, dear ".$email.", please follow by this ";
	        if ($_POST['what'] == "password") $message .= "<a href='http://localhost:63342/lessons/ResetPass.php?Login=".$row['Login']."'>Link</a> to recover your password";
	        else $message .= "<a href='http://localhost:63342/lessons/ResetLogin.php?Login=".$row['Login']."'>Link</a> to recover your login";
	        $message .=" and set new one.</p>";
	        $message .= "<p>If you are not requested password recovery, please click <a href='http://localhost:63342/lessons/Scripts/block_user.php'>here</a> to block your account, and we will contact with you.</p>";
        }
        $message .= "</body></html>";
        mail($email, "SCalendar Team", $message, $headers);
    }else{
        echo 'Error';
    }

//проверка на существование мейла
?>