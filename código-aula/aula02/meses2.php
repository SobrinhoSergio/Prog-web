<?php
$meses = [
    1 => 'Janeiro',
    2 => 'Fevereiro',
    3 => 'Março',
    // ...
];
// Imprimindo os meses
foreach ( $meses as $indice => $mes ) {
    echo $indice, ' é ', $mes, PHP_EOL;
}
?>