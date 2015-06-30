<?php

include(__DIR__.'/../vendor/autoload.php');

use RDConverter\RDConverter;

$rd = new RDConverter();
echo('Amersfoortcoördinaten;'.PHP_EOL.'RD; X: 155000, Y: 463000'.PHP_EOL.'WGS84; Lat: '.$rd->RD2lat(155000,463000).' Lon: '.$rd->RD2lng(155000,463000).PHP_EOL);
