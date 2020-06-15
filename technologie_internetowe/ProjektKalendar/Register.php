<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/RegisterForm.css">
    <title>SCalendar Register
    </title>

</head>
<body>
    <div id="header"> 
        <h1>Scalendar</h1> 
    </div> 

    <div id="LoginDiv">
        <div>
            <p>
                <H3 id="SignIn">Sign up</H3>
            </p>
            <form method="post">
                <div>
                    
                    <input type="Login" name="Login" class="formInput" placeholder="Login" required>
                </div>

                <div>
                    
                    <input type="password" name="password" class="formInput" placeholder="Password"required title="Password > 7 and Password <17">
                </div>
                
                <div>
                    
                    <input type="password" name="retypePassword" class="formInput" placeholder="Retype password"required>
                </div>

                <div>
                    
                    <input type="Email" name="Email" class="formInput" placeholder="Email"required>
                </div>


                <div>
                    
                    <input type="submit" name="ButtonSignUp" class="ButtonSignUp" value="Sign up" />
                        <?php
                        //проверки для вывода ошибок форм
                        if(isset($_SESSION['error'])){
                            // логин слишком кароткий 
                            if($_SESSION['error']=="LogError"){
                                echo '  <div class="Empty">
                                            <h4>Login must be longer than 4 characters</h4>
                                        </div>';
                                unset($_SESSION['error']);
                            // пароли разные
                            }else if($_SESSION['error']=="PassError"){
                                echo '  <div class="Empty">
                                            <h4>Passwords are different</h4>
                                        </div>';
                                unset($_SESSION['error']);
                            // слишком короткий пароль
                            }else if($_SESSION['error']=="SmallPass"){
                                echo '  <div class="Empty">
                                            <h4>Password must be longer than 7 characters</h4>
                                        </div>';
                                unset($_SESSION['error']);
                            // слишком длинный пароль
                            }else if($_SESSION['error']=="BigPass"){
                                echo '  <div class="Empty">
                                            <h4>Password must be shorter than 17 characters</h4>
                                        </div>';
                                unset($_SESSION['error']);
                            }
                        }
                        // проверки для вывода ошибок уникальности данных DB
                        else if (isset($_SESSION['DBError'])){
                            // логин уже существует 
                            if($_SESSION['DBError']=="nonUniqueLogin"){
                                echo '  <div class="Empty">
                                            <h4>This login is already taken</h4>
                                        </div>';
                                unset($_SESSION['DBError']);
                            }
                            else if($_SESSION['DBError']=="nonUniqueEmail"){
                                echo '  <div class="Empty">
                                            <h4>This Email is already taken</h4>
                                        </div>';
                                unset($_SESSION['DBError']);
                            }
                        }

                        //проверка на нажатия кнопки и дальнейшая проверка на правильное вписание полей
                        //записывание типов ошибок в сессийную переменную 

                        if(isset($_POST['ButtonSignUp'])){
                            // сравнение паролей
                            if($_POST['password']==$_POST['retypePassword']){
                                // проверка длины логина
                                if(strlen($_POST['Login'])>=5){
                                    // проверка длины пароля
                                    if(strlen($_POST['password'])>=8 && strlen($_POST['password'])<=16){
                                        
                                        
                                        //запись в DB + проверки  
                                        // создание и записть всех данных в переменные 
                                        require_once './scripts/connection.php';
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
                                                             header("Location: Login.php");
                                                        }else{
                                                            echo 'Error';
                                                        }
                                                    }else{
                                                        //мейл уже зарегестрирован 
                                                        $_SESSION['DBError']="nonUniqueEmail";
                                                        ?>
                                                            <script>
                                                                history.back();
                                                            </script>
                                                        <?php
                                                    }
                                                }else{
                                                    echo 'Error';
                                                }


                                            }else{
                                                // данный логин уже существует
                                                $_SESSION['DBError']='nonUniqueLogin';
                                                ?>
                                                    <script>
                                                        history.back();
                                                    </script>
                                                <?php
                                            }
                                        }else{
                                            echo 'Error';
                                        }
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
                                            $_SESSION['error']="BigPass";
                                            ?>
                                                <script>
                                                    history.back();
                                                </script>
                                            <?php
                                        }else{
                                            // пароль закороткий
                                            $_SESSION['error']="SmallPass";
                                            ?>
                                                <script>
                                                    history.back();
                                                </script>
                                            <?php
                                        }
                                    }
                                }else{
                                    // пароль закороткий
                                    $_SESSION['error']="LogError";
                                    ?>
                                        <script>
                                            history.back();
                                        </script>
                                    <?php
                                }
                                
                            }else{
                                // парольи разные 
                                $_SESSION['error']="PassError";
                                ?>
                                    <script>
                                        history.back();
                                    </script>
                                <?php
                            }
                        }

                        ?>

                </div>


                  <div class="HaveAccount">
                    Already have an account? 
                    <a href="./Login.php"> Sing in</a>
                  </div>


            </form>

        </div>
    </div>
</body>
</html>