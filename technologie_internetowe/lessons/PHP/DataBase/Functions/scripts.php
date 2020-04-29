<?php
function getYear($date)
{
    $y = substr($date, 0, 4);
    if ($y == "0000") return 'No data';
    return $y;
}