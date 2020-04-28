<?php
    $text = <<<TEXT
    CDV -
    Collegium
    Da
    Vinci<br>
TEXT;
    echo $text;
    echo nl2br($text);
    //toLowerCase
    echo strtolower($text);
    echo strtoupper($text);
    echo ucfirst(trim(strtolower($text)));
    echo ucwords(trim(strtolower($text)));

    $lorem = "Make it so.Ahoy, misty captain. you won't fear the galley. ";
    echo $lorem;

    echo wordwrap($lorem, 10, "<br>");
    echo wordwrap($lorem, 10, "<hr>");

    //trim

    $name = "   Michel           ";
    echo "<br>".strlen($name).":".$name;
    echo "<br>".strlen(ltrim($name)).":".$name;
    echo "<br>".strlen(rtrim($name)).":".$name;
    echo "<br>".strlen(trim($name)).":".$name;
    echo "<br>";
    //search

    $address = "Poznań, ul. Polna 10, tel. (61) 111 22 33";
    $find = strstr($address, 'tel');
    $find1 = stristr($address, 'Tel');
    $find2 = stristr($address, 'Tel', true);
    echo $find,"<br>";
    echo $find1,"<br>";
    echo $find2,"<br>";

    $surname = substr("Janusz Kowalski", 7, 5);
    echo $surname;

    //string manipulations
    $login ="Bączek";
    $censure = array("ą","ż","ź","ś","ć","ę","ó","ń","ł");
    $replace = array("a","z","z","s","c","e","o","n","l");

    $validlogin = str_ireplace($censure, $replace, $login);
    echo "Before: ",$login,"<br>";
    echo "After: ", $validlogin;


