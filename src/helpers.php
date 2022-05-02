<?php

function dd(...$parms)
{
    echo '<pre>';
    die(var_export($parms));
}


function dateformat($date)
{
    return date('d-m-Y', strtotime($date));
}

function priceformat($value)
{
    return number_format($value, 2, ',', '.');
}


function totalActives($class)
{
    $prod = (new $class)->select('count(*) as total')->actives()[0];
    return $prod->total;
}


function getAll($class)
{
    $prod = (new $class)->actives();
    return $prod;
}
