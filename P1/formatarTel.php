<?php

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

echo "----------------------------------";


function formatarCPF($cpf) {
    // Remove qualquer caractere não numérico do CPF
    $cpf = preg_replace("/[^0-9]/", "", $cpf);

    // Verifica se o CPF tem 11 dígitos numéricos
    if (strlen($cpf) === 11 && is_numeric($cpf)) {
        
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    } else {
        // Se não atender aos critérios, retorna o CPF original
        return $cpf;
    }
}

$cpf = readline("Digite o CPF: ");
echo formatarCPF($cpf);
