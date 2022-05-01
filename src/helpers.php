<?php

function dd(...$parms)
{
    echo '<pre>';
    die(var_export($parms));
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
