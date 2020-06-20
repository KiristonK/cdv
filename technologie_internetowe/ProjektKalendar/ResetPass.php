<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="./css/LoginForm.css">-->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/Styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="script" href="js/bootstrap.bundle.js">
    <link rel="script" href="js/bootstrap.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="scripts/mainScript.js"></script>
    <script src="scripts/functions.js"></script>
    <title>SCalendar Sign In</title>

</head>
<body class="col-12" style="background-color: #00c0ff; padding-top: 10%;">
    <div class="row w-100">
        <div class="col-12 d-flex justify-content-center">
            <label for="LoginDiv">
                <h1 class="display-4">SCalendar</h1>
            </label>
        </div>
    </div>
    <div class="row w-100">
        <div class="col-12 d-flex justify-content-center">
            <div class="card w-50"  id="LoginDiv">
                <div class="card-header">
                    <h3 class="font-weight-light" id="SignIn">Reset Password</h3>
                    
                </div>

                <?php
                    if(isset($_SESSION['error'])){
                        echo <<<  ERROR
                            <div class="alert alert-danger">
                                    <h5 class="font-weight-light">$_SESSION[error]</h5>
                            </div>
ERROR;
                        unset($_SESSION['error']);
                    }
                ?>

                <div class="card-body">
                    
                    <form action="./scripts/ResetPass_calendar.php?Login=<?php echo $_GET['Login'];?>" method="post">
                       <label for="login" class="form-check-label">Password</label>
                        <div class="input-group mb-3">
                            <input type="Password" class="form-control" placeholder="Password" id="login" name="pass" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        
                        <label for="login" class="form-check-label">Retype password</label>
                        <div class="input-group mb-3">
                            <input type="Password" class="form-control" placeholder="Retype password" id="login" name="retpass" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Reset</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>