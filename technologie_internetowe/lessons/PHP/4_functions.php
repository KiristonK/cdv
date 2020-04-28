<?php
    function value($a):bool{
        if ($a < 0)
            return "Less then zero.";
        elseif ($a > 0)
            return "More then zero.";
        else
            return "Zero.";
    }

    $x = value(-5);
    echo $x;
    echo gettype($x);
    echo "<hr>";
    //var namespace
    $x = 10;
    function show(){
        echo "Variable value:",$GLOBALS['x'],"<hr>";
        $GLOBALS['x']+=1;
        echo "Variable value:",$GLOBALS['x'];
    }
echo show();
echo "<hr>$x<hr>";
function show1(){
    global $x;
    echo "Variable value: $x<hr>";
    $x+=1;
    echo "Variable value: $x";
}

echo show1();
echo "<hr>$x<hr>";

    function sum($a, $b){
        static $number = 0;
        $number += $a + $b;
        echo "Var \$number: $number <hr>";
        $number += 10;
    }

    sum(2,4);
    sum(5,5);
    sum(7,54);
    sum(3,2);


    //args

    function add($x, $y=1){
        return $x + $y;
    }
    $z = 20;

    $number = add($z, 6);
    echo $number,"<hr>";
    $number = add(2, 6);
    echo $number,"<hr>";
    $number = add(6);
    echo $number,"<hr>";

    //args and types
    function mul(float $x, int $y){
        return $x * $y;
    }

    echo mul(3,4),"<hr>";
    echo mul(3.5,2);
    echo mul(2,3.5);
