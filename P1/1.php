<?php

$dados = @file_get_contents('pereciveis.csv');

$linhas = explode("\n", $dados);

$produtos = [];

foreach ($linhas as $l){
    $p = explode(";", $l);
    $produtos[]=[
        'descricao' => $p[0],
        'validade' => $p[1]
    ];
}

$dataAtual = ['5', '5', '2023'];

foreach ($produtos as $p){
    $data = explode("/", $p['validade']);
    $dia = $data[0] - $dataAtual[0];

    if($dia > 0){
        echo "Produtos Vencidos", PHP_EOL;
        echo $p['descricao'], '-', p['validade'], '-', 'Vencido a ', $dia, 'dias', PHP_EOL; 
    }
}

?>