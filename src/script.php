<?php

require_once __DIR__ . '/bootstrap.php';


$prod = (new Products)->actives();
dd($prod);




$c = (new Sales())->actives();

foreach ($c as $sale) {
    $sale->product();
}

dd($c);
