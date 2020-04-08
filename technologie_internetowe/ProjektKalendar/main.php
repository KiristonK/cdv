<html>
<input type="text" hidden value="Month" id="showType"/>
<head>
    <title>Kalendar</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/all.css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <link type="text/css" rel="stylesheet"
          href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" media="all"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
</head>

<body>
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
    <div class="col-2 menu" style="border: 1px solid #000000;" id="left-side-menu">
        <div class="row" style="position: relative">
            <div class="col" style="width: 100px;" id="menuTitle">
                <h4 class="font-weight-light" style="width: 100px;">SKalendar</h4>
            </div>
            <div class="row-cols-1" name="menuIcon" id="lMenuHide" style="position: absolute; right: 0">
                <div class="row menuBrick rounded"></div>
                <div class="row menuBrick rounded"></div>
                <div class="row menuBrick rounded"></div>
            </div>
        </div>
        <div class="col-1" style="border: 1px solid #000000;">

        </div>
    </div>
    <div class="col-9" id="kalDays">
        <div class="row navbar-kalendar">
            <div class="arrowsLeft">
                <i class="fas fa-angle-double-left fa-3x"></i>
            </div>
            <div class="col mt-2">
                <ul class="nav nav-tabs ml-5 mr-5" id="monthes">
                    <?php
                        for ($month = 0; $month < 12; $month++){
                            $mName = date('F', mktime(0, 0, 0, $month, 10));;
                            if (date('m', time()) == $month){
                                echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link active monthes\" href=\"#\">";
                                echo  $mName;
                                echo '</a></li>';
                            }
                            else{
                                echo "<li class=\"nav-item monthes\" id=\"{$month}\"><a class=\"nav-link monthes\" href=\"#\">";
                                echo  $mName;
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
    <div class="col" style="width:10px; background-color: #b8daff;">

    </div>
    <div class="col-1" style="border: 1px solid #000000;">

    </div>
</div>
<div class="row">

</div>
</body>

<link rel="script" href="js/bootstrap.bundle.js">
<link rel="script" href="js/bootstrap.js">
</html>


<script>
    function createKal(day){
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const date = new Date();
        let month = 0;
        $( "li" ).each(function( index ) {
            if (index === date.getMonth()) month = index;
        });
        if (day == null || day === 0) day = 1;
        for (let y = 0; y<5; y++){
            document.getElementById('kalDays').innerHTML+= '<div class="row" id=week'+y+'>\n'
            for (let i = 1; i<8; i++) {
                if ( new Date(Date.UTC(date.getFullYear(),date.getMonth(), day, 0,0)).getDay() === i-1 && day <= new Date(Date.UTC(date.getFullYear(),month+1,0)).getDate()) {
                    document.getElementById('week' + y).innerHTML += "<div class=\"card-body m-2 p-0 rounded day justify-content-end\"><h1 class=\"display-4 mb-2 ml-2\">" + day + "</h1></div>\n";
                    day++;
                } else{
                    document.getElementById('week' + y).innerHTML += "<div class=\"card-body m-2 p-0 rounded day justify-content-end\"><h1 class=\"display-4 mb-2 ml-2\"></h1></div>\n";
                }
            }
        }
    }
      $(document).ready(function () {
          $(".monthes").on('click', function(event){
              event.stopPropagation();
              event.stopImmediatePropagation();
              //(... rest of your JS code)
              alert("Click");
          });
        $('#lMenuHide').click(function () {
            $('#menuTitle').toggle(100);
        })
          createKal(0);
    });
</script>
