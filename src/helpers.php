<?php

function dd(...$parms)
{
    echo '<pre>';
    die(var_export($parms));
}


function dateformat($date)
{
    return date('d/m/Y', strtotime($date));
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

function getDeleted($class)
{
    $prod = (new $class)->deleteds();
    return $prod;
}

function save($class, $attributes)
{
    $model = new $class($attributes);
    if ($model->id)
        return $model->update();

    return $model->insert();
}

function delete($class, $id)
{
    return (new $class)->delete($id);
}

function recover($class, $id)
{
    return (new $class)->recover($id);
}
