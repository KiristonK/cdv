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
    <div class="modal-dialog modal-dialog-centered" role="document">
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
<button type="button" hidden id="trigger" class="btn btn-primary" data-toggle="modal" data-target="#modalEvents">
    trigger
</button>
</html>


<!--suppress JSUnresolvedFunction -->
<script>
    function clrCalendar() {
        $("#kalDays").fadeOut(300);
        document.getElementById('kalDays').innerHTML = "";
    }

    function generateCalendar(day, month, year) {
        const date = new Date();
        if (day == null || day === 0) day = 1;
        if (month == null) {
            $("li").each(function (index) {
                if (index === date.getMonth()) month = index;
            });
        } else {
            clrCalendar();
        }
        if (year == null || year === 0) year = date.getFullYear();
        let oMonth = month;
        let extraDays = "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" ><h1 class=\"display-4 mb-2 ml-2 ml-lg-4 pl-lg-5 outofdays\" style='z-index: -1'>";
        let regDay = "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" ><h1 class=\"display-4 mb-2 ml-2 ml-lg-4 pl-lg-5\" style='z-index: -1' data-toggle=\"modal\" data-target=\"#modalEvents\">";
        for (let y = 0; y < 6; y++) {
            let row = document.createElement("div");
            row.classList.add('row');
            row.id = 'week' + y;
            for (let i = 0; i < 7; i++) {
                let dayOfWeek = new Date(Date.UTC(year, month, day, 0, 0)).getDay();
                let allDays = new Date(Date.UTC(year, month + 1, 0)).getDate();
                if (dayOfWeek === i && day <= allDays) {
                    if (oMonth === month)
                        row.innerHTML += regDay + day + "</h1></div>\n";
                    else
                        row.innerHTML += extraDays + day + "</h1></div>\n";
                    day++;
                } else {
                    if (day >= allDays) {
                        day = 1;
                        row.innerHTML += extraDays + day + "</h1></div>\n";
                        day++;
                        month++;
                    } else {
                        let oDay = new Date(Date.UTC(date.getFullYear(), month, 0)).getDate() - (dayOfWeek) + i + 1;
                        row.innerHTML += extraDays + oDay + "</h1></div>\n";
                    }
                }
            }
            document.getElementById('kalDays').appendChild(row);
            $("#kalDays").fadeIn(300);
        }

    }

    function redrawMenu(year, month) {
        let active = month;
        if (month === 0 || month === null)
            active = ($('#months').find('.active')[0].id.match(/([^nav])/g));
        active = parseInt(active)
        let months = $("#months").find('.nav-item');
        if ($(window).width() < 1500) {
            months.each(function (index) {
                if (index < active - 3 || index > active + 3) {
                    document.getElementById(index).classList.add('d-none');
                } else {
                    document.getElementById(index).classList.remove('d-none');
                }
            });
        } else {
            months.each(function (index) {
                document.getElementById(index).classList.remove('d-none');
            });
        }
    }

    function clrActive(arrow) {
        let act = $('#months').find('.active');
        let id = 0;
        if (arrow) id = act[0].id;
        act[0].classList.remove('active');
        return id;
    }

    $(document).ready(function () {
        let year = new Date().getFullYear();
        redrawMenu(year, 0);
        generateCalendar();
        window.addEventListener("resize", func => {
            redrawMenu(year)
        });
        $("#year").on("click", function (e) {
            let date = new Date();
            clrActive();
            document.getElementById((date.getMonth() + 1) + "nav").classList.add('active');
            generateCalendar(0, date.getMonth(), date.getFullYear());
            redrawMenu(date.getFullYear());
            $('#year').text(date.getFullYear());
        });

        $("#prevYear").on('click', function (e) {
            let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
            year = year - 1;
            generateCalendar(0, month - 1, year);
            redrawMenu(year);
            $('#year').text(year);
        });
        $("#nextYear").on('click', function (e) {
            let month = $('.months').find('.active')[0].id.match(/([^nav])/g);
            year = year + 1;
            generateCalendar(0, month - 1, year);
            redrawMenu(year);
            $('#year').text(year);
        })
        $(".months").on('click', function (event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            //(... rest of your JS code)
            clrActive();
            document.getElementById(this.id + "nav").classList.add('active');
            generateCalendar(0, this.id - 1, year);
        });
        $(".fa-angle-double-left").on('click', function () {
            let id = parseInt(clrActive(true).replace("nav", "")) - 1;
            if (id < 0) id = 11;
            document.getElementById(id + "nav").classList.add('active');
            redrawMenu(year, id);
            generateCalendar(0, id, year);
        });
        $(".fa-angle-double-right").on('click', function () {
            let id = parseInt(clrActive(true).replace("nav", "")) + 1;
            if (id > 11) id = 0;
            document.getElementById(id + "nav").classList.add('active');
            redrawMenu(year, id);
            generateCalendar(0, id, year);
        });
        let els = document.getElementsByClassName("day");
        [].forEach.call(els, function (el) {
            el.addEventListener("click", function () {

            })
        });
        $('#modalEvents').on('show.bs.modal', function (event) {
            let caller = $(event.relatedTarget);
            let month = $('#months').find('.active')[0].innerHTML;
            let modal = $('#modalEvents');

            modal.find('.modal-title').text("All events on " + caller[0].innerHTML + ", " + month + ", " + year);
        })
        $('#lMenuHide').click(function () {
            lMenuRedraw(1);
        });
    });
</script>
