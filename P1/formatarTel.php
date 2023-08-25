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
