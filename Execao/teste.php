<?php

require_once 'vendor/autoload.php';

use \phputil\extenso\Extenso;

$e = new Extenso();
echo $e->extenso(9_999_999_999.9);