<?php
  //heredoc
$name = "Anna";
$surname ="Novak";
echo <<< ETYKIETA
Dane użytkownika<br>
Imię: $name<br>Nazwisko: $surname<hr>
ETYKIETA;

///Imię: Anna
///Nazwisko: Nowak

//nowdoc
    $name = "Tadeusz";
    echo <<< 'E'
    Imię: $name<br>
E;

    ///Imię: $name


