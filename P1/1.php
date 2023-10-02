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

--------------------------------------------------------------------

<?php
$dados = @file_get_contents('produtos.csv');

$linhas = explode("\n", $dados);

$produtos = [];

foreach ($linhas as $l) {
    $p = explode(";", $l);
    if (count($p) === 3) { // Verifica se a linha tem três colunas (descricao, estoque e preco)
        $produtos[] = [
            'descricao' => trim($p[0]),
            'estoque' => intval(trim($p[1])),
            'preco' => floatval(trim($p[2]))
        ];
    }
}

$inventarioTotal = 0;
$somaPrecos = 0;

foreach ($produtos as $produto) {
    $inventarioTotal += $produto['estoque'] * $produto['preco'];
    $somaPrecos += $produto['preco'];
}

$mediaPrecos = $somaPrecos / count($produtos);

echo "Inventário Total: R$ " . number_format($inventarioTotal, 2, ',', '.') . PHP_EOL;
echo "Média de Preços: R$ " . number_format($mediaPrecos, 2, ',', '.') . PHP_EOL;
?>
