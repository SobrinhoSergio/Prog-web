<?php

$data = readline( 'Informe uma data (dd/mm/aaaa): ' );
$partes = explode( '/', $data );
echo 'Dia: ', $partes[ 0 ], ' Mês: ', $partes[ 1 ], ' Ano: ', $partes[ 2 ], PHP_EOL;

echo 'Juntando a data...', PHP_EOL;
$novaData = implode( '/', $partes );
echo $novaData, PHP_EOL;

?>