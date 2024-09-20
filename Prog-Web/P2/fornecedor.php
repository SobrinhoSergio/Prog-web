<?php

namespace acme;

class Fornecedor{
    public int $id = 0;
    public string $codigo = '';
    public string $nome = '';
    public string $email = '';
    public string $cnpj = '';
    public string $telefone = '';

    public function __construct(array $dados = []){
        $this->id = valor($dados, 'id', 0);
        $this->codigo = valor($dados, 'codigo', 0);
        $this->nome = valor($dados, 'nome', 0);
        $this->email = valor($dados, 'email', 0);
        $this->cnpj = valor($dados, 'cnpj', 0);
        $this->telefone = valor($dados, 'telefone', 0);
    }

}

function valor(array $a, $chave, $default){
    return htmlspecialchars(isset($a[$chave]) ? $a[$chave] : $default);
}