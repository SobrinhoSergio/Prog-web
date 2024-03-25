<?php
// EXERCÍCIO
// Dado o array abaixo, gere uma tabela HTML que apresente
// seus dados. Use heredoc na solução.

$produtos = [
    [
        'descricao' => 'Guaraná Friburgo',
        'estoque' => 10,
        'preco' => 8.00
    ],
    [
        'descricao' => 'Coca-cola',
        'estoque' => 50,
        'preco' => 9.00
    ],
    [
        'descricao' => 'Mineirinho',
        'estoque' => 20,
        'preco' => 8.50
    ],
];

// Nowdoc (não aceita variáveis)
echo <<<'HTML'
    <table>
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Estoque</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
HTML;
// Continuar abaixo

?>