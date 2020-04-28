<?php
    $a = 2;
    $b = 4;
    if ($a < $b){
        echo "\$a < \$b<br>";
        echo $a,"<",$b,"<br";
    }
    if ($b > $a):
        echo "$b > $a<br>";
    elseif ($a > $b):
        echo "$a > $b<br>";
    else:
        echo "$a = $b";
    endif;


