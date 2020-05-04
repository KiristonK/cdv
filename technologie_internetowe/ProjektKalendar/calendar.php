<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SCalendar</title>

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
</head>
<body class="col-12">
<div class="row" style="background-color: #00c0ff">
    <div class="col-3" name="brand">
        <h3 class="font-weight-light m-2">SCalendar</h3>
    </div>
    <div class="col-5" name="links">
        <nav class="nav nav-pills nav-justified m-2">
            <a class="nav-item nav-link" id="prevYear" href="#"><i class="fa fa-arrow-left"></i></a>
            <a class="nav-item nav-link active" id="year"><?php echo date("Y") ?></a>
            <a class="nav-item nav-link" id="nextYear" href="#"><i class="fa fa-arrow-right"></i></a>
        </nav>
    </div>
    <div class="col-4" name="search">
        <div class="row justify-content-end p-0">
            <input type="text" placeholder="Type to search" style="min-width: 150px;" class="form-control m-2 w-50">
            <input type="button" value="Search" class="btn btn-success mt-2 mb-2 mr-2 w-auto">
        </div>
    </div>
</div>
<div class="row justify-content-center pl-lg-5">
    <div class="col-11">
        <div class="row navbar-calendar">
            <div class="col-1">
                <i class="fas fa-angle-double-left fa-3x" style="z-index: 999;"></i>
            </div>
            <div class="col-10 mt-2">
                <ul class="nav nav-tabs" id="months">
                    <?php

                    for ($month = 0; $month < 12; $month++) {
                        $mName = date('F', mktime(0, 0, 0, $month, 10));
                        if (date('m', time()) == $month) {
                            echo <<< ITEM
                                    <li class="nav-item months" id="$month"><a class="nav-link active" id="{$month}nav" href="#">$mName</a></li>
ITEM;
                        } else {
                            echo <<< ITEM
                                    <li class="nav-item months" id="$month"><a class="nav-link" id="{$month}nav" href="#">$mName</a></li>
ITEM;
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-1 ml-0 pl-0">
                <i class="fas fa-angle-double-right fa-3x" style="z-index: 999;"></i>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-11">
        <div class="row">
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Su</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Mo</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Tu</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">We</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Th</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Fr</h1>
            </div>
            <div class="card-body m-2 p-0 rounded bg-transparent" style="width: 5rem;">
                <h1 class="font-weight-light mb-2 ml-2 ml-lg-4 pl-lg-5">Sa</h1>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-11 " id="kalDays"></div>
</div>
</body>
<div class="modal fade" id="modalEvents" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEventsTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                No events planned, day is free :)
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
</html>