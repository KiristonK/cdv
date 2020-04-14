<html lang="en">
<head>
    <title>Kalendar</title>
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
<input type="text" hidden value="Month" id="showType"/>
<div class="row">
    <div class="col-3" style="border: 1px solid #000000;">
        <h1 class="font-weight-light">SKalendar</h1>
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
                <h4 class="font-weight-light">SKalendar</h4>
            </div>
            <div class="col pl-4" id="bricks">
                <div class="row" name="menuIcon" id="lMenuHide" style="right: 0">
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
    <div class="col-11" id="kalDays">
        <div class="row navbar-kalendar">
            <div class="arrowsLeft">
                <i class="fas fa-angle-double-left fa-3x"></i>
            </div>
            <div class="col mt-2 justify-content-center">
                <ul class="nav nav-tabs ml-5 mr-5 justify-content-center" id="monthes">
                    <?php
                        for ($month = 0; $month < 12; $month++){
                            $mName = date('F', mktime(0, 0, 0, $month, 10));
                            if (date('m', time()) == $month) {
                                echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link active\" href=\"#\">";
                                echo $mName;
                                echo '</a></li>';
                            }
                            else {
                                echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link\" href=\"#\">";
                                echo $mName;
                                echo '</a></li>';
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="arrowsRight">
                <i class="fas fa-angle-double-right fa-3x"></i>
            </div>
        </div>

    </div>
</div>
<div class="row">

</div>
</body>

<link rel="script" href="js/bootstrap.bundle.js">
<link rel="script" href="js/bootstrap.js">
</html>


<script>
    function createKal(day, month) {
        const options = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
        const date = new Date();
        if (day == null || day === 0) day = 1;
        if (month == null || month === 0) {
            $("li").each(function (index) {
                if (index === date.getMonth()) month = index;
            });
        } else {
            document.getElementById('kalDays').childNodes.forEach((node, index) => {
                if (index > 2) {
                    document.getElementById('kalDays').lastElementChild.remove();
                    node.remove();
                }
            });
            document.getElementById('kalDays').lastElementChild.remove();
        }

        for (let y = 0; y < 5; y++) {
            let row = document.createElement("div");
            row.classList.add('row');
            row.id = 'week' + y;
            for (let i = 1; i < 8; i++) {
                if (new Date(Date.UTC(date.getFullYear(), date.getMonth(), day, 0, 0)).getDay() === i - 1 && day <= new Date(Date.UTC(date.getFullYear(), month + 1, 0)).getDate()) {
                    row.innerHTML += "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" name=\"day\"><h1 class=\"display-4 mb-2 ml-2\">" + day + "</h1></div>\n";
                    day++;
                } else {
                    row.innerHTML += "<div class=\"card-body m-2 p-0 rounded day justify-content-end\" name=\"day\"><h1 class=\"display-4 mb-2 ml-2\"></h1></div>\n";
                }
            }
            document.getElementById('kalDays').appendChild(row);
        }


        //console.log(document.getElementById('kalDays').childNodes.length);
        //document.getElementById('kalDays').childNodes.forEach((node)=>{console.log(node);});
    }

    function lMenuRedraw(click) {
        if (click == 0 || $(window).width() < 1500) {
            //$('#left-side-menu').style.width = '55px';
            $('#menuTitle').hide(200);
            $('.menuControls').hide(200);
            document.getElementById('bricks').classList.remove('pl-4');
        } else if (click == 1 || $(window).width() > 1500) {
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
            $("li").each(function (index) {
                let date = new Date();
                if (index < date.getMonth() - 1 || index > date.getMonth() + 2) {
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

    $(document).ready(function () {
        redrawMenu();
        createKal();
        window.addEventListener("resize", redrawMenu);
        $(".monthes").on('click', function (event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            //(... rest of your JS code)
            alert(this.id);
            document.getElementById(this.id).classList.add('active');
            createKal(0, this.id);
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
