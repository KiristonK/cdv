<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/LoginForm.css">
    <title>SCalendar Login
    </title>

</head>
<body>
    <div id="header"> 
        <h1>SCalendar</h1> 
    </div> 

    <div id="LoginDiv">
        <div>
            <p>
                <H3 id="SignIn">Sign in</H3>
            </p>

            <?php
                if(isset($_SESSION['RM'])){
                    if($_SESSION['RM']){
                        header("Location: ./calendar.php");   
                        exit();
                    }       
                }


                if(isset($_SESSION['TyForReg'])){
                    echo '  <div class="Registered">
                                <h4>Thank you for register</h4>
                            </div>';
                    unset($_SESSION['TyForReg']);
                }
            ?>

            <form method="post">
                <div>
                  <input type="Login"name="Login" class="formInput" placeholder="Login"required>
                </div>

                <div>
                  <input type="password"name="password" class="formInput" placeholder="Password"required>
                </div>
                
                <div class="Remember">
                    <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    <?php
                        if(isset($_POST['remember'])){
                            $_SESSION['RM']=true;
                        }else{
                            $_SESSION['RM']=false;
                        }
                    ?>

                </div>

                  <div>
                    <input type="submit" name="ButtonSignIn" class="ButtonSignIn" value="Sign in" />
                    <!-- <button type="submit"class="ButtonSignIn" >Sign In</button> -->
                    <?php

                    if(isset($_SESSION['error'])){
                            echo '  <div class="Empty">
                                <h4>Invalid login or password</h4>
                            </div>';
                            unset($_SESSION['error']);
                    }


                    //проверка на нажатие кнопки входа
                        if(isset($_POST['ButtonSignIn'])){
                            //конект с DB
                            require_once './scripts/connection.php';
                            $Login = $_POST['Login'];
                            $Pass = $_POST['password'];

                            $sql = "SELECT * from `user` where `Login`= '$Login' and `Password`= '$Pass'";

                            if($result = mysqli_query($conn,$sql)){
                                $row = mysqli_fetch_assoc($result);
                                if(empty($row)){
                                    //аккаун не существует или пароль или логин введены неверно 
                                    $_SESSION['error']="InvalidPassOrLog";
                                    ?>
                                        <script>
                                            history.back();
                                        </script>
                                    <?php


                                }else{
                                    echo 'ok';
                                    $_SESSION['user_id']= $row['id'];
                                    header("Location: ./calendar.php");
                                    //аккаун существует перенапровление на гланую
                                }
                            }else{
                                echo 'Error';
                            }

                        }
                    ?>
                  </div>
                
                  <div class="ForgotAndRegister">
                      <a href="">Forgot password</a>
                      -
                      <a href="">Forgot Login</a>
                  </div>

                  <div class="ForgotAndRegister">
                    First time here? 
                    <a href="./Register.php"> Sing up</a>
                  </div>


            </form>

        </div>
    </div>
</body>
</html>