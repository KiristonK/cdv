<html lang="en">
<head>
    <title>SCalendar</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/Styles.css">
    <link rel="stylesheet" href="css/all.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <link type="text/css" rel="stylesheet"
          href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" media="all"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
</head>

<body>
<!--suppress HtmlFormInputWithoutLabel -->
<input type="text" hidden value="Month" id="showType"/>
<div class="row">
    <div class="col-3" style="border: 1px solid #000000;">
        <h1 class="font-weight-light">SCalendar</h1>
    </div>
    <div class="col-6" style="border: 1px solid #000000;">
        <h1 class="display-4">Middle</h1>
    </div>
    <div class="col-3" style="border: 1px solid #000000;">
        <h1 class="display-4">End</h1>
    </div>
</div>
<div class="row">
    <div class="col-2 menu w-auto" style="border: 1px solid #000000;" id="left-side-menu">
        <div class="row">
            <div class="col" style="width: 100px; overflow: visible;" id="menuTitle">
                <h4 class="font-weight-light">SCalendar</h4>
            </div>
            <div class="col pl-4" id="bricks">
                <div class="row" id="lMenuHide" style="right: 0">
                    <div class="col" style="width: 40px;">
                        <div class="row menuBrick rounded"></div>
                        <div class="row menuBrick rounded"></div>
                        <div class="row menuBrick rounded"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row menu-controls">
            <div class="col" style="border: 1px solid #000000;">
                <div class="row">
                    <div class="col-1 mr-2 mb-2">
                        <i class="fas fa-home fa-2x"></i>
                    </div>
                    <div class="col menuControls">
                        <!--                        <input type="button" class="btn btn-outline-primary m-1" value="Home"><br>-->
                        <h3 class="font-weight-light">Home</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 mr-1 ml-1 mb-2">
                        <i class="far fa-calendar-check fa-2x"></i>
                    </div>
                    <div class="col menuControls">
                        <!--                        <input type="button" class="btn btn-outline-primary m-1" value="Events"><br>-->
                        <h3 class="font-weight-light">Events</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 mr-1 ml-1 mb-2">
                        <i class="far fa-calendar-alt fa-2x"></i>
                    </div>
                    <div class="col menuControls">
                        <!--                        <input type="button" class="btn btn-outline-primary m-1" value="Calendar"><br>-->
                        <h3 class="font-weight-light">Calendar</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-11">
        <div class="row navbar-calendar">
            <div class="col-1 arrowsLeft">
                <i class="fas fa-angle-double-left fa-3x" style="z-index: 999;"></i>
            </div>
            <div class="col-10 mt-2 justify-content-center">
                <ul class="nav nav-tabs ml-5 mr-5 justify-content-center" id="monthes">
                    <?php
                    for ($month = 0; $month < 12; $month++) {
                        $mName = date('F', mktime(0, 0, 0, $month, 10));
                        if (date('m', time()) == $month) {
                            echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link active\" id=\"{$month}nav\" href=\"#\">";
                            echo $mName;
                            echo '</a></li>';
                        } else {
                            echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link\" id=\"{$month}nav\" href=\"#\">";
                            echo $mName;
                            echo '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-1 arrowsRight">
                <i class="fas fa-angle-double-right fa-3x" style="z-index: 999;"></i>
            </div>
        </div>
        <div id="kalDays"></div>
    </div>
</div>
<div class="row">

</div>

</body>

<link rel="script" href="js/bootstrap.bundle.js">
<link rel="script" href="js/bootstrap.js">
</html>


<!--suppress JSUnresolvedFunction -->
<script>
    function clrCalendar() {
        $("#kalDays").fadeOut(300);
        document.getElementById('kalDays').childNodes.forEach((node) => {
            document.getElementById('kalDays').lastElementChild.remove();
            node.remove();
        });
        document.getElementById('kalDays').lastElementChild.remove();
        document.getElementById('kalDays').lastElementChild.remove();
    }

    function generateCalendar(day, month) {
        const date = new Date();
        if (day == null || day === 0) day = 1;
        if (month == null || month === 0) {
            $("li").each(function (index) {
                if (index === date.getMonth()) month = index;
            });
        } else {
            clrCalendar();
        }
        let oMonth = month;
        let extraDays = "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" ><h1 class=\"display-4 mb-2 ml-2 outofdays\">";
        let regDay = "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" ><h1 class=\"display-4 mb-2 ml-2\">";
        for (let y = 0; y < 6; y++) {
            let row = document.createElement("div");
            row.classList.add('row');
            row.id = 'week' + y;
            for (let i = 0; i < 7; i++) {
                console.log(day);
                let dayOfWeek = new Date(Date.UTC(date.getFullYear(), month, day, 0, 0)).getDay();
                let allDays = new Date(Date.UTC(date.getFullYear(), month + 1, 0)).getDate();
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

    function lMenuRedraw(click) {
        if (click === 0 || $(window).width() < 1500) {
            $('#menuTitle').hide(200);
            $('.menuControls').hide(200);
            document.getElementById('bricks').classList.remove('pl-4');
        } else if (click === 1 || $(window).width() > 1500) {
            $('#menuTitle').show(200);
            $('.menuControls').show(200);
            document.getElementById('bricks').classList.add('pl-4');
            document.getElementById('menuTitle').style.overflow = 'visible';
        }
        let els = document.getElementsByClassName("menuControls");
        [].forEach.call(els, function (el) {
            el.style.overflow = 'visible';
        });
    }

    function redrawMenu() {
        if ($(window).width() < 1500) {
            let id = document.getElementsByClassName('nav-link active');
            $("li").each(function (index) {
                let date = new Date();
                if (index < date.getMonth() + 1 - 2 || index > date.getMonth() + 1 + 2) {
                    document.getElementById(index).classList.add('d-none');
                }
            });
        } else {
            $("li").each(function (index) {
                document.getElementById(index).classList.remove('d-none');
            });
        }
        lMenuRedraw();
    }

    function clrActive(arrow) {
        let act = document.getElementsByClassName('nav-link active');
        let id = 0;
        for (let actKey of act) {
            if (arrow) id = actKey.id;
            actKey.classList.remove('active');
        }
        return id;
    }

    $(document).ready(function () {
        redrawMenu();
        generateCalendar();
        window.addEventListener("resize", redrawMenu);
        $(".monthes").on('click', function (event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            //(... rest of your JS code)
            clrActive();
            document.getElementById(this.id + "nav").classList.add('active');
            generateCalendar(0, this.id - 1);
        });
        $(".fa-angle-double-left").on('click', function () {
            let id = clrActive(true);
            alert(id);
            id--;
            document.getElementById(id + "nav").classList.add('active');
            generateCalendar(0, id);
        });
        $(".fa-angle-double-right").on('click', function () {
            let id = clrActive(true);
            id++;
            document.getElementById(id + "nav").classList.add('active');
            generateCalendar(0, id);
        });
        let els = document.getElementsByClassName("day");
        [].forEach.call(els, function (el) {
            el.addEventListener("click", function () {
                alert("Day click");
            })
        });
        $('#lMenuHide').click(function () {
            lMenuRedraw(1);
        });
    });
</script>
