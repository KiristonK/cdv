<?php
    session_start();
    if($_POST['pass']!=$_POST['ret_pass']){
        $_SESSION['error']="Passwords are different.";
            ?><script>history.back();</script><?php
            exit();
    }else if(strlen($_POST['pass'])>=17){
        
        $_SESSION['error']="Password must be shorter than 17 characters.";
            ?><script>history.back();</script><?php
            exit();
    }else if(strlen($_POST['pass'])<=7){
        $_SESSION['error']="Password must be longer than 7 characters.";
            ?><script>history.back();</script><?php
            exit();
    }
    if (preg_match_all("/(\w)/",$_POST['pass']) !== false ){
        if (preg_match_all("/(\W)/", $_POST['pass']) !== 0){
	        require_once './connection.php';
	        $pass = $_POST['pass'];
	
	        $login = $_GET['Login'];
	
	        $sql = "update scalendar.user set `Password`='$pass' where `Login` = '$login'";
	        if($result = mysqli_query($conn,$sql)){
		        $row = mysqli_fetch_assoc($result);
		        header("Location: ../Login.php");
		        exit();
	        }
	        else{
		        echo 'Error';
	        }
        } else{
            $_SESSION['error'] = "Password must contain special characters, such as !@#$%^&* etc.";
	        ?><script>history.back();</script><?php
            exit();
        }
    }else {
        $_SESSION['error'] = "Password should not contain spaces, tabs or '- , . \ /' characters";
	    ?><script>history.back();</script><?php
	    exit();
    }

?>