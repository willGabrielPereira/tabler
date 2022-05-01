<?php

require_once __DIR__ . '/bootstrap.php';


$c = (new Sales())->actives();

foreach ($c as $sale) {
    $sale->product();
}

dd($c);
