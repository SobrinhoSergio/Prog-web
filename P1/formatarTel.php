<?php

function formatarTelefone($telefone) {
    // Remover quaisquer caracteres que não sejam dígitos
    $telefoneNumerico = preg_replace('/\D/', '', $telefone);
    
    // Verificar se o número de telefone tem 10 ou 11 dígitos
    if (strlen($telefoneNumerico) === 10) {
        return sprintf("(%s) %s-%s", substr($telefoneNumerico, 0, 2), substr($telefoneNumerico, 2, 4), substr($telefoneNumerico, 6));
    } elseif (strlen($telefoneNumerico) === 11) {
        return sprintf("(%s) %s-%s", substr($telefoneNumerico, 0, 2), substr($telefoneNumerico, 2, 5), substr($telefoneNumerico, 7));
    } else {
        return '';
    }
}

// Teste
$numero1 = '2225271727';
$numero2 = '22988776655';

echo formatarTelefone($numero1) . "\n";  // Saída: (22) 2527-1727
echo formatarTelefone($numero2) . "\n";  // Saída: (22) 98877-6655

//----------------------------------------------------------------------------

function formatarTelefone2($telefone){

    $tamanho = mb_strlen($telefone);

    $v = '';

    if(($tamanho === 10 || $tamanho === 11) && is_numeric($telefone)){
        if($tamanho === 10){
            $v = "(" . mb_substr($telefone, 0, 2) . ") " . mb_substr($telefone, 2, 4) . "-" . mb_substr($telefone, 6);
            
            return $v;
        }

        else{
            $v = "(" . mb_substr($telefone, 0, 2) . ") " . mb_substr($telefone, 2, 5) . "-" . mb_substr($telefone, 7);
            
            return $v;
        }
    }

    return v;

}

$telefone = readline("Digite: ");

echo formatarTelefone2($telefone);