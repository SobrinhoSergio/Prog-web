<?php
$currentDate = DateTime::createFromFormat('d/m/Y', '05/05/2023');

$handle = fopen('pereciveis.csv', 'r');
if ($handle !== false) {
    echo "Produtos vencidos:\n";

    while (($data = fgetcsv($handle, 1000, ';')) !== false) {
        $productDescription = $data[0];
        $expirationDate = DateTime::createFromFormat('d/m/Y', $data[1]);

        if ($expirationDate < $currentDate) {
            $daysExpired = $currentDate->diff($expirationDate)->days;
            echo "Produto: $productDescription - Dias vencidos: $daysExpired\n";
        }
    }

    fclose($handle);
} else {
    echo "Não foi possível abrir o arquivo CSV.\n";
}
?>
