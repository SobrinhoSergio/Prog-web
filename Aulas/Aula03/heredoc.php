<?php

$produtos = [
    ['descricao' => 'Item 1',
     'estoque' => 2,
     'preco' => 8.00
    ],
    ['descricao' => 'Item 2',
     'estoque' => 3,
     'preco' => 13.00
    ],
    ['descricao' => 'Item 3',
     'estoque' => 5,
     'preco' => 2.00
    ]
];

echo <<<'HTML'
    <table>
        <thead>
            <th>Descrição</th>
            <th>Estoque</th>
            <th>Preço</th>
        </thead>
    <tbody>
HTML;



foreach($produtos as $p){
    echo <<<A
        <tr>    
            <td>$p[descricao]</td>
            <td>$p[estoque]</td>
            <td>$p[preco]</td>
        </tr>
    A;
}

$preco = 0;
$estoque = 0;

foreach($produtos as $p){

$preco += $p['preco'];
$estoque += $p['estoque'];

}

$media = $preco / count($estoque);

echo <<<HTML
    </tbody>
        <tfoot>
            <td></td>
            <td>$estoque</td>
            <td>$media</td>
        <tfoot>
    </table>
HTML;