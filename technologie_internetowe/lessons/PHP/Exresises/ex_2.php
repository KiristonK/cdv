

<form name="form" action="" method="get">
    <input name="inputField" id="inputField" type="text" placeholder="Podaj dane" value="">
    <input type="submit" value="Cenzura !">
</form>

<?php
$blackList = array("czarny", "biały");
$replace = "_#***#_";
if (!empty($_GET['inputField']))
    echo str_ireplace($blackList, $replace, $_GET['inputField']);
?>