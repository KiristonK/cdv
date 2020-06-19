<?php
  session_start();
  if (!isset($_SESSION['user_id'])) header('location: ./Login.php');
?>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <link rel="script" href="js/bootstrap.bundle.js">
    <link rel="script" href="js/bootstrap.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="scripts/mainScript.js"></script>
    <script src="scripts/functions.js"></script>
    <script src="scripts/alterClass_pugin.js"></script>
    <script src="scripts/alerts.js"></script>
</head>
<body class="col-12">
<div class="row" style="background-color: #00c0ff">
    <div class="col-2" name="brand">
        <h3 class="font-weight-light m-2">SCalendar</h3>
    </div>
    <div class="col-md-6 col-sm-4 m-0" name="links">
        <nav class="nav nav-pills nav-justified m-2">
            <a class="nav-item nav-link w-100 mr-sm-3 mr-md-5 mr-lg-5" id="prevYear" href="#"><i class="fa fa-arrow-left"></i></a>
            <a class="nav-item nav-link active" style="cursor: pointer;" id="year"><?php echo date("Y") ?></a>
            <a class="nav-item nav-link w-100 ml-sm-3 ml-md-5 mr-lg-5" id="nextYear" href="#"><i class="fa fa-arrow-right"></i></a>
        </nav>
    </div>
    <div class="col-md-4 col-sm-6 m-0">
        <div class="row w-100">
            <div class="col-md-5 col-sm-3 mr-0 pr-0 pl-0 d-inline-flex">
                <input type="text" placeholder="Find event" class="form-control w-100 ml-0 mr-0 mt-2 mb-2" id="search">
                <button class="btn btn-outline-primary ml-0 mt-2 mb-2" type="button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="col-md-6 col-sm-8 d-inline-flex justify-content-start ml-0 mr-0">
                <h4 class="font-weight-light ml-4 mt-2"><?php echo $_SESSION['user']?></h4>
            </div>
            <div class="col-md-1 col-sm-1 pl-0 ml-0 d-inline-flex">
                <a href = "?onClick" class="text-danger text-decoration-none" title="Log out">
                    <i class="fas fa-sign-out-alt fa-2x v-center ml-3"></i>
                    <?php
                    if(isset($_GET['onClick'])){
                        unset($_SESSION['RM']);
                        unset($_SESSION['user_id']);
                        header("Location: ./Login.php");
                    }
                    ?>
                </a>
            </div>
        </div>
    </div>
    
</div>
<div class="row position-absolute w-100" id="alert_div" style="z-index: 9999; display: none;">
    <div class="col w-100">
        <div class="alert alert-danger fade show" id="alert_body" style="left: 61%; width: 40%;">
            <strong id="alert_title"></strong>
            <p id="info_text"></p>
        </div>
    </div>
</div>
<div class="row row-cols-11 justify-content-center text-center navbar-calendar">
    <div class="col-1">
        <i class="fas fa-angle-double-left fa-3x" style="z-index: 999; cursor: pointer;"></i>
    </div>
    <div class="col-9 col-lg-10 mt-2 d-table">
        <ul class="nav nav-tabs text-center" id="months">
            <?php

            for ($i = 1; $i < 13; $i++) {
                $month = $i - 1;
                $mName = date('F', mktime(0, 0, 0, $i, 10));
                if (date('m', time()) == $i) {
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
        <i class="fas fa-angle-double-right fa-3x" style="z-index: 999; cursor: pointer;"></i>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-11">
        <div class="row">
            <?php
            $days = array("Su", "Mo", "Tu", "We", "Th", "Fr", "Sa");
            for ($i = 0; $i < 7; $i++) {
                echo <<< DAYW
                    <div class="card-body m-2 p-0 rounded bg-transparent text-center" style="width: 5rem;">
                        <h1 class="font-weight-light" style="cursor: default;">$days[$i]</h1>
                    </div>
DAYW;
            }
            ?>
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
                <div class="row">
                    <div class="col-9 col-sm-7 d-table modalEvents" id="modalEventsTable">
                    </div>
                    <div class="col-3 col-sm-5 d-table">
                        <input type="button" class="btn btn-outline-success w-100 m-2" id="add" data-toggle="modal"
                               data-target="#modalEvControl" value="Add event">
                        <input type="button" class="btn btn-outline-warning w-100 m-2" id="edit" value="Edit event">
                        <select class="w-100 m-2 custom-select" id="changeEvColor">
                            <option class="bg-light text-dark" selected value="0">Change color to</option>
                            <option class="dropdown-item bg-light text-danger" value="danger">Red</option>
                            <option class="dropdown-item bg-light text-secondary" value="secondary">Grey</option>
                            <option class="dropdown-item bg-light text-success" value="success">Green</option>
                            <option class="dropdown-item bg-light text-primary" value="primary">Blue</option>
                            <option class="dropdown-item bg-light text-warning" value="warning">Yellow</option>
                            <option class="dropdown-item bg-light text-info" value="info">Turquoise</option>
                        </select>
                        <input type="button" class="btn btn-outline-danger w-100 m-2" id="deleteEv"
                               value="Remove event">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" style="z-index: 9999;" id="modalEvControl" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="" class="w-100 m-2" id="eventDataInput">
                        <input type="text" hidden name="event_id" id="event_id">
                        <div class="row">
                            <div class="col">
                                <label for="evName">Event name</label>
                                <input type="text" name="evName" id="evName" placeholder="Enter event name" class="form form-control mb-2" required>
                            </div>
                            <div class="col">
                                <label for="evLink">Event link</label>
                                <input type="text" id="evLink" name="evLink" placeholder="Enter event link, if any" class="form form-control mb-2">
                            </div>
                        </div>
                        <label for="evPlace">Event place (address)</label>
                        <input type="text" id="evPlace" name="evPlace" placeholder="Enter event address, if any" class="form form-control mb-2">
                        <label for="evDate">Event date</label>
                        <input type="date" id="evDate" name="evDate" class="form form-control mb-2" required>
                        <div class="row">
                            <div class="col">
                                <label for="evTS">Start time (from)</label>
                                <input type="time" id="evTS" name="evTS" class="form form-control mb-2" >
                            </div>
                            <div class="col">
                                <label for="evTE">End time (to)</label>
                                <input type="time" id="evTE" name="evTE" class="form form-control mb-2" >
                            </div>
                        </div>
                        <label for="evDesc">Event description</label>
                        <textarea type="text" class="form form-control overflow-hidden mb-2" placeholder="Enter event information or some notes, that will help you determine this event." name="evDesc"
                                  id="evDesc"></textarea>
                        <div style="text-align: end;">
                            <input type="button" data-dismiss="modal" class="btn btn-outline-success" id="formSubmit"
                                   value="Confirm">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>
<script>
    let year = new Date().getFullYear();
    redrawMenu(year, 0);
    generateCalendar();
</script>