<?php
session_start();
//проверка на нажатия кнопки и дальнейшая проверка на правильное вписание полей
//записывание типов ошибок в сессийную переменную
// сравнение паролей
    if($_POST['password']==$_POST['retypePassword']){
    // проверка длины логина
        if(strlen($_POST['Login'])>=5){
        // проверка длины пароля
            if(strlen($_POST['password'])>=8 && strlen($_POST['password'])<=16){
                //запись в DB + проверки
                // создание и записть всех данных в переменные
                require_once './connection.php';
                $Login=$_POST['Login'];
                $Pass=$_POST['password'];
                $Email=$_POST['Email'];
                //$sql = "INSERT INTO `user` (`Login`, `Password`, `Email`, `RegisterDate`) VALUES ('$Login', '$Pass', '$Email', CURDATE())";
                //проверка на уникальность логина
                $sql = "SELECT * from `user` where `Login`= '$Login'";
                //отправка запроса
                if($result = mysqli_query($conn,$sql)){
                    // приписание полученных данных с DB в переменную
                    $row = mysqli_fetch_assoc($result);
                    //проверка переменной на пустоту
                    if(empty($row)){
                        //переменная пустая логин уникальный
                        //проверка мейла
                        $sql = "SELECT * from `user` where `Email`= '$Email'";
                        if($result = mysqli_query($conn,$sql)){
                            $row = mysqli_fetch_assoc($result);
                            if(empty($row)){
                                //все проверки прошли успещно можно записывать в DB
                                $sql = "INSERT INTO `user` (`Login`, `Password`, `Email`, `RegisterDate`) VALUES ('$Login', '$Pass', '$Email', CURDATE())";
                                //запись данных о новом пользователи в DB
                                if($result = mysqli_query($conn,$sql)){
                                    //регистрация закончилась успехом данные о новом пользователи записаны в DB
                                    // перенапровление на окно авторизации Login.php
                                    $_SESSION['TyForReg']="TyForReg";
                                    header("Location: ../Login.php");
                                }else{
                                    $_SESSION['error'] = 'Database error';
                                }
                            }else{
                                //мейл уже зарегестрирован
                                $_SESSION['error']="This Email has already been taken";
                                ?><script>history.back();</script><?php
                            }
                        }else{ $_SESSION['error'] = 'Database error';}
                    }else{
                        // данный логин уже существует
                        $_SESSION['error']='This login has already been taken';
                        ?><script>history.back();</script><?php
                    }
                }else{ $_SESSION['error'] = 'Database error';}
                // if(!$result){
                //     echo 'login yze jest';
                // }else{
                //     $sql = "INSERT INTO `user` (`Login`, `Password`, `Email`, `RegisterDate`) VALUES ($Login, $Pass, $Email, GETDATE())";
                //     $result= mysqli_query($conn,$sql);
                // }


                //все прошло успешно перенапровление на форму Lohin.php
                // $_SESSION['TyForReg']="TyForReg";
                // header("Location: Login.php");
            }else{
                //пароль слишком длинный или короткий
                // проверка не за большой ли пароль
                if(strlen($_POST['password'])>=17){
                // пароль задлинный
                $_SESSION['error']="Password must be shorter than 17 characters";
                ?><script>history.back();</script><?php
                }else{
                    // пароль закороткий
                    $_SESSION['error']="Password must be longer than 7 characters";
                    ?><script>history.back();</script><?php
                }
            }
        }else{
            // пароль закороткий
            $_SESSION['error']="Login must be longer than 4 characters";
            ?><script>history.back();</script><?php
        }
    }else{
        // парольи разные
        $_SESSION['error']="Passwords are different";
        ?><script>history.back();</script><?php
    }
?>