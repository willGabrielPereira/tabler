<?php

function dd(...$parms)
{
    echo '<pre>';
    die(var_export($parms));
}
