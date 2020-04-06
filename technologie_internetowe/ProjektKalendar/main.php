

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

    <link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" media="all"/>
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
                <h4 class="font-weight-light" style="width: 100px;" >SKalendar</h4>
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
    <div class="col-9" >
        <div class="row navbar-kalendar">
            <div class="arrowsLeft">
                <i class="fas fa-angle-double-left fa-3x"></i>
            </div>
            <div class="kalNavTitle mt-2" >
                <input type="button" class="btn btn-outline-primary" id="kalTitle"/>
            </div>
            <div class="arrowsRight">
                <i class="fas fa-angle-double-right fa-3x"></i>
            </div>
        </div>
        <?php
             for ($j = 0; $j < 5; $j++) {
                echo '<div class="row">';
                for ($i = 0; $i < 7; $i++) {
                    echo '<div class="card-body m-2 rounded day" style="width: 5rem; height: 5rem;"></div>';
                }
                echo '</div>';
            }
//        }
//        else {
//            echo '<div class="row">';
//            for ($i = 0; $i < 7; $i++){
//                echo '<div class="card-body m-2 rounded day" style="width: 5rem; height: 20rem;"></div>';
//            }
//            echo '</div>';
//        }
        ?>
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
    console.log(document.getElementById('kalTitle').value);
    document.getElementById('kalTitle').value = document.getElementById('showType').value;
    $( document ).ready(function() {
        $('#lMenuHide').click(function () {
            $('#menuTitle').toggle(100);
        })
    });
</script>
