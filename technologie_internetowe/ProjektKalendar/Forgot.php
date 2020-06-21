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
                    <h3 class="font-weight-light" id="SignIn">Recover <?php echo $_GET['what']?></h3>
                    
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
                    <div id="before">
                        <input id="what" hidden value="<?php if (isset($_GET['what'])) echo  $_GET['what'];?>">
                        <input type="email" id="email" class="form-control mt-2 mb-2" name="email" placeholder="Enter your email">
                        <input type="button" id="recover" class="btn btn-primary mt-2 mb-2 d-inline-block" value="Recover">
                        <input type="button" id="back" class="btn btn-secondary mt-2 mb-2 d-inline-block" value="Back">
                    </div>

                    <div id="after">
                        <form action="Login.php" method="post">
                            <h1 class="font-weight-light">An email with link to recover your <?php echo $_GET['what'];?> has been sent to you.</h1>
                            <h4 class="font-weight-light"> Check spam folder, if there is no email from us in your inbox.</h4>
                            <input type="submit" class="btn btn-outline-primary" value="Sign In">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $().ready(function() {
        $('#after').fadeOut(0);
        $('#recover').on('click', function() {
            $.ajax({
                method: 'POST',
                url: "./Scripts/forgot_calendar.php",
                data: {email: $('#email').val(), what: $('#what').val()},
                success: function(data) {
                    console.log(data);
                }});
            $('#before').fadeOut(400, function() {
                $('#after').fadeIn();
            });
        });

        $('#back').on('click', function() {
            history.back();
        });
    })
</script>